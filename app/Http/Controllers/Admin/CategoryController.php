<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademyCategory;

class CategoryController extends Controller
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
        $categories = AcademyCategory::withCount('events')->get();

        return view('admin.category.index',[
            'data' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
        ]);

        AcademyCategory::create([
            'name' => $request->name,
            'slug' => (!empty($request->slug)) ? $request->slug : strtolower(str_replace(' ', '-', $request->name)),
            'icon' => (!empty($request->icon)) ? $request->icon : 'calendar',
        ]);

        $request->session()->flash('alert-success', 'Kategori berhasil dibuat');
        return redirect()->back();
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
        ]);

        $academy_category = AcademyCategory::findOrFail($id);
        $academy_category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'icon' => $request->icon,
        ]);

        $request->session()->flash('alert-success', 'Kategori berhasil diubah');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
