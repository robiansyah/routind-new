<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        if(auth()->user()->hasRole('admin')){
            return redirect()->route('admin.index');
        }elseif(auth()->user()->hasRole('prodi')){
            return redirect()->route('prodi.index');
        }elseif(auth()->user()->hasRole('affiliate')){
            return redirect()->route('affiliate.index');
        } else{
            if (session()->has('coretax')) {
                return redirect()->route('dashboard');
            }
            return redirect()->route('pelajar.index');
        }
    }

    public function approval()
    {
        if(auth()->user()->approved_at != null){
            return redirect()->route('home');
        }else{
            return view('auth.approval');
        }
    }
}
