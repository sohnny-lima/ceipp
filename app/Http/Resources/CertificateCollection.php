<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CertificateCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => CertificateResource::collection($this->collection),
        ];
    }
}
