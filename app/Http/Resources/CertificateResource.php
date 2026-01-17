<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CertificateResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'description' => $this->description,
            'file'        => $this->file,

            // ✅ ruta real (public/uploads/certificates/)
            'file_url'    => $this->file
                ? asset('uploads/certificates/' . $this->file)
                : null,

            'user_id'     => $this->user_id,
            'user_name'   => $this->user ? ($this->user->name ?? null) : null,
            'user_number' => $this->user ? ($this->user->number ?? null) : null,
            'created_at'  => $this->created_at,
        ];
    }
}
