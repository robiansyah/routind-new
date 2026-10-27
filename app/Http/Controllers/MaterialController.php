<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $id = $request->class_id;
        return view('pengajar.materi.tambah', [
            'class_id' => $id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'name' => 'required',
            'url' => 'required|url:http,https',
        ]);

        Material::create([
            'class_id' => $request->class_id,
            'name' => $request->name,
            'url' => $request->url,
        ]);

        $request->session()->flash('alert-info', 'Materi berhasil ditambahkan');
        return redirect()->route('pengajar.kelas.detail', $request->class_id);
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
        $materi = Material::findOrFail($id);
        return view('pengajar.materi.edit', [
            'materi' => $materi,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'url' => 'required|url:http,https',
        ]);

        $materi = Material::findOrFail($id);
        $materi->update([
            'name' => $request->name,
            'url' => $request->url,
        ]);

        $request->session()->flash('alert-info', 'Materi berhasil diubah');
        return redirect()->route('pengajar.kelas.detail', $materi->class_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $materi = Material::findOrFail($id);
        $materi->delete();

        $request->session()->flash('alert-info', 'Materi berhasil dihapus');
        return redirect()->back();
    }

    public function status(Request $request, $id)
    {
        $materi = Material::findOrFail($id);
        $materi->status = ($materi->status=='Show') ? 'Hide' : 'Show';
        $materi->save();

        $request->session()->flash('alert-success', 'Status Materi berhasil diubah');
        return redirect()->back();
    }
}
