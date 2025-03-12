<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Notification extends Model
{

    protected $fillable=[
        'id',
        'type',
        'notifiable_type',
        'notifiable_id',
        'data',
        'read_at'
    ];


    public function msgLang($lang = null)
    {
        if ($lang == null) {
            $user = Auth::user();
            $langUser = $user ? $user->lang : app()->getLocale();
            $messages=json_decode($this->data)->messages;
            $defoultLang=app()->getLocale();
            return json_decode($messages)->$langUser ?? json_decode($this->name)->$defoultLang;
        } else {
            $messages=json_decode($this->data)->messages;
            return json_decode($messages)->$lang ;
        }

    }
    public function caseId(){
        return json_decode($this->data)->case_id;
    }

}
