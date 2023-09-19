<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\berita;
use App\Home;
use App\Gallery;
use App\Http\Requests;
use DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ganti($string)
    {
        $string = str_replace('-', ' ', $string);
        return $string;
    }
    public function index()
    {
        $data['home'] = Home::first();
        $data['berita'] = berita::orderBy('id', 'desc')->paginate(4);
        $data['recent'] = berita::take(5)->orderBy('id', 'desc')->get();
        $data['galleries'] = Gallery::take(4)->orderBy('id', 'desc')->get();
        return view('themes.blog', $data);
    }
    public function show($id, $slug)
    {
        $data['home'] = Home::first();
        $data['post'] = berita::where('id', $id)->where('slug', $slug)->firstOrFail();
        $data['recent'] = berita::take(5)->orderBy('id', 'desc')->get();
        $data['galleries'] = Gallery::take(4)->orderBy('id', 'desc')->get();
        return view('themes.detail', $data);
    }
}
