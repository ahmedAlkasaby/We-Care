<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id'=>$this->id,
            'case'=>new CaseResource($this->case),
            'donation'=>new DonationResource($this->donation),
            'items'=>$this->items,
            'price'=>$this->price,
            'type'=>$this->type
        ];
    }
}
