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
        DECLARE price_diff DECIMAL(10, 2);
        DECLARE qty INT;
        DECLARE qty_raised INT;
        DECLARE case_id INT;
        DECLARE done INT DEFAULT FALSE;

        DECLARE cur CURSOR FOR
            SELECT charity_case_id, amount, amount_raised
            FROM charity_case_item
            WHERE item_id = OLD.id;

        DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

        SET price_diff = NEW.price - OLD.price;

        OPEN cur;

        read_loop: LOOP
            FETCH cur INTO case_id, qty, qty_raised;

            IF done THEN
                LEAVE read_loop;
            END IF;

            -- أهو كدا بننفذ اللي حضرتك عايزه بالحرف
            UPDATE charity_cases
            SET
                price = price + (qty * price_diff),
                price_raised = price_raised + (qty_raised * price_diff)
            WHERE id = case_id;

        END LOOP;

        CLOSE cur;
    END;
');


    }

    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS update_case_price_after_item_update');
    }
}

;
