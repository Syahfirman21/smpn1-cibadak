<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Berita;
use App\Home;
use App\Gallery;
use DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $data['keyword'] = $keyword;
        $data['home'] = Home::first();
        $data['berita'] = Berita::where('title', 'like', '%' . $keyword . '%')
            ->orWhere('isiBerita', 'like', '%' . $keyword . '%')
            ->orderBy('id', 'desc')
            ->paginate(4);
        $data['recent'] = Berita::take(5)->orderBy('id', 'desc')->get();
        $data['galleries'] = Gallery::take(4)->orderBy('id', 'desc')->get();

        return view('themes.search', $data);
    }
}
