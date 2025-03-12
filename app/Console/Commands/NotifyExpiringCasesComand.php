<?php

namespace App\Console\Commands;

use App\Models\CharityCase;
use App\Models\User;
use App\Notifications\DatabaseNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class NotifyExpiringCasesComand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cases:notify-expiring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify admins about expiring cases';


    public function handle()
    {
        $expiringCases = CharityCase::whereBetween('date_end', [now(), now()->addDays(3)])->where('archive', 0) ->whereColumn('price_raised', '<', 'price')->get();
        if ($expiringCases->isEmpty()) {
            $this->info('not found any case');
            return;
        }

        $admins = User::whereHas('permissions', function ($query) {
            $query->where('name', 'notifications-read');
        })->get();
        foreach ($expiringCases as $case) {
              Notification::send($admins, new DatabaseNotification('اشعار باقتراب انتهاء الحاله الخيريه ' . $case->name , 'The Case ' . $case->name .'Comming To End', null, $case->id));

              $this->info('send notification successfully for this case: ' . $case->user->name);
        }
    }
}
