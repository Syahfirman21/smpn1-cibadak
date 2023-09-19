<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Home;
use App\message;
use App\Http\Requests;
use Session;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$data['home'] = Home::first();
        return view('themes.contact', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$this->validate($request, [
    		'nama' => 'required',
    		'email' => 'required',
    		'telp' => 'required',
    		'isiPesan' => 'required',
        'g-recaptcha-response' => 'required|recaptcha',
    	]);
        $data = $request->all();
        message::create($data);

        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Contact telah berhasil dikirim"
        ]);
        return redirect('contact');
    }

}
