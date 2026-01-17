<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Symfony\Component\HttpFoundation\File\File;

class UploadFileHelper

{
    /**
     * Validate a file upload request and return a normalized response.
     */
    public static function validateUploadFile(Request $request, string $field, string $mimes): array
    {
        $validator = Validator::make(
            $request->all(),
            [
                $field => 'required|file|mimes:' . $mimes,
            ]
        );

        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => $validator->errors()->first($field),
            ];
        }

        return ['success' => true];
    }
        public static function getGeneralMimes()
    {
        return 'jpg,jpeg,png,gif,svg';
    }
        public static function getGeneralAllowedFileTypes()
    {
        return ['image/jpg', 'image/jpeg', 'image/png', 'image/gif', 'image/svg'];
    }
        public static function checkIfAllowedExtension($filename, $mimes)
    {
        $extension = self::getFileExtension(mb_strtolower($filename));
        $allowed_extensions = explode(',', $mimes);

        if (!in_array($extension, $allowed_extensions, true)) self::notAllowedFile('Extensión del archivo no permitida.');
    }
        public static function getFileExtension($filename)
    {
        $data = explode('.', $filename);
        return end($data);
    }
        public static function notAllowedFile($message)
    {
        throw new Exception($message);
    }
        public static function checkIfImageCanBeProcessed($temp_path)
    {
        $processed = self::imageCanBeProcessed($temp_path);

        if (!$processed['success']) self::notAllowedFile($processed['message']);
    }
     public static function writeErrorLog($exception, $message = null)
    {
        Log::error(($message ?? '') . "Line: {$exception->getLine()} - Message: {$exception->getMessage()} - File: {$exception->getFile()}");
    }
   public static function imageCanBeProcessed($temp_path)
{
    try {
        $manager = new ImageManager(new Driver());
        $manager->read($temp_path);
        return [
            'success' => true,
        ];
    } catch (Exception $e) {
        $message = 'La imágen no puede ser procesada, verifique si es un archivo válido.';
        self::writeErrorLog($e, $message);
        return [
            'success' => false,
            'message' => $message,
        ];
    }
}
        public static function checkIfValidFile($filename, $temp_path, $is_image = true, $mimes = null, $allowed_file_types = null)
    {

        $error_message = 'Tipo de archivo no permitido';
        $mimes = $mimes ?? self::getGeneralMimes();
        $allowed_file_types = $allowed_file_types ?? self::getGeneralAllowedFileTypes();

        self::checkIfAllowedExtension($filename, $mimes);

        if (!in_array(mime_content_type($temp_path), $allowed_file_types, true)) self::notAllowedFile($error_message);

        $new_file = new File($temp_path);

        $data = [
            'file' => $new_file
        ];
        // dd($data);
        $validator = Validator::make($data, [
            'file' => 'mimes:' . $mimes
        ]);

        if ($validator->fails()) self::notAllowedFile($error_message);

        if ($is_image) self::checkIfImageCanBeProcessed($temp_path);
    }

}