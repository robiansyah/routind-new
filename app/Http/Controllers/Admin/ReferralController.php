<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Referral;
use App\Models\User;

class ReferralController extends Controller
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
        $referrals = Referral::with('user', 'students')->orderBy('id', 'desc')->lazy();

        return view('admin.referral.index',[
            'data' => $referrals,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('admin.referral.create',[
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'user_id' => 'required',
            'name' => 'required',
            'code' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'length' => 'required',
        ]);

        Referral::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'code' => $request->code,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'length' => $request->length,
        ]);

        $request->session()->flash('alert-success', 'Referral berhasil dibuat');
        return redirect()->route('admin.referral.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $referral = Referral::with('students')->findOrFail($id);

        return view('admin.referral.detail',[
            'referral' => $referral,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $referral = Referral::findOrFail($id);
        $users = User::all();

        return view('admin.referral.edit',[
            'referral' => $referral,
            'users' => $users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'user_id' => 'required',
            'name' => 'required',
            'code' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'length' => 'required',
        ]);

        $referral = Referral::findOrFail($id);

        $referral->update([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'code' => $request->code,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'length' => $request->length,
        ]);

        $request->session()->flash('alert-success', 'Referral berhasil dibuat');
        return redirect()->route('admin.referral.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        Referral::findOrFail($id)->delete();
        $request->session()->flash('alert-success', 'Referral berhasil dihapus');
        return redirect()->back();
    }
}
