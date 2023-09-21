<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\berita as Berita;
use App\agenda as Agenda;
use App\Http\Requests;
use App\Gallery;
use Session;
use File;
use Image;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request, Builder $htmlBuilder)
    {
        $data['amountBeritas'] = count(Berita::all());
        $data['amountAgendas'] = count(Agenda::all());
        $data['amountGalleries'] = count(Gallery::all());
        if ($request->ajax()) {
            $beritas = Berita::select(['id', 'title', 'postedAt']);
            return Datatables::of($beritas)
            ->addColumn('action', function($berita){
                return view('partials._action', [
                'edit' => url('admin/berita/'.$berita->id.'/edit'),
                'hapus' => url('admin/berita', $berita->id),
                ]);
            })->make(true);
        }
        $data['html'] = $htmlBuilder
        ->addColumn(['data' => 'id', 'name'=>'id', 'title'=>'Id'])
        ->addColumn(['data' => 'title', 'name'=>'title', 'title'=>'Judul Berita'])
        ->addColumn(['data' => 'postedAt', 'name'=>'postedAt', 'title'=>'Tanggal Publish'])
        ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);
        return view('admin.artikel.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['amountBeritas'] = count(Berita::all());
        $data['amountAgendas'] = count(Agenda::all());
        $data['amountGalleries'] = count(Gallery::all());
        return view('admin.artikel.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|max:255',
            'isiBerita'=>'required',
            'thumbnail'=>'required',
            'lable'=>'required|max:60',
            'postedAt'=>'required'
        ]);

        $thumbnail = $request->file('thumbnail');
        $filename = time()."_".md5($thumbnail->getClientOriginalName()).".".$thumbnail->getClientOriginalExtension();
        $path = public_path().'/upload';
        // $thumbnail->move($path,$filename);
        // resize
        $res = Image::make($request->file('thumbnail'));
        $res->resize(800, null, function($constraint) {
            $constraint->aspectRatio();
        });
        $res->save('upload/'.$filename, 50);

        // slug
        $slugs = str_slug($request->title, '-');


        $date = date('Y-m-d', strtotime($request->postedAt));
        $beritas = Berita::create([
            'thumbnail' => $filename,
            'isiBerita' => $request->isiBerita,
            'title' => $request->title,
            'slug' => $slugs,
            'lable' => $request->lable,
            'postedAt' => $date
        ]);

        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Artikel $request->title telah berhasil di publish."
        ]);

        return redirect()->route('admin.berita.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['amountBeritas'] = count(Berita::all());
        $data['amountAgendas'] = count(Agenda::all());
        $data['amountGalleries'] = count(Gallery::all());
        $data['beritaEdit'] = Berita::find($id);
        return view('admin.artikel.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'=>'required|max:255',
            'isiBerita'=>'required',
            'lable'=>'required|max:60',
            'postedAt'=>'required'
        ]);
        $date = date('Y-m-d', strtotime($request->postedAt));
        $beritaAmbil = Berita::find($id);
        $filename = '';

        if(!$request->hasFile('thumbnail')) {
            $filename = $beritaAmbil->thumbnail;
        } else {
            $thumbnail = $request->file('thumbnail');
            $filename = md5($thumbnail->getClientOriginalName()).".".$thumbnail->getClientOriginalExtension();
            $path = public_path().'/upload';
            // $thumbnail->move($path,$filename);
            // resize
            $res = Image::make($request->file('thumbnail'));
            $res->resize(800, null, function($constraint) {
                $constraint->aspectRatio();
            });
            $res->save('upload/'.$filename, 50);
        }

        // slug
        $slugs = str_slug($request->title, '-');

        $beritaAmbil->update([
            'thumbnail' => $filename,
            'isiBerita' => $request->isiBerita,
            'title' => $request->title,
            'slug' => $slugs,
            'lable' => $request->lable,
            'postedAt' => $date
        ]);

        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan $beritaAmbil->title"
        ]);
        return redirect()->route('admin.berita.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataBerita = Berita::find($id);
        $path = public_path().'/upload/'.$dataBerita->thumbnail;
        Berita::destroy($id);
        
        if(File::exists($path))
        {
            unlink($path);
        }
        
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berita $dataBerita->title berhasil dihapus"
        ]);
        return redirect()->route('admin.berita.index');
    }
}
