<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
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
                'description'=>$row-> description,
                'image' => ($row->image !== 'imagen-no-disponible.jpg') ? asset('storage'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'categories'.DIRECTORY_SEPARATOR.$row->image) : asset("/logo/{$row->image}"),
                'slug'=>$row-> slug,
                
                
            ];
        });
    }
}
