<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\berita;
use App\Home;
use App\Gallery;
use App\Http\Requests;
use DB;

class SearchController extends Controller
{
    public function search($keyword)
    {
    	$data['keyword'] = $keyword;
    	$data['home'] = Home::first();
        $data['berita'] = berita::where('title','like','%'.$keyword.'%')->orWhere('isiBerita','like','%'.$keyword.'%')->orderBy('id', 'desc')->paginate(4);
        $data['recent'] = berita::take(5)->orderBy('id', 'desc')->get();
        $data['galleries'] = Gallery::take(4)->orderBy('id', 'desc')->get();

        return view('themes.search', $data);
    }
 
}
