<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCaseResource;
use App\Models\CategoryCase;
use Illuminate\Http\Request;

class CategoryCaseController extends MainController
{
    public function index(){

        $categories=CategoryCase::where('active',1)->paginate(5);
        $data=[
            'categories'=>CategoryCaseResource::collection($categories)
        ];

        return $this->sendData($data);
    }

    public function show($id){
        $category=CategoryCase::with('cases')->find($id);
        if($category){
            $data=new CategoryCaseResource($category);
            return $this->sendData($data);
        }else{
            return $this->sendError('the category not found');
        }
    }
}
