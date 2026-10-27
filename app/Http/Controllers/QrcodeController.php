<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DigiInvoice;


class QrcodeController extends Controller
{
    public function check($qrcode)
    {
        $qrcode = DigiInvoice::where('qrcode', $qrcode)->first();
        if(!$qrcode){
            return "Qrcode Tidak Ditemukan";
        }

        return view('qrcode', ['qrcode'=>$qrcode]);
    }

    public function consultationDownload(Request $request, $id, $semester)
    {
        $crypt_id = $id;
        $crypt_semester = $semester;

        $id = Crypt::decryptString($id);
        $semester = Crypt::decryptString($semester);

        $user = User::findOrFail($id);
        $supervisor = Supervisor::where([['student_id', $id]])->first();
        if(!$supervisor){
            abort(401, 'This action is unauthorized.');
        }

        $generation = $user->generation;
        if ($semester % 2 == 0){
            $year = $generation + $semester / 2;
            $start_month = '01';
            $end_month = '06';
        }else{
            $year = ($semester > 1) ? $generation + ($semester-1) / 2 : $generation;
            $start_month = '07';
            $end_month = 12;
        }

        $consultation = Consultation::where('student_id', $id)->whereYear('date', '=', $year)
            ->whereMonth('date', '>=', $start_month)->whereMonth('date', '<=', $end_month)
            ->orderBy('date', 'asc')->get();

        $pdf = Pdf::loadview('print.consultation', [
            'data'=>$consultation,
            'supervisor'=>$supervisor,
            'crypt_id'=>$crypt_id,
            'crypt_semester'=>$crypt_semester,
            'semester'=>$semester,
        ]);
        return $pdf->download('Perwalian.pdf');
    }
}
