<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\SendMailJob;

class SendEmailController extends Controller
{
    public function index()
    {

        return view('emails.index');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'subject' => 'required',
            'email' => 'required',
        ]);

        $data['subject'] = $request->subject;
        $data['body'] = $request->body;
        $emails = explode(";",$request->email);
        foreach($emails as $email){
            $data['name'] = $email;
            $data['email'] = $email;
            dispatch(new SendMailJob($data));
        }
        return redirect()->back()->with('alert-success', 'Email berhasil dikirim');
    }
}