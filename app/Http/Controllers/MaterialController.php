<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Material;

class MaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:pengajar,co-pengajar']);
    }

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
        $kelas = $this->ownedClass($request->class_id);

        return view('pengajar.materi.tambah', [
            'class_id' => $kelas->id,
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

        $kelas = $this->ownedClass($request->class_id);

        Material::create([
            'class_id' => $kelas->id,
            'name' => $request->name,
            'url' => $request->url,
        ]);

        $request->session()->flash('alert-info', 'Materi berhasil ditambahkan');
        return redirect()->route('pengajar.kelas.detail', $kelas->id);
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
        $materi = $this->ownedMaterial($id);

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

        $materi = $this->ownedMaterial($id);
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
    public function destroy(Request $request, string $id)
    {
        $materi = $this->ownedMaterial($id);
        $materi->delete();

        $request->session()->flash('alert-info', 'Materi berhasil dihapus');
        return redirect()->back();
    }

    public function status(Request $request, $id)
    {
        $materi = $this->ownedMaterial($id);
        $materi->status = ($materi->status=='Show') ? 'Hide' : 'Show';
        $materi->save();

        $request->session()->flash('alert-success', 'Status Materi berhasil diubah');
        return redirect()->back();
    }

    /**
     * A class the signed-in teacher or co-teacher runs. 404 for anyone else's class.
     */
    private function ownedClass($classId): Kelas
    {
        $userId = auth()->id();

        return Kelas::whereKey($classId)
            ->where(fn ($query) => $query->where('user_id', $userId)->orWhere('co_id', $userId))
            ->firstOrFail();
    }

    /**
     * A material that belongs to one of the signed-in teacher's classes.
     */
    private function ownedMaterial($id): Material
    {
        $materi = Material::findOrFail($id);
        $this->ownedClass($materi->class_id);

        return $materi;
    }
}
