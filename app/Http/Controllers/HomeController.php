<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Home;
use App\saran;
use App\berita;
use App\Gallery;
use App\Page;
use App\teacher as Teacher;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['home'] = Home::first();
        $data['sambutanKepala'] = Page::where('role', 'sambutan')->first();
        $data['fotoKepala'] = Teacher::select('thumbnail')->where('nip', '195706111979031007')->first();
        $data['berita'] = berita::orderBy('id', 'desc')->paginate(4);
        $data['galleries'] = Gallery::take(4)->orderBy('id', 'desc')->get();
        $data['agenda'] = DB::table('agendas')->take(3)->orderBy('id', 'desc')->get();
        return view('themes.homepage', $data);
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'isiSaran'=>'required',
            'g-recaptcha-response' => 'required|recaptcha',
        ]);
        $data = $request->all();
        saran::create($data);
        return redirect('/');
    }
    public function aboutIndex()
    {
        $data['home'] = Home::first();
        return view('themes.about', $data);
    }
}
