<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\CertificateSign;
use App\Models\CertificateDesign;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BrevetImport;
use App\Imports\LainImport;
use App\Traits\WablasTrait;

class CertificateController extends Controller
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
    public function sign()
    {
        $data = CertificateSign::all();

        return view('admin.certificate.sign',[
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function signStore(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'position' => 'required',
            'image' => 'required',
        ]);

        $image = $request->file('image');
        $image_name = time().'_ttd.'.$image->getClientOriginalExtension();
        $folder = 'img';
        $image->move($folder,$image_name);

        CertificateSign::create([
            'name' => $request->name,
            'position' => $request->position,
            'image' => 'img/'.$image_name,
        ]);

        $request->session()->flash('alert-success', 'Tanda Tangan berhasil dibuat');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function signEdit($id)
    {
        $data = CertificateSign::findOrFail($id);
        return response()->json([
            "status"=>"success",
            "code"=> 1,
            "data"=> $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function signUpdate(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'position' => 'required',
        ]);

        $data = CertificateSign::findOrFail($id);
        if(!empty($request->image)){
            // menyimpan data file yang diupload
            $image = $request->file('image');
            $image_name = time().'_ttd.'.$image->getClientOriginalExtension();
            $folder = 'img';
            $image->move($folder,$image_name);

            $image_old = $data->image;
            $image_path = public_path('img/'.$image_old);
            if(file_exists($image_path)){
                unlink($image_path);
            }
        }
        $data->update([
            'name' => $request->name,
            'position' => $request->position,
            'image' => (!empty($request->image)) ? 'img/'.$image_name : $data->image,
        ]);

        $request->session()->flash('alert-success', 'Tanda Tangan berhasil dibuat');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function signDestroy(string $id)
    {
        $data = CertificateSign::findOrFail($id);
        $image_old = $data->image;
        $image_path = public_path('img/'.$image_old);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $data->delete();

        $request->session()->flash('alert-success', 'Tanda Tangan berhasil dihapus');
        return redirect()->back();
    }

    public function design()
    {
        $data = CertificateDesign::all();

        return view('admin.certificate.design',[
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function designStore(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'image' => 'required',
        ]);

        $image = $request->file('image');
        $image_name = time().'_ttd.'.$image->getClientOriginalExtension();
        $folder = 'img';
        $image->move($folder,$image_name);

        CertificateDesign::create([
            'name' => $request->name,
            'image' => 'img/'.$image_name,
        ]);

        $request->session()->flash('alert-success', 'Desain berhasil dibuat');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function designEdit($id)
    {
        $data = CertificateDesign::findOrFail($id);
        return response()->json([
            "status"=>"success",
            "code"=> 1,
            "data"=> $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function designUpdate(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
        ]);

        $data = CertificateDesign::findOrFail($id);
        if(!empty($request->image)){
            // menyimpan data file yang diupload
            $image = $request->file('image');
            $image_name = time().'_ttd.'.$image->getClientOriginalExtension();
            $folder = 'img';
            $image->move($folder,$image_name);

            $image_old = $data->image;
            $image_path = public_path('img/'.$image_old);
            if(file_exists($image_path)){
                unlink($image_path);
            }
        }
        $data->update([
            'name' => $request->name,
            'image' => (!empty($request->image)) ? 'img/'.$image_name : $data->image,
        ]);

        $request->session()->flash('alert-success', 'Desain berhasil dibuat');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function designDestroy(string $id)
    {
        $data = CertificateDesign::findOrFail($id);
        $image_old = $data->image;
        $image_path = public_path('img/'.$image_old);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $data->delete();

        $request->session()->flash('alert-success', 'Desain berhasil dibuat');
        return redirect()->back();
    }

    public function brevet()
    {
        $data = Certificate::with('user')->whereNotNull('participant_no')->orderByDesc('id')->lazy();

        return view('admin.certificate.brevet',[
            'data' => $data,
        ]);
    }

    public function brevetEdit($id)
    {
        $data = Certificate::findOrFail($id);
        return response()->json([
            "status"=>"success",
            "code"=> 1,
            "data"=> $data,
        ]);
    }

    public function brevetUpdate(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'code' => 'required',
            'date' => 'required',
            'participant_no' => 'required',
            'visibility' => 'required',
        ]);

        $data = Certificate::findOrFail($id);
        $data->update([
            'name' => $request->name,
            'code' => $request->code,
            'date' => $request->date,
            'participant_no' => $request->participant_no,
            'visibility' => $request->visibility,
        ]);

        $request->session()->flash('alert-success', 'Sertifikat Brevet berhasil diubah');
        return redirect()->back();
    }

    public function brevetDestroy(Request $request, $id)
    {
        $data = Certificate::findOrFail($id);
        $data->delete();

        $request->session()->flash('alert-success', 'Sertifikat Brevet berhasil dihapus');
        return redirect()->back();
    }

    public function brevetImport(Request $request)
    {
        $this->validate($request, [
            'file'  => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new BrevetImport(), $request->file('file')->store('temp'));
        $request->session()->flash('alert-info', 'Brevet berhasil diimpor');
        return redirect()->back();
    }

    public function lain()
    {
        $data = Certificate::whereNotNull('username')->orderByDesc('id')->lazy();

        return view('admin.certificate.lain',[
            'data' => $data,
        ]);
    }

    public function lainEdit($id)
    {
        $data = Certificate::findOrFail($id);
        return response()->json([
            "status"=>"success",
            "code"=> 1,
            "data"=> $data,
        ]);
    }

    public function lainUpdate(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'code' => 'required',
            'date' => 'required',
            'username' => 'required',
        ]);

        $data = Certificate::findOrFail($id);
        $data->update([
            'name' => $request->name,
            'code' => $request->code,
            'date' => $request->date,
            'username' => $request->username,
        ]);

        $request->session()->flash('alert-success', 'Sertifikat Lainnya berhasil diubah');
        return redirect()->back();
    }

    public function lainDestroy(Request $request, $id)
    {
        $data = Certificate::findOrFail($id);
        $data->delete();

        $request->session()->flash('alert-success', 'Sertifikat Lainnya berhasil dihapus');
        return redirect()->back();
    }

    public function lainImport(Request $request)
    {
        $this->validate($request, [
            'file'  => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new LainImport(), $request->file('file')->store('temp'));
        $request->session()->flash('alert-info', 'Sertifikat berhasil diimpor');
        return redirect()->back();
    }

    public function wablas(Request $request)
    {
        $messages = "[pesan otomatis]<br>Pembelian Anda Berhasil
                    <br>Hai Kak 
                    <br>Selamat! Kami senang untuk memberitahu Anda bahwa pembelian Anda pada course telah berhasil diverifikasi.
                    <br>Silakan save no ini terlebih dahulu agar link dapat diakses, kemudian klik link berikut ini untuk bergabung dengan grup WA";
        $kumpulan_data = [];
        $data['phone'] = '085758206435';
        $data['message'] = $messages;
        $data['secret'] = false;
        $data['retry'] = false;
        $data['isGroup'] = false;
        array_push($kumpulan_data, $data);
        WablasTrait::sendText($kumpulan_data);

        return redirect()->route('home');
    }
}
