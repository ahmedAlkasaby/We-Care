<?php
namespace App\Traits;

use App\Models\CharityCase;
use App\Models\Donation;
use App\Models\User;
use App\Notifications\DatabaseNotification;
use App\Services\FirebaseNotificationService;
use Illuminate\Support\Facades\Notification;


trait NotificationTrait{

    protected $FirebaseNotificationService;

    public function __construct(FirebaseNotificationService $FirebaseNotificationService)
    {
        $this->FirebaseNotificationService = $FirebaseNotificationService;
    }

    public function sendNotificationFromCase($case_id,$massege_ar,$massege_en)
    {
        $case=CharityCase::find($case_id);
        if($case -> priority == 'high'){
            $users=User::with('devices')->where('role','doner')->get();
        }else{
            $users=User::with('devices')->where('city_id',$case->user->city_id)->where('role','doner')->get();
        }



        Notification::send($users,new DatabaseNotification($massege_ar,$massege_en,url('api/cases/show',$case_id)));
        // dd($users);
        foreach ($users as $user) {
            foreach ($user->devices as $device) {
                $this->FirebaseNotificationService->sendNotification($device->token, 'We Care', $user->lang=='en' ? $massege_en : $massege_ar, ['alkasaby'=>'alkasaby']);
            }
        }
        return ;
    }
    public function sendNotificationFromConfirmDonation($donation_id,$massege_ar,$massege_en)
    {
        $donation=Donation::find($donation_id);
        $doner=User::find($donation->doner_id);
        if ($donation->case_id) {
            $case=CharityCase::find($donation->case_id);
        }

        Notification::send($doner,new DatabaseNotification($massege_ar,$massege_en,$donation->case_id ? url('api/cases/show',$case->id): null));


        foreach ($doner->devices as $device) {
            $this->FirebaseNotificationService->sendNotification($device->token, 'We Care', $doner->lang=='en' ? $massege_en : $massege_ar, ['alkasaby'=>'alkasaby']);
        }

        return ;
    }



}

