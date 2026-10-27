<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Closure;

class CheckSptNumber
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       if (Auth::user()->spt->count() >= 2 && Auth::user()->paket==null) {
           $request->session()->flash('alert-error', 'Anda Telah Mencapai Limit Penggunaan Gratis\nSilakan Beli Paket Untuk Menikmati Akses yang Lebih Lengkap');
           return redirect('paket');
        }

        return $next($request);
    }
}