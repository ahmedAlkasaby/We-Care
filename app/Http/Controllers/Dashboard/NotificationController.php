<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CharityCase;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    public function index()
    {
        $auth=Auth::user();
        $admin=User::find($auth->id);
        $notifications = $admin->unreadNotifications()->paginate(10);

        return view('admin.notification.index', compact('notifications'));
    }



    public function makeAsRead($id)
    {
        $notification = Notification::findOrFail($id);

        $notification->update([
            'read_at' => now()
        ]); 
        return response()->json(['success' => true]);
    }




}
