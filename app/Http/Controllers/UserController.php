<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Course;
use App\Http\Resources\UserCollection;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $client;
    protected $parameters;

    public function __construct()
    {
        $token = "rnEYiCVEC2n7oxgHy8kE9im7rFaCkflkCNiBdQEtJxrMf4yWBu";
        $this->client = new Client(['base_uri' => "https://apiperu.info"]);
        $this->parameters = [
            'http_errors' => false,
            'connect_timeout' => 10,
            'verify' => false,
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ],
        ];
    }

    public function index()
    {
        return view('users.index');
    }

    /**
     * Endpoint actual (probablemente protegido por auth en web routes).
     * Consulta a APIPERU por DNI.
     */
    public function search($number)
    {
        $res = $this->client->request('GET', '/api/dni/' . $number, $this->parameters);
        $response = json_decode($res->getBody()->getContents(), true);

        // Si el API falla o no trae success
        if (!is_array($response) || !isset($response['success']) || !$response['success']) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo consultar el DNI'
            ], 404);
        }

        $data = $response['data'] ?? [];

        return response()->json([
            'success' => true,
            'number' => $data['nombres'] ?? null,
            'last_name' => ($data['nombres'] ?? '') . ", " . ($data['apellido_materno'] ?? ''),
            'address' => $data['direccion_completa'] ?? null,
        ]);
    }

    /**
     * ✅ NUEVO: Endpoint público para Landing (SIN login)
     * Ruta: /api/public/users/search/{dni}
     */
    public function searchByDniPublic($dni)
    {
        // Validación básica DNI (Perú: 8 dígitos)
        if (!preg_match('/^\d{8}$/', (string) $dni)) {
            return response()->json([
                'status' => 'error',
                'message' => 'DNI inválido (debe tener 8 dígitos)'
            ], 422);
        }

        // 1) Intentar buscar en tu BD primero (si ya existe registrado)
        // NOTA: en tu modelo usas "number" como DNI (según save()).
        $local = User::where('number', $dni)->first();
        if ($local) {
            return response()->json([
                'status' => 'ok',
                'source' => 'local',
                'data' => [
                    'dni' => $local->number,
                    'nombres' => $local->name ?? null,
                    'direccion' => $local->address ?? null,
                    'telefono' => $local->phone ?? null,
                ]
            ], 200);
        }

        // 2) Si no está en tu BD, consultamos APIPERU
        $res = $this->client->request('GET', '/api/dni/' . $dni, $this->parameters);
        $response = json_decode($res->getBody()->getContents(), true);

        if (!is_array($response) || !($response['success'] ?? false)) {
            return response()->json([
                'status' => 'not_found',
                'message' => 'No se encontró el DNI o no se pudo consultar'
            ], 404);
        }

        $data = $response['data'] ?? [];

        // ⚠️ DEVOLVER SOLO DATA NECESARIA (público)
        return response()->json([
            'status' => 'ok',
            'source' => 'apiperu',
            'data' => [
                'dni' => $dni,
                'nombres' => $data['nombres'] ?? null,
                'apellido_paterno' => $data['apellido_paterno'] ?? null,
                'apellido_materno' => $data['apellido_materno'] ?? null,
                'direccion' => $data['direccion_completa'] ?? null,
            ]
        ], 200);
    }

    /**
     * ✅ NUEVO (Opcional recomendado): tables públicas para Landing
     * Ruta: /api/public/users/tables
     * Si tu landing llama /users/tables y te da 401, apunta a este endpoint.
     */
    public function tablesPublic()
    {
        $courses = Course::orderBy('titulo')->get()->transform(function ($row) {
            return [
                'id' => $row->id,
                'name' => $row->titulo ?? '',
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $courses,
        ], 200);
    }

    public function save(Request $request)
    {
        $users = User::updateOrCreate(
            [
                'number' => $request->input('number')
            ],
            [
                'name' => $request->input('first_name'),
                'address' => $request->input('address'),
                'phone' => $request->input('phone'),
            ]
        );

        return response()->json([
            "success" => true,
            "message" => "Se registrado con éxito"
        ], 200);
    }

    public function savePublic(Request $request)
{
    // Validación básica (ajusta según tus columnas reales)
    $validated = $request->validate([
        'number' => ['required', 'regex:/^\d{8}$/'],
        'first_name' => ['nullable', 'string', 'max:255'],
        'address' => ['nullable', 'string', 'max:255'],
        'phone' => ['nullable', 'string', 'max:20'],
        'email' => ['nullable', 'email', 'max:255'],
        'program' => ['nullable'],
    ]);

    User::updateOrCreate(
        ['number' => $validated['number']],
        [
            'name' => $validated['first_name'] ?? null,
            'address' => $validated['address'] ?? null,
            'phone' => $validated['phone'] ?? null,
            // Si tu tabla users tiene email, descomenta:
            // 'email' => $validated['email'] ?? null,
            // Si tienes campo program o course_id, lo ajustamos según tu BD
        ]
    );

    return response()->json([
        'success' => true,
        'message' => 'Se registró con éxito'
    ], 200);
}


    public function store(UserRequest $request)
    {
        $id = $request->input('id');
        $user = User::firstOrNew(['id' => $id]);
        $user->fill($request->all());
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return [
            'success' => true,
            'message' => ($id) ? 'User editado con éxito' : 'User registrado con éxito'
        ];
    }

    public function tables()
    {
        $courses = Course::orderBy('titulo')->get()->transform(function ($row) {
            return [
                'id' => $row->id,
                'name' => $row->titulo ?? '',
            ];
        });

        return [
            'success' => true,
            'data' => $courses,
        ];
    }

    public function records(UserRequest $request)
    {
        $records = User::where($request->column, 'like', "%{$request->value}%");
        return new UserCollection($records->paginate(20));
    }

    public function record($id)
    {
        $record = User::findOrFail($id);
        return [
            'data' => $record
        ];
    }

    public function destroy($id)
    {
        $person = User::findOrFail($id);
        $person->delete();

        return [
            'success' => true,
            'message' => 'User eliminado con exito',
        ];
    }
}
