<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partnership;

class PartnershipController extends Controller
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
        $data = Partnership::orderBy('created_at', 'desc')->lazy();

        return view('admin.partnership.index',[
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.partnership.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'logo' => 'required',
        ]);

        // menyimpan data file yang diupload
        $logo = $request->file('logo');
        $logo_name = time().'.'.$logo->getClientOriginalExtension();
        $folder = 'img';
        $logo->move($folder,$logo_name);

        Partnership::create([
            'name' => $request->name,
            'logo' => $logo_name,
        ]);

        $request->session()->flash('alert-success', 'Partnership berhasil dibuat');
        return redirect()->route('admin.partnership.index');
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
        $partnership = Partnership::findOrFail($id);

        return view('admin.partnership.edit',[
            'partnership' => $partnership,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
//            'logo' => 'required',
        ]);

        $partnership = Partnership::findOrFail($id);
        if(!empty($request->logo)){
            // menyimpan data file yang diupload
            $logo = $request->file('logo');
            $logo_name = time().'.'.$logo->getClientOriginalExtension();
            $folder = 'img';
            $logo->move($folder,$logo_name);

            $logo_old = $partnership->logo;
            $logo_path = public_path('img/'.$logo_old);
            if(file_exists($logo_path)){
                unlink($logo_path);
            }
        }

        $partnership->update([
            'name' => $request->name,
            'logo' => (!empty($request->logo)) ? $logo_name : $partnership->logo,
        ]);

        $request->session()->flash('alert-success', 'Partnership berhasil dibuat');
        return redirect()->route('admin.partnership.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        Partnership::findOrFail($id)->delete();
        $request->session()->flash('alert-success', 'Partnership berhasil dihapus');
        return redirect()->back();
    }
}
