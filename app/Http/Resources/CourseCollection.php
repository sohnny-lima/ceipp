<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CourseCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($course) {
                return [
                    'id' => $course->id,
                    'titulo' => $course->titulo,
                    'subtitulo' => $course->subtitulo,
                    'description' => $course->description,
                    'image_url' => $course->image
                        ? (
                            $course->image !== 'imagen-no-disponible.jpg'
                                ? asset('storage/uploads/courses/' . $course->image)
                                : asset('/logo/' . $course->image)
                        )
                        : null,
                ];
            }),
        ];
    }
}
