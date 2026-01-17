<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'description',
        'image',
        'titulo',
        'subtitulo',
    ];

    /**
     * ✅ URL pública de la imagen del curso.
     * - Si existe "image" lo busca en storage/uploads/courses/
     * - Si no existe, devuelve un placeholder.
     */
    public function getImageUrlAttribute(): string
    {
        if (!empty($this->image)) {
            return asset('storage/uploads/courses/' . $this->image);
        }

        // fallback default
        return asset('assets/gestion_publica.png');
    }
}
