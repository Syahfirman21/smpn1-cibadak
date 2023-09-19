<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\berita as Berita;
use App\agenda as Agenda;
use App\teacher as Teacher;
use App\Gallery;
use Session;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use File;

class GuruController extends Controller
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
            $teachers = Teacher::select(['id', 'thumbnail', 'nama', 'nip', 'mapel']);
            return Datatables::of($teachers)
            ->addColumn('action', function($teacher){
                return view('partials._action', [
                'edit' => url('admin/guru/'.$teacher->id.'/edit'),
                'hapus' => url('admin/guru', $teacher->id),
                ]);
            })
            ->addColumn('Foto', function ($teacher) {
                return view('partials._foto', [
                'img' => url('upload/'.$teacher->thumbnail),
                ]);
            })
            ->make(true);
        }
        $data['html'] = $htmlBuilder
        ->addColumn(['data' => 'id', 'name'=>'id', 'title'=>'Id'])
        ->addColumn(['data' => 'Foto', 'name'=>'Foto', 'title'=>'Foto', 'orderable'=>false, 'searchable'=>false])
        ->addColumn(['data' => 'nama', 'name'=>'nama', 'title'=>'Nama Guru'])
        ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'Action', 'orderable'=>false, 'searchable'=>false]);
        return view('admin.guru.list', $data);
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
        return view('admin.guru.add', $data);
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
            'nama' => 'required|max:255',
            'thumbnail' => 'required',
            'nip' => 'required|max:18',
            'mapel' => 'required|max:100'
        ]);

        $thumbnail = $request->file('thumbnail');
        $filename = time()."_".md5($thumbnail->getClientOriginalName()).".".$thumbnail->getClientOriginalExtension();
        $path = public_path().'/upload';
        $thumbnail->move($path,$filename);

        Teacher::create([
            'nama' => $request->nama,
            'thumbnail' => $filename,
            'nip' => $request->nip,
            'mapel' => $request->mapel
        ]);

        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Guru telah berhasil di ditambahkan, coba lakukan search nama guru yang telah ditambahkan."
        ]);

        return redirect()->route('admin.guru.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['guru'] = Teacher::find($id);
        $data['amountBeritas'] = count(Berita::all());
        $data['amountAgendas'] = count(Agenda::all());
        $data['amountGalleries'] = count(Gallery::all());
        return view('admin.guru.edit', $data);
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
            'nama' => 'required|max:255',
            'nip' => 'required|max:18',
            'mapel' => 'required|max:100'
        ]);

        $guru = Teacher::find($id);
        $filename = '';

        if(!$request->hasFile('thumbnail')) {
            $filename = $guru->thumbnail;
        } else {
            $thumbnail = $request->file('thumbnail');
            $filename = time()."_".md5($thumbnail->getClientOriginalName()).".".$thumbnail->getClientOriginalExtension();
            $path = public_path().'/upload';
            $thumbnail->move($path,$filename);
        }

        $guru->update([
            'nama' => $request->nama,
            'thumbnail' => $filename,
            'nip' => $request->nip,
            'mapel' => $request->mapel
        ]);

        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil mengupdate $guru->nama"
        ]);
        return redirect()->route('admin.guru.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guru = Teacher::find($id);
        $path = public_path().'/upload/'.$guru->thumbnail;
        Teacher::destroy($id);
        
        if(File::exists($path))
        {
            unlink($path);
        }
        
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Guru telah berhasil di hapus."
        ]);
        return redirect()->route('admin.guru.index');
    }
}
