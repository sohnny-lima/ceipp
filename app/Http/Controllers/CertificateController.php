<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Helpers\UploadFileHelper;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CertificateRequest;
use App\Http\Resources\CertificateResource;
use App\Http\Resources\CertificateCollection;

class CertificateController extends Controller
{
    public function index()
    {
        return view('certificates.index');
    }

    public function columns()
    {
        return [
            'description' => 'Descripción',
        ];
    }

    public function records(Request $request)
    {
        $records = Certificate::query()
            ->with('user:id,name,number')
            ->when($request->value, function ($q) use ($request) {
                $q->where('description', 'like', "%{$request->value}%");
            })
            ->latest();

        return new CertificateCollection($records->paginate(20));
    }

    public function tables()
    {
        $users = User::where('type', 'user')
            ->get()
            ->transform(function ($row) {
                return [
                    'id' => $row->id,
                    'name' => $row->name,
                ];
            });

        return [
            "success" => true,
            "data" => $users
        ];
    }

    public function store(CertificateRequest $request)
    {
        $id = $request->input('id');

        $certificate = Certificate::firstOrNew(['id' => $id]);

        // ✅ Validar alumno seleccionado
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $certificate->user_id = $request->user_id;
        $certificate->description = $request->description;

        // Si hay archivo temporal, mover a public/uploads/certificates/
        $temp_path = $request->input('temp_path');

        if ($temp_path) {
            $file_name_old = $request->input('file');
            $extension = strtolower(pathinfo($file_name_old, PATHINFO_EXTENSION));

            $datenow = date('YmdHis');
            $prefix_name = $certificate->id ?? 'certificate';
            $file_name = $prefix_name . '-' . $datenow . '.' . $extension;

            // validar archivo
            $allowed_mimes = 'jpg,jpeg,png,gif,svg,webp,pdf,doc,docx';
            $allowed_types = [
                'image/jpg',
                'image/jpeg',
                'image/png',
                'image/gif',
                'image/svg',
                'image/webp',
                'application/pdf',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            ];

            $is_image = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'], true);

            UploadFileHelper::checkIfValidFile(
                $file_name,
                $temp_path,
                $is_image,
                $allowed_mimes,
                $allowed_types
            );

            // ✅ Guardar en public/uploads/certificates/
            $publicDir = public_path('uploads/certificates');
            if (!is_dir($publicDir)) {
                @mkdir($publicDir, 0755, true);
            }

            $file_content = file_get_contents($temp_path);
            file_put_contents($publicDir . DIRECTORY_SEPARATOR . $file_name, $file_content);

            $certificate->file = $file_name;
        }

        $certificate->save();

        return [
            'success' => true,
            'message' => $id ? 'Certificado editado con éxito' : 'Certificado registrado con éxito',
        ];
    }

    public function upload(Request $request)
    {
        $validate = UploadFileHelper::validateUploadFile(
            $request,
            'file',
            'jpg,jpeg,png,gif,svg,webp,pdf,doc,docx'
        );

        if (!$validate['success']) {
            return $validate;
        }

        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $fileName = uniqid() . '.' . $extension;

        // Guardar temporalmente en storage (ok)
        $path = $file->storeAs('certificates/temp', $fileName, 'public');

        return [
            'success' => true,
            'data' => [
                'filename'  => $fileName,
                'extension' => $extension,
                'temp_path' => storage_path('app/public/' . $path),
                'file_url'  => asset('storage/' . $path),
                'is_image'  => in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'], true),
            ],
        ];
    }

    public function record(Certificate $certificate)
    {
        return [
            'data' => new CertificateResource($certificate),
        ];
    }

    public function destroy(Certificate $certificate)
    {
        $certificate->delete();

        return response()->json([
            'success' => true,
            'message' => 'Certificado eliminado'
        ]);
    }
}
