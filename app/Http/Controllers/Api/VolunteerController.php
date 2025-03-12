<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VolunteerResource;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class VolunteerController extends MainController
{
    public function index(){
        $volunteers=User::where('role','volunteer')->get();
        $data=[
            'volunteers'=>VolunteerResource::collection($volunteers)
        ];

        return $this->sendData($data);
    }

    public function show($id)
    {

        try {

            $volunteer = User::with('CharityCases')->find($id);
            $data = [
                'volunteer' => new VolunteerResource($volunteer)
            ];

            return $this->sendData($data);

        } catch (ModelNotFoundException $e) {

            return response()->json([
                'message' => 'The volunteer not found'
            ], 404);
        }
    }

}
