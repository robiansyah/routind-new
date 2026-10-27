<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
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
        $data = Faq::all();

        return view('admin.faq.index',[
            'data' => $data,
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
            'title' => 'required',
            'description' => 'required',
        ]);

        Faq::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        $request->session()->flash('alert-success', 'Faq berhasil dibuat');
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
        $data = Faq::findOrFail($id);
        return response()->json([
            "status"=>"success",
            "data"=> $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
        ]);

        $faq = Faq::findOrFail($id);
        $faq->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        $request->session()->flash('alert-success', 'Faq berhasil diubah');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $data = Faq::findOrFail($id);
        $data->delete();

        $request->session()->flash('alert-success', 'Faq berhasil dihapus');
        return redirect()->back();
    }
}
