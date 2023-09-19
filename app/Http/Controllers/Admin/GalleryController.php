<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\berita as Berita;
use App\agenda as Agenda;
use App\Http\Requests;
use App\Galcategory;
use App\Gallery;
use Session;
use File;
use Image;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['amountBeritas'] = count(Berita::all());
        $data['amountAgendas'] = count(Agenda::all());
        $data['amountGalleries'] = count(Gallery::all());
        $data['categories'] = Galcategory::all();
        $data['galleryData'] = Gallery::orderBy('id', 'desc')->paginate(6);
        return view('admin.gallery.list', $data);
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
            'img' => 'required',
            'category' => 'required|not_in:0',
        ]);

        $thumbnail = $request->file('img');
        $filename = time()."_".md5($thumbnail->getClientOriginalName()).".".$thumbnail->getClientOriginalExtension();
        $path = public_path().'/upload';

        // resize
        $res = Image::make($thumbnail);
        $res->resize(800, null, function($constraint) {
            $constraint->aspectRatio();
        });
        $res->save('upload/'.$filename, 50);
        // $thumbnail->move($path,$filename);
        
        $gallery = Gallery::create([
            'img' => $filename,
            'galcategory_id' => $request->category,
        ]);

        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Gambar berhasil di upload."
        ]);

        return redirect()->route('admin.gallery.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gambar = Gallery::find($id);
        $path = public_path().'/upload/'.$gambar->img;

        Gallery::destroy($id);

        if(File::exists($path))
        {
            unlink($path);
        }
        
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Gambar berhasil di hapus."
        ]);
        return redirect()->route('admin.gallery.index');
    }

    public function addCategory(Request $request) {
        $this->validate($request, [
            'kategori' => 'required|unique:galcategories|min:3',
        ]);

        Galcategory::create(['kategori'=>$request->kategori]);

        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Kategori berhasil ditambah."
        ]);

        return redirect()->route('admin.gallery.index');
    }
}
