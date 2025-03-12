<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FaqCollection;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends MainController
{
    public function index(Request $request){
        $faqs=Faq::where('active',1)->filter($request->search)->paginate(10);
        return $this->sendData(new FaqCollection($faqs));
    }
}
