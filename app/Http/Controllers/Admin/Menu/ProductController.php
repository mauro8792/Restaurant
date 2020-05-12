<?php

namespace App\Http\Controllers\Admin\Menu;
use App\Model\Product;
use App\Model\Category;
use File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = Category::find($request->id);
        $products = $category->products; 
    	return view('admin.products.index')->with(compact('products','category')); // listado
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $category = Category::find($request->id);
    	return view('admin.products.create')->with(compact('category')); // formulario de registro
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Es necesario ingresar un nombre para el producto.',
            'name.min' => 'El nombre del producto debe tener al menos 3 caracteres.',
            'description.required' => 'La descripción corta es un campo obligatorio.',
            'description.max' => 'La descripción corta solo admite hasta 200 caracteres.',
            'price.required' => 'Es obligatorio definir un precio para el producto.',
            'price.numeric' => 'Ingrese un precio válido.',
            'price.min' => 'No se admiten valores negativos.'
        ];
        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|max:200',
            'price' => 'required|numeric|min:0'
        ];
        $this->validate($request, $rules, $messages);

    	// registrar el nuevo producto en la bd
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id == 0 ? null : $request->category_id;
        $product->save(); // INSERT
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = public_path() . '/images/products';
            $fileName = uniqid() . '-' . $file->getClientOriginalName();
            $moved = $file->move($path, $fileName);

            if ($moved) {
                $product->image = $fileName;
                $product->save(); // UPDATE
            }
        }
         return redirect('/admin/categories/'.$request->category_id.'/products');
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
    public function edit($id)
    {        
        $categories = Category::orderBy('name')->get();
        $product = Product::find($id);
        return view('admin.products.edit')->with(compact('product', 'categories','status')); // form de edición
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $messages = [
            'name.required' => 'Es necesario ingresar un nombre para el producto.',
            'name.min' => 'El nombre del producto debe tener al menos 3 caracteres.',
            'description.required' => 'La descripción corta es un campo obligatorio.',
            'description.max' => 'La descripción corta solo admite hasta 200 caracteres.',
            'price.required' => 'Es obligatorio definir un precio para el producto.',
            'price.numeric' => 'Ingrese un precio válido.',
            'price.min' => 'No se admiten valores negativos.'
        ];
        $rules = [
            'name' => 'required|min:3',
           // 'description' => 'required|max:200',
            'price' => 'required|numeric|min:0'
        ];
        $this->validate($request, $rules, $messages);
        
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->category_id = $request->category_id == 0 ? null : $request->category_id;
        $product->save();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = public_path() . '/images/products';
            $fileName = uniqid() . '-' . $file->getClientOriginalName();
            $moved = $file->move($path, $fileName);

            // update category
            if ($moved) {
                $previousPath = $path . '/' . $product->image;

                $product->image = $fileName;
                $saved = $product->save(); // UPDATE

                if ($saved)
                    File::delete($previousPath);
            }
        }
        
        $product->save(); // UPDATE

        return redirect('/admin/categories/'.$request->category_id.'/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
    
        try {
            $product=Product::findOrFail($request->id);
            $file_path = public_path()."/images/products/".$product->image;
            \File::delete($file_path);
            $product->delete();
            $notification = "El registro se eliminó correctamente";
        } catch (QueryException $exception){
            $notification = "Error al eliminar el registro".$exception->getMessage();
        }

        return back()->with(compact('notification'));



    }
}
