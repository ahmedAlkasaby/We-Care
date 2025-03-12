<?php

namespace App\Models;



class Setting extends MainModel
{

    protected $fillable=['site_title','site_email','site_phone','facebook','twitter','instagram','linkedin',
    'gmail','whatsapp','site_language','address'];
}
