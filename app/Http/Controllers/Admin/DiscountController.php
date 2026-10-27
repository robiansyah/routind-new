<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discount;

class DiscountController extends Controller
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
        $discounts = Discount::orderBy('id', 'desc')->lazy();

        return view('admin.discount.index',[
            'data' => $discounts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.discount.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'code' => 'required',
            'type' => 'required',
            'amount' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        Discount::create([
            'name' => $request->name,
            'code' => $request->code,
            'type' => $request->type,
            'amount' => $request->amount,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        $request->session()->flash('alert-success', 'Diskon berhasil dibuat');
        return redirect()->route('admin.discount.index');
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
        $discount = Discount::findOrFail($id);

        return view('admin.discount.edit',[
            'discount' => $discount,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'code' => 'required',
            'type' => 'required',
            'amount' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $discount = Discount::findOrFail($id);

        $discount->update([
            'name' => $request->name,
            'code' => $request->code,
            'type' => $request->type,
            'amount' => $request->amount,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        $request->session()->flash('alert-success', 'Diskon berhasil dibuat');
        return redirect()->route('admin.discount.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        Discount::findOrFail($id)->delete();
        $request->session()->flash('alert-success', 'Diskon berhasil dihapus');
        return redirect()->back();
    }
}
