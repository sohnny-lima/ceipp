<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Categoria;
use App\Helpers\UploadFileHelper;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoriaRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoriaResource;
use App\Http\Resources\CategoryCollection;


class CategoryController extends Controller
{
    public function index()
    {
    return view('categories.index');
    }

    public function records(CategoryRequest $request)
    {
        $records = Category::where($request->column,'like',"%{$request->value}%");
        return new CategoryCollection($records->paginate(20));
    }

     public function record($id)
    {
    $record = Category::findOrFail($id);
    return [
        'data' => $record
    ];
    }

   public function store(CategoryRequest $request)
   {
    $id = $request->input('id');

    $category = Category::firstOrNew(['id' => $id]);
    $category->fill($request->validated());
    $category->save();

    return [
        'success' => true,
        'message' => $id
            ? 'Category editado con éxito'
            : 'Category registrado con éxito'
    ];
   }


  public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return [
            'success' => true,
            'message' => 'Category eliminado con exito',
        ];
    }
}
