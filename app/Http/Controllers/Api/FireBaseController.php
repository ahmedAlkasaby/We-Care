<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Services\FirebaseNotificationService;



class FireBaseController extends Controller
{
    protected $FirebaseNotificationService;

    public function __construct(FirebaseNotificationService $FirebaseNotificationService)
    {
        $this->FirebaseNotificationService = $FirebaseNotificationService;
    }



    public function sendNotification(Request $request)
    {


        $this->FirebaseNotificationService->sendNotification($request->token, $request->title, $request->body, ['data' => 'value']);


        return response()->json(['message' => 'Notification sent']);
    }
}
