<?php

use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CertificateVerifyController; // ✅ NUEVO

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $courses = Course::all();
    return view('page.index', compact('courses'));
});

// ✅ RUTA PÚBLICA PARA VERIFICAR CERTIFICADO POR DNI
Route::get('/certificates/verify', [CertificateVerifyController::class, 'verify']);

Auth::routes([
    'register' => false,
    'verify'   => false
]);

Route::middleware(['auth'])->group(function () {

    Route::prefix('categories')->group(function () {
        Route::get('', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/records', [CategoryController::class, 'records']);
        Route::get('/columns', [CategoryController::class, 'columns']);
        Route::post('', [CategoryController::class, 'store']);
        Route::get('/record/{category}', [CategoryController::class, 'record']);
        Route::delete('/{category}', [CategoryController::class, 'destroy']);
    });

    Route::prefix('courses')->group(function () {
        Route::get('', [CourseController::class, 'index'])->name('courses.index');
        Route::get('/records', [CourseController::class, 'records']);
        Route::get('/columns', [CourseController::class, 'columns']);
        Route::post('', [CourseController::class, 'store']);
        Route::get('/record/{course}', [CourseController::class, 'record']);
        Route::delete('/{course}', [CourseController::class, 'destroy']);
        Route::post('/upload', [CourseController::class, 'upload'])->name('courses.upload');
    });

    Route::prefix('users')->group(function () {
        Route::get('', [UserController::class, 'index'])->name('users.index');
        Route::get('/records', [UserController::class, 'records']);
        Route::get('/tables', [UserController::class, 'tables']);
        Route::get('/columns', [UserController::class, 'columns']);
        Route::post('', [UserController::class, 'store']);
        Route::get('/record/{user}', [UserController::class, 'record']);
        Route::get('/search/{number}', [UserController::class, 'search']);
        Route::post('/save', [UserController::class, 'save']);
        Route::delete('/{user}', [UserController::class, 'destroy']);
    });

    Route::prefix('certificates')->group(function () {
        Route::get('', [CertificateController::class, 'index'])->name('certificates.index');
        Route::get('/records', [CertificateController::class, 'records']);
        Route::get('/tables', [CertificateController::class, 'tables']);
        Route::get('/columns', [CertificateController::class, 'columns']);
        Route::post('', [CertificateController::class, 'store']);
        Route::get('/record/{certificate}', [CertificateController::class, 'record']);
        Route::delete('/{certificate}', [CertificateController::class, 'destroy']);
        Route::post('/upload', [CertificateController::class, 'upload']);
    });

});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
