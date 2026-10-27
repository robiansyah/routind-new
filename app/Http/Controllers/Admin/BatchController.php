<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademyBatch;
use App\Models\AcademyEvent;

class BatchController extends Controller
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
        $batchs = AcademyBatch::orderBy('created_at', 'desc')->lazy();

        return view('admin.batch.index',[
            'data' => $batchs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = AcademyEvent::orderBy('created_at', 'desc')->get();

        return view('admin.batch.create',[
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'event_id' => 'required',
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'registration' => 'required',
            'link_group' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'code' => 'required|string|max:8',
        ]);

        AcademyBatch::create([
            'event_id' => $request->event_id,
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'registration' => $request->registration,
            'link_group' => $request->link_group,
            'price' => $request->price,
            'discount' => $request->discount,
            'code' => $request->code,
        ]);

        $request->session()->flash('alert-success', 'Batch berhasil dibuat');
        return redirect()->route('admin.batch.index');
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
        $batch = AcademyBatch::findOrFail($id);
        $categories = AcademyEvent::orderBy('created_at', 'desc')->get();

        return view('admin.batch.edit',[
            'categories' => $categories,
            'batch' => $batch,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'event_id' => 'required',
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'registration' => 'required',
            'link_group' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'code' => 'required|string|max:8',
        ]);

        $batch = AcademyBatch::findOrFail($id);

        $batch->update([
            'event_id' => $request->event_id,
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'registration' => $request->registration,
            'link_group' => $request->link_group,
            'price' => $request->price,
            'discount' => $request->discount,
            'code' => $request->code,
        ]);

        $request->session()->flash('alert-success', 'Batch berhasil dibuat');
        return redirect()->route('admin.batch.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
