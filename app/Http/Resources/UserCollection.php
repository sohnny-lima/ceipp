<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
   public function toArray($request)
    {
       return $this->collection->transform(function ($row, $key) {
            return[
                'id'=>$row-> id,
                'first_name'=>$row-> first_name,
                'last_name' =>$row-> last_name,
                'number'=>$row-> numberid,
                'address'=>$row-> address,
            
            ];
        });
    }
}
