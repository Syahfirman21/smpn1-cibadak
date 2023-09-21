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

class AgendaAdminController extends Controller
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
            $agendas = Agenda::select(['id', 'titleAgenda', 'tglMulai']);
            return Datatables::of($agendas)
            ->addColumn('action', function($agenda){
                return view('partials._action', [
                'edit' => url('admin/agenda/'.$agenda->id.'/edit'),
                'hapus' => url('admin/agenda', $agenda->id),
                ]);
            })->make(true);
        }
        $data['html'] = $htmlBuilder
        ->addColumn(['data' => 'id', 'name'=>'id', 'title'=>'Id'])
        ->addColumn(['data' => 'titleAgenda', 'name'=>'titleAgenda', 'title'=>'Judul Agenda'])
        ->addColumn(['data' => 'tglMulai', 'name'=>'tglMulai', 'title'=>'Tanggal Publish'])
        ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);
        return view('admin.agenda.list', $data);
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
        return view('admin.agenda.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $this->validate($request, [
            'titleAgenda' => 'required|max:255',
            'descAgenda' => 'required',
            'thumbAgenda' => 'required',
            'tempat' => 'required',
            'tglMulai' => 'required|max:20',
            'jamMulai' => 'required',
            'tglAkhir' => 'required|max:20',
            'jamSelesai' => 'required'
        ]);

        $tglMulai = date('Y-m-d', strtotime($request->tglMulai));
        $tglAkhir = date('Y-m-d', strtotime($request->tglAkhir));

        $thumbnail = $request->file('thumbAgenda');
        $filename = time()."_".md5($thumbnail->getClientOriginalName()).".".$thumbnail->getClientOriginalExtension();
        $path = public_path().'/upload';

        // resize
        $res = Image::make($request->file('thumbAgenda'));
        $res->resize(800, null, function($constraint) {
            $constraint->aspectRatio();
        });
        $res->save('upload/'.$filename, 50);
        // $thumbnail->move($path,$filename);

        // slug
        $slugs = str_slug($request->titleAgenda, '-');

        $agenda = Agenda::create([
            'thumbAgenda' => $filename,
            'descAgenda' => $request->descAgenda,
            'titleAgenda' => $request->titleAgenda,
            'slug' => $slugs,
            'tglMulai' => $tglMulai,
            'tglAkhir' => $tglAkhir,
            'jamMulai' => $request->jamMulai,
            'jamSelesai' => $request->jamSelesai,
            'tempat' => $request->tempat
        ]);

        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Agenda : $request->titleAgenda telah berhasil di publish."
        ]);

        return redirect()->route('admin.agenda.create');
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
        $data['agendaEdit'] = Agenda::find($id);
        return view('admin.agenda.edit', $data);
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
            'titleAgenda' => 'required|max:255',
            'descAgenda' => 'required',
            'tempat' => 'required',
            'tglMulai' => 'required|max:20',
            'jamMulai' => 'required',
            'tglAkhir' => 'required|max:20',
            'jamSelesai' => 'required'
        ]);
        $tglMulai = date('Y-m-d', strtotime($request->tglMulai));
        $tglAkhir = date('Y-m-d', strtotime($request->tglAkhir));

        $agendaAmbil = Agenda::find($id);
        $filename = '';

        if(!$request->hasFile('thumbAgenda')) {
            $filename = $agendaAmbil->thumbAgenda;
        } else {
            $thumbnail = $request->file('thumbAgenda');
            $filename = time()."_".md5($thumbnail->getClientOriginalName()).".".$thumbnail->getClientOriginalExtension();
            $path = public_path().'/upload';

            // resize
            $res = Image::make($request->file('thumbAgenda'));
            $res->resize(800, null, function($constraint) {
                $constraint->aspectRatio();
            });
            $res->save('upload/'.$filename, 50);
            // $thumbnail->move($path,$filename);
        }

        // slug
        $slugs = str_slug($request->titleAgenda, '-');

        $agendaAmbil->update([
            'thumbAgenda' => $filename,
            'descAgenda' => $request->descAgenda,
            'titleAgenda' => $request->titleAgenda,
            'slug' => $slugs,
            'tglMulai' => $tglMulai,
            'tglAkhir' => $tglAkhir,
            'jamMulai' => $request->jamMulai,
            'jamSelesai' => $request->jamSelesai,
            'tempat' => $request->tempat
        ]);

        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan $agendaAmbil->titleAgenda"
        ]);
        return redirect()->route('admin.agenda.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataAgenda = Agenda::find($id);
        $path = public_path().'/upload/'.$dataAgenda->thumbAgenda;
        Agenda::destroy($id);
        
        if(File::exists($path))
        {
            unlink($path);
        }
        
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Agenda : $dataAgenda->titleAgenda berhasil dihapus"
        ]);
        return redirect()->route('admin.agenda.index');
    }
}
