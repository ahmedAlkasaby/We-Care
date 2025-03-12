<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends MainController
{
    public function index(){
        $pages=Page::where('active',1)->get();

        return $this->sendData(PageResource::collection($pages));
    }

    public function show($id){
        $page=Page::find($id);
        if($page){
            return $this->sendData(new PageResource($page));
        }else{
            return $this->sendError('the page not found');
        }
    }
}
