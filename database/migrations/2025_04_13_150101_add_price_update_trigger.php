<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddPriceUpdateTrigger extends Migration
{
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER update_case_price_after_item_update
            AFTER UPDATE ON items
            FOR EACH ROW
            BEGIN
                DECLARE old_price DECIMAL(10, 2);
                DECLARE new_price DECIMAL(10, 2);
                DECLARE price_diff DECIMAL(10, 2);
                DECLARE total_amount DECIMAL(10, 2);
                DECLARE total_amount_raised DECIMAL(10, 2);

                IF OLD.price != NEW.price THEN
                    SET old_price = OLD.price;
                    SET new_price = NEW.price;
                    SET price_diff = (new_price - old_price);

                    SET total_amount_raised = (
                        SELECT IFNULL(SUM(c.amount_raised * price_diff), 0)
                        FROM charity_case_item c
                        WHERE c.item_id = OLD.id
                    );

                    SET total_amount = (
                        SELECT IFNULL(SUM(c.amount * price_diff), 0)
                        FROM charity_case_item c
                        WHERE c.item_id = OLD.id
                    );

                    UPDATE charity_cases
                    SET price = price + total_amount,
                        price_raised = price_raised + total_amount_raised
                    WHERE id IN (SELECT charity_case_id FROM charity_case_item WHERE item_id = OLD.id);
                END IF;
            END;
        ');
    }

    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS update_case_price_after_item_update');
    }
}

;
