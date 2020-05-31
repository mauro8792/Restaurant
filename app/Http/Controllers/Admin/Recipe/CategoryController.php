<?php

namespace App\Http\Controllers\Admin\Recipe;
use App\Model\RecipeCategory;
use App\Model\Recipe;
use File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = RecipeCategory::all();
        
    	return view('admin.recipes.categories.index')->with(compact('categories')); // listado
    }
    public function create()
    {
    	return view('admin.recipes.categories.create'); // formulario de registro
    }
    public function store(Request $request)
    {
        $category = RecipeCategory::create($request->only('name', 'description'));
        

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = public_path() . '/images/recipes/categories';
            $fileName = uniqid() . '-' . $file->getClientOriginalName();
            $moved = $file->move($path, $fileName);

            // update category
            if ($moved) {
                $category->image = $fileName;
                $category->save(); // UPDATE
            }
        }

        return redirect('/admin/recipes/categories');
    }
    public function destroy(Request $request)
    {  
        
        $cat = RecipeCategory::find($request->id);
        if(count($cat->recipes) == 0){
            try {
                //$cat = Category::findOrFail($request->id);
                $file_path = public_path()."/images/recipes/categories/".$cat->image;
                \File::delete($file_path);
                $cat->delete();
                $notification = "El registro se eliminó correctamente";
            } catch (QueryException $exception){
                $notification = "Error al eliminar el registro".$exception->getMessage();
            }
            return back()->with(compact('notification'));
        }else{
            $notification = "No se puede eliminar la categoria por que tiene recetas cargadas";
            return back()->with(compact('notification'));
        }

    }

    public function update(Request $request, RecipeCategory $category)
    {
        //$this->validate($request, Category::$rules, Category::$messages);

        $category->update($request->only('name', 'description'));
        //dd($request->file('image'));
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = public_path() . '/images/recipes/categories/';
            $fileName = uniqid() . '-' . $file->getClientOriginalName();
            $moved = $file->move($path, $fileName);

            // update category
            if ($moved) {
                $previousPath = $path . '/' . $category->image;

                $category->image = $fileName;
                //dd($fileName);
                $saved = $category->save(); // UPDATE

                if ($saved)
                    File::delete($previousPath);
            }
        }

        return redirect('/admin/recipes/categories');
    }

}
