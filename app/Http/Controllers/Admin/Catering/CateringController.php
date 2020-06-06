<?php

namespace App\Http\Controllers\Admin\Catering;
use App\Model\Catering;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;

class CateringController extends Controller
{
    public function index()
    {
        $caterings = Catering::all();
        return view('admin.caterings.index')->with(compact('caterings'));
    }
    public function create()
    {
        return view('admin.caterings.create');
    }
    public function store(Request $request)
    {   
        
        $catering = new Catering();
        $catering->name = $request->input('name');
        $catering->description = $request->input('description');
        $catering->price = $request->input('price');
        $catering->save(); 

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = public_path() . '/images/caterings';
            $fileName = uniqid() . '-' . $file->getClientOriginalName();
            $moved = $file->move($path, $fileName);

            // update category
            if ($moved) {
                $catering->image = $fileName;
                $catering->save(); // UPDATE
            }
        }
       

        return redirect('/admin/caterings');
    }
    public function edit($id)
    {
        $catering = Catering::find($id)->get();
        return view('admin.caterings.edit')->with(compact('catering'));
    }
    public function update(Request $request)
    {
        
        $catering = Catering::find($request->id);
        $catering->name = $request->input('name');
        $catering->description = $request->input('description');
        $catering->price = $request->input('price');
        $catering->save();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = public_path() . '/images/caterings';
            $fileName = uniqid() . '-' . $file->getClientOriginalName();
            $moved = $file->move($path, $fileName);

            // update catering
            if ($moved) {
                $previousPath = $path . '/' . $catering->image;

                $catering->image = $fileName;
                $saved = $catering->save(); // UPDATE

                if ($saved)
                    File::delete($previousPath);
            }
        }

        return redirect('/admin/caterings');
    }
    public function destroy(Request $request)
    {  
        try {
            $cat = Catering::findOrFail($request->id);
            $file_path = public_path()."/images/caterings/".$cat->image;
            \File::delete($file_path);
            $cat->delete();
            $notification = "El registro se eliminó correctamente";
        } catch (QueryException $exception){
            $notification = "Error al eliminar el registro".$exception->getMessage();
        }
        return back()->with(compact('notification'));
    }
}
