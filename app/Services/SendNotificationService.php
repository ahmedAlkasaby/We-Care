<?php

namespace App\Services;


use App\Models\CharityCase;
use App\Models\Donation;
use App\Models\User;
use App\Notifications\DatabaseNotification;
use App\Services\FirebaseNotificationService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class SendNotificationService
{
    protected $FirebaseNotificationService;

    public function __construct(FirebaseNotificationService $FirebaseNotificationService)
    {
        $this->FirebaseNotificationService = $FirebaseNotificationService;
    }




    public function sendNotificationFromCase($case_id, $massege_ar, $massege_en)
    {
        $case = CharityCase::find($case_id);

        if ($case->priority == 'high') {
            $users = User::with('devices')->get();
        } else {
            $users = User::with('devices')->where('city_id', $case->user->city_id)->get();
        }

        if (!$users->isEmpty()) {
            Notification::send($users, new DatabaseNotification($massege_ar, $massege_en, url('api/cases/show', $case_id), $case_id));

            foreach ($users as $user) {
                if ($user->devices->count() > 0) {
                    foreach ($user->devices as $device) {
                        try {
                            if (!$this->FirebaseNotificationService) {
                                throw new \Exception('FirebaseNotificationService not available');
                            }

                            $this->FirebaseNotificationService->sendNotification(
                                $device->token,
                                'We Care',
                                $user->lang == 'en' ? $massege_en : $massege_ar,
                                ['case_id' => $case_id]
                            );
                        } catch (\Exception $e) {
                            Log::error("Failed to send notification to token: {$device->token}. Error: {$e->getMessage()}");
                            continue;
                        }
                    }
                }
            }
        }

        return;
    }


    public function sendNotificationFromConfirmDonation($donation_id,$massege_ar,$massege_en)
    {
        $donation=Donation::find($donation_id);
        $doner=User::find($donation->doner_id);
        if ($donation->case_id) {
            $case=CharityCase::find($donation->case_id);
        }

        Notification::send($doner,new DatabaseNotification($massege_ar,$massege_en,$donation->case_id ? url('api/cases/show',$case->id): null,$donation->case_id??null));

        if ($doner->devices->count() > 0) {
            foreach ($doner->devices as $device) {
                try{
                    $this->FirebaseNotificationService->sendNotification($device->token, 'We Care', $doner->lang=='en' ? $massege_en : $massege_ar, ['alkasaby'=>'alkasaby']);
                }catch(\Exception $e){
                    Log::error("Failed to send notification to token: {$device->token}. Error: {$e->getMessage()}");
                    continue;
                }


            }
        }

        return ;
    }

}
