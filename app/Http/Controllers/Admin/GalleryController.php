<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Spatie\Image\Image;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Gallery::orderBy('created_at', 'asc')->get();

        return view('admin.gallery.index',[
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'type' => 'required',
            'name' => 'required',
            'image' => 'required',
        ]);

        $cek = Gallery::where('type', $request->type)->count();
        if($cek < 4){
            $image = $request->file('image');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $folder = 'galleries';
            $image->move($folder,$image_name);

//            Image::load('galleries/'.$image_name)
//                ->width(720)
//                ->save();

            Gallery::create([
                'type' => $request->type,
                'name' => $request->name,
                'image' => $image_name,
            ]);

            $request->session()->flash('alert-success', 'Galeri berhasil dibuat');
            return redirect()->route('admin.gallery.index');
        }else{
            $request->session()->flash('alert-danger', 'Maksimal 4 Galeri setiap kategori');
            return redirect()->route('admin.gallery.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);

        return view('admin.gallery.edit',[
            'gallery' => $gallery,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
//            'type' => 'required',
            'name' => 'required',
        ]);

        $gallery = Gallery::findOrFail($id);
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $folder = 'galleries';
            $image->move($folder,$image_name);

//            Image::load('galleries/'.$image_name)
//                ->width(720)
//                ->save();

            $image_old = $gallery->image;
            $image_path = public_path('galleries/'.$image_old);
            if(file_exists($image_path)){
                unlink($image_path);
            }

            //update product with new image
            $gallery->image = $image_name;
            $gallery->save();

        }

        $gallery->update([
//            'type' => $request->type,
            'name' => $request->name,
        ]);

        $request->session()->flash('alert-success', 'Galeri berhasil dibuat');
        return redirect()->route('admin.gallery.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $data = Gallery::findOrFail($id);
        Storage::delete('public/galleries/'.$data->image);
        $data->delete();

        $request->session()->flash('alert-success', 'Galery berhasil dihapus');
        return redirect()->back();
    }
}
