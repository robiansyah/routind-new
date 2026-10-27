<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\CertificateSign;
use Barryvdh\DomPDF\Facade\Pdf;

class PrintController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function certificate(Request $request, $code)
    {
        $certificate = Certificate::with('user', 'category')->where('code', $code)->first();
        if($certificate){
            $name = ($certificate->user_id != '') ? $certificate->user->name : $certificate->username;
            $pdf = Pdf::loadview('print.certificate', [
                'data' => $certificate,
            ])->setPaper('a4', 'landscape');
            return $pdf->download('sertifikat-'.$name.'-'.$certificate->code.'.pdf');
        }else{
            $request->session()->flash('alert-danger', 'Sertifikat Tidak Ditemukan');
            return redirect()->back();
        }
    }

    public function brevet(Request $request, $code)
    {
        $certificate = Certificate::with('user', 'category')->where('code', $code)->first();
        $sign = CertificateSign::findOrFail(1);
        if($certificate){
            $pdf = Pdf::loadview('print.brevet', [
                'data' => $certificate,
                'sign' => $sign
            ])->setPaper('a4', 'landscape')->set_option("dpi", 150);
            return $pdf->download($certificate->user->name.'-Brevet AB.pdf');
        }else{
            $request->session()->flash('alert-danger', 'Sertifikat Tidak Ditemukan');
            return redirect()->back();
        }

    }

    public function brevet_blank(Request $request, $code)
    {
        $certificate = Certificate::with('user', 'category')->where('code', $code)->first();
        $sign = CertificateSign::findOrFail(1);
        if($certificate){
            $pdf = Pdf::loadview('print.brevet_blank', [
                'data' => $certificate,
                'sign' => $sign
            ])->setPaper('a4', 'landscape')->set_option("dpi", 150);
            return $pdf->download('sertifikat-'.$certificate->user->name.'-'.$certificate->code.'.pdf');
        }else{
            $request->session()->flash('alert-danger', 'Sertifikat Tidak Ditemukan');
            return redirect()->back();
        }

    }
}