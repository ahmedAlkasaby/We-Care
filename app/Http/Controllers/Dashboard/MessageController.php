<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Notifications\NotifyUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;

class MessageController extends Controller
{
   
    public function index(){
        $messages = Message::orderBy('read')->paginate(50);
        return view('admin.message.index',compact('messages'));
    }

    public function show($id){
        $message = Message::findOrFail($id);
        $message->read = true;
        $message->save();

        return view('admin.message.show',compact('message'));
    }
    public function sendMessage($id,Request $request){
        $request->validate([
            "title"=>"required|string|max:255",
            "body"=>"required|string"
        ]);
        $message=Message::findOrFail($id);
        Notification::route('mail', $message->email)
        ->notify(new NotifyUser($request->body, $message->name, $request->title));
        session()->flash('success',__('site.messageSent'));
        return redirect()->back();
    }
}
