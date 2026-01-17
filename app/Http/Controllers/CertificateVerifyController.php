<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Certificate;

class CertificateVerifyController extends Controller
{
    public function verify(Request $request)
    {
        $dni = trim((string) $request->query('dni'));

        if ($dni === '') {
            return response()->json([
                'ok' => false,
                'message' => 'DNI requerido'
            ], 422);
        }

        if (!preg_match('/^\d{8}$/', $dni)) {
            return response()->json([
                'ok' => false,
                'message' => 'DNI inválido (debe tener 8 dígitos)'
            ], 422);
        }

        $user = User::where('number', $dni)->first();

        if (!$user) {
            return response()->json([
                'ok' => false,
                'message' => 'No se encontró un usuario con ese DNI'
            ], 404);
        }

        $cert = Certificate::where('user_id', $user->id)->latest()->first();

        if (!$cert) {
            return response()->json([
                'ok' => false,
                'message' => 'El usuario existe pero no tiene certificado registrado'
            ], 404);
        }

        // ✅ public/uploads/certificates/
        $fileUrl = $cert->file ? asset('uploads/certificates/' . $cert->file) : null;

        return response()->json([
            'ok' => true,
            'data' => [
                'dni' => $user->number,
                'name' => $user->name ?? '—',
                'certificate_id' => $cert->id,
                'description' => $cert->description ?? '—',
                'date' => optional($cert->created_at)->toDateString(),
                'file' => $cert->file,
                'pdf_url' => $fileUrl,
                'file_url' => $fileUrl,
            ]
        ], 200);
    }
}
