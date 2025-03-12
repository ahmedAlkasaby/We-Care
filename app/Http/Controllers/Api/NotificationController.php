<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationCollection;
use App\Http\Resources\NotificationResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends MainController
{

    public function index()
    {
        $auth = Auth::guard('api')->user();
        $user = User::find($auth->id);

        $notifications = $user->unreadNotifications()->paginate(10);

        $user->unreadNotifications->markAsRead();

        return $this->sendData(new NotificationCollection($notifications), 'Notifications fetched successfully.');
    }

}
