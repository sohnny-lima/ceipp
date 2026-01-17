<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Helpers\UploadFileHelper;
use App\Http\Requests\CourseRequest;
use App\Http\Resources\CourseResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CourseCollection;
use Symfony\Component\HttpFoundation\Request;

class CourseController extends Controller
{
    public function index()
    {
        return view('courses.index');
    }
    public function columns()
    {
        return [
            'titulo' => 'Nombre del Curso'
        ];
    }
    public function records(Request $request)
    {
        $records = Course::where($request->column, 'like', "%{$request->value}%");
        return new CourseCollection($records->paginate(20));
        // return new CourseCollection(
        //     Course::orderBy('id', 'desc')->get()
        // );

    }

    public function record($id)
    {
        $record = Course::findOrFail($id);
        return new CourseResource($record);
    }

    public function store(CourseRequest $request)
    {
    $id = $request->input('id');

    // ahora es Course
    $course = Course::firstOrNew(['id' => $id]);
    $course->fill($request->all());

    $temp_path = $request->input('temp_path');

    if ($temp_path) {

        $directory = 'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'courses' . DIRECTORY_SEPARATOR;

        $prefix_name = $course->id ?? 'course';
        $file_name_old = $request->input('image');
        $file_name_old_array = explode('.', $file_name_old);

        $file_content = file_get_contents($temp_path);
        $datenow = date('YmdHis');

        $file_name = $prefix_name . '-' . $datenow . '.' . end($file_name_old_array);

        UploadFileHelper::checkIfValidFile($file_name, $temp_path, true);

        Storage::put($directory . $file_name, $file_content);

        // columna image en courses
        $course->image = $file_name;

    } else if (
        !$request->input('image') &&
        !$request->input('temp_path') &&
        !$request->input('image_url')
    ) {
        $course->image = 'imagen-no-disponible.jpg';
    }

    $course->save();

    return [
        'success' => true,
        'message' => $id
            ? 'Curso editado con éxito'
            : 'Curso registrado con éxito'
    ];
    }

     public function upload(CourseRequest $request)
    {
      //subir imagen
        $validate_upload = UploadFileHelper::validateUploadFile($request, 'file', 'jpg,jpeg,png,gif,svg');
        if (!$validate_upload['success']) {
            return $validate_upload;
        }
        if ($request->hasFile('file')) {
            $new_request = [
                'file' => $request->file('file'),
                'type' => $request->input('type'),
            ];
            return $this->upload_image($new_request);
        }
        return [
            'success' => false,
            'message' =>  __('app.actions.upload.error'),
        ];
    }


   function upload_image($request)
{
    $file = $request['file'];
    $type = $request['type']; // courses

    $filename = uniqid() . '.' . $file->getClientOriginalExtension();

    // guardar temporalmente en storage
    $path = $file->storeAs('temp/courses', $filename, 'public');

    return [
        'success' => true,
        'data' => [
            'filename'  => $filename,
            'temp_path' => storage_path('app/public/' . $path),
            'temp_image'=> asset('storage/' . $path),
        ]
    ];
}

    public function destroy($id)
{
    $course = Course::findOrFail($id);
    $course->delete();

    return [
        'success' => true,
        'message' => 'Curso eliminado con éxito',
    ];
}
}
