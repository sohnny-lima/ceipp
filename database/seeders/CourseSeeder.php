<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            ['id'=>1, 'titulo'=>'Gestion Publica', 'subtitulo'=>'Gestion Publica', 'description'=>'<p>Gestion Publica</p>', 'image'=>'course-gestion-publica.png'],
            ['id'=>2, 'titulo'=>'Agropecuaria', 'subtitulo'=>'Agropecuaria', 'description'=>'<p>Agropecuaria</p>', 'image'=>'course-agropecuaria.png'],
            ['id'=>3, 'titulo'=>'Enfermeria', 'subtitulo'=>'Enfermeria', 'description'=>'<p>Enfermeria</p>', 'image'=>'course-enfermeria.png'],
            ['id'=>4, 'titulo'=>'Produccion industrial', 'subtitulo'=>'Produccion industrial', 'description'=>'<p>Produccion industrial</p>', 'image'=>'course-produccion-industrial.png'],
            ['id'=>5, 'titulo'=>'Seguridad', 'subtitulo'=>'Seguridad', 'description'=>'<p>Seguridad</p>', 'image'=>'course-seguridadd.png'],
            ['id'=>6, 'titulo'=>'Gestion social', 'subtitulo'=>'Gestion social', 'description'=>'<p>Gestion social</p>', 'image'=>'course-gestion-social.png'],
            ['id'=>7, 'titulo'=>'Educacion', 'subtitulo'=>'Educacion', 'description'=>'<p>Educacion</p>', 'image'=>'course-educacion.png'],
            ['id'=>8, 'titulo'=>'Derecho', 'subtitulo'=>'Derecho', 'description'=>'<p>Derecho</p>', 'image'=>'course-derecho.png'],
            ['id'=>9, 'titulo'=>'Veterinaria', 'subtitulo'=>'Veterinaria', 'description'=>'<p>Veterinaria</p>', 'image'=>'course-veterinaria.png'],
            ['id'=>10,'titulo'=>'Ingenieria', 'subtitulo'=>'Ingenieria', 'description'=>'<p>Ingenieria</p>', 'image'=>'course-ingenieria.png'],
        ];

        foreach ($courses as $data) {
            Course::updateOrCreate(
                ['id' => $data['id']],
                [
                    'titulo' => $data['titulo'],
                    'subtitulo' => $data['subtitulo'],
                    'description' => $data['description'],
                    'image' => $data['image'],
                ]
            );
        }
    }
}
