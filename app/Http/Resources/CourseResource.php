<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'subtitulo' => $this->subtitulo,
            'description' => $this->description,

            // URL completa para Vue
            'image' => $this->image,
            'image_url' => $this->image
                ? asset('storage/uploads/courses/' . $this->image)
                : null,
        ];
    }
}
