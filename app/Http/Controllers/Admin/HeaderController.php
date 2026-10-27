<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Header;

class HeaderController extends Controller
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
        $data = Header::orderBy('created_at', 'desc')->get();

        return view('admin.header.index',[
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.header.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'image' => 'required',
            'link' => 'required',
        ]);

        // menyimpan data file yang diupload
        $image = $request->file('image');
        $image_name = time().'.'.$image->getClientOriginalExtension();
        $folder = 'img';
        $image->move($folder,$image_name);

        Header::create([
            'name' => $request->name,
            'image' => $image_name,
            'link' => $request->link,
        ]);

        $request->session()->flash('alert-success', 'Header berhasil dibuat');
        return redirect()->route('admin.header.index');
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
        $header = Header::findOrFail($id);

        return view('admin.header.edit',[
            'header' => $header,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'link' => 'required',
//            'image' => 'required',
        ]);

        $header = Header::findOrFail($id);
        if(!empty($request->image)){
            // menyimpan data file yang diupload
            $image = $request->file('image');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $folder = 'img';
            $image->move($folder,$image_name);

            $image_old = $header->image;
            $image_path = public_path('img/'.$image_old);
            if(file_exists($image_path)){
                unlink($image_path);
            }
        }

        $header->update([
            'name' => $request->name,
            'link' => $request->link,
            'image' => (!empty($request->image)) ? $image_name : $header->image,
        ]);

        $request->session()->flash('alert-success', 'Header berhasil dibuat');
        return redirect()->route('admin.header.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        Header::findOrFail($id)->delete();
        $request->session()->flash('alert-success', 'Header berhasil dihapus');
        return redirect()->back();
    }
}
