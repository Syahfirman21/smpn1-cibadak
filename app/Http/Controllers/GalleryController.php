<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use App\Galcategory;
use App\Home;
use App\Http\Requests;

class GalleryController extends Controller
{
    public function mainIndex() {
    	$data['home'] = Home::first();
    	$data['galcategories'] = Galcategory::paginate(8);
    	return view('themes.gallery', $data);
    }

    public function galCat($kategori) {
    	$data['home'] = Home::first();
    	$data['images'] = Galcategory::where('kategori', $kategori)->first();
    	return view('themes.catgal', $data);
    }


	public function show($kategori, $img) {
		$data['img'] = Gallery::where('galcategory_id', $kategori)->where('img', $img)->first();
		return view('partials._imagebox', $data);
	}
	
    // public function showImg($kategori, $img) {
    // 	$data['img'] = Gallery::where('galcategory_id', $kategori)->where('img', $img)->first();
    // 	return view('partials._imagebox', $data);
    // }
}
