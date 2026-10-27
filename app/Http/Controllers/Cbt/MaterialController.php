<?php

namespace App\Http\Controllers\Cbt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;

class MaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get materials
        $materials = Material::when(request()->q, function($materials) {
            $materials = $materials->where('title', 'like', '%'. request()->q . '%');
        })->latest()->paginate(10);

        //append query string to pagination links
        $materials->appends(['q' => request()->q]);

        //render with inertia
        return inertia('Admin/Materials/Index', [
            'materials' => $materials,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Admin/Materials/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate request
        $request->validate([
            'title'         => 'required',
            'type'          => 'required',
        ]);

        if($request->type=='file'){
            $file = $request->file('description');
            $file_name = time().'.'.$file->getClientOriginalExtension();
            $folder = 'uploads';
            $file->move($folder,$file_name);
        }
        //create material
        Material::create([
            'title'         => $request->title,
            'type'          => $request->type,
            'description'   => ($request->type=='file') ? $file_name : $request->description,
        ]);

        //redirect
        return redirect()->route('admin.materials.index');
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
    public function edit(string $id)
    {
        //get material
        $material = Material::findOrFail($id);

        //render with inertia
        return inertia('Admin/Materials/Edit', [
            'material' => $material,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Material $material)
    {
        //validate request
        $request->validate([
            'title'         => 'required',
            'type'          => 'required',
        ]);

        if($request->type=='file'){
            if(!empty($request->description)){
                $file = $request->file('description');
                $file_name = time().'.'.$file->getClientOriginalExtension();
                $folder = 'uploads';
                $file->move($folder,$file_name);
            }
        }

        //update material
        $material->update([
            'title'          => $request->title,
            'type'          => $request->type,
            'description'   => ($request->type=='file') ? $file_name : $request->description,
        ]);

        //redirect
        return redirect()->route('admin.materials.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get material
        $material = Material::findOrFail($id);

        //delete material
        $material->delete();

        //redirect
        return redirect()->route('admin.materials.index');
    }
}
