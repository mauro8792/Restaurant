<?php

namespace App\Http\Controllers\Admin\Menu;
use App\Model\Category;
use File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
    	$categories = Category::orderBy('name')->get();
    	return view('admin.categories.index')->with(compact('categories')); // listado
    }

    public function create()
    {
    	return view('admin.categories.create'); // formulario de registro
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Category::$rules, Category::$messages);

        $category = Category::create($request->only('name', 'description'));       

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = public_path() . '/images/categories';
            $fileName = uniqid() . '-' . $file->getClientOriginalName();
            $moved = $file->move($path, $fileName);

            // update category
            if ($moved) {
                $category->image = $fileName;
                $category->save(); // UPDATE
            }
        }

        return redirect('/admin/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $status = $this->statusArray();
        return view('admin.categories.edit')->with(compact('category','status')); // form de edición
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, Category::$rules, Category::$messages);

        $category->update($request->only('name', 'description'));
        //dd($request->file('image'));
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = public_path() . '/images/categories';
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

        return redirect('/admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {  
       
       $cat = Category::findOrFail($request->id);
        if(sizeof($cat->products) == 0){
            try {
                $cat = Category::findOrFail($request->id);
                $file_path = public_path()."/images/categories/".$cat->image;
                \File::delete($file_path);
                $cat->delete();
                $notification = "El registro se eliminó correctamente";
            } catch (QueryException $exception){
                $notification = "Error al eliminar el registro".$exception->getMessage();
            }
            return back()->with(compact('notification'));
        }else{
            $notification = "No se puede eliminar la categoria por que tiene productos cargados";
            return back()->with(compact('notification'));           
            
        }

    }
    public function changeState ($id){
        $category = Category::find($id);
        if ($category->show == 1) {
            $category->show = 0;
        }else{
            $category->show = 1; 
        }
        $category->save();
        return back();
    }
}
