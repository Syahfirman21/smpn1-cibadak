<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\berita as Berita;
use App\agenda as Agenda;
use App\Gallery;
use App\saran as Saran;
use App\message as Message;
use Session;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;

class SaranPesanController extends Controller
{
    public function saran(Request $request, Builder $htmlBuilder)
    {
        $data['amountBeritas'] = count(Berita::all());
        $data['amountAgendas'] = count(Agenda::all());
        $data['amountGalleries'] = count(Gallery::all());
        if ($request->ajax()) {
            $sarans = Saran::select(['id', 'isiSaran', 'created_at']);
            return Datatables::of($sarans)
            ->addColumn('action', function($saran){
                return view('partials._action', [
                'edit' => 'javascript:void(0)',
                'hapus' => url('admin/saran', $saran->id),
                ]);
            })->make(true);
        }
        $data['html'] = $htmlBuilder
        ->addColumn(['data' => 'id', 'name'=>'id', 'title'=>'Id'])
        ->addColumn(['data' => 'isiSaran', 'name'=>'isiSaran', 'title'=>'Isi Saran'])
        ->addColumn(['data' => 'created_at', 'name'=>'created_at', 'title'=>'Tanggal Publish'])
        ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);
        return view('admin.saranPesan.saran', $data);
    }
    public function saranDelete($id)
    {
        Saran::destroy($id);
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Saran telah berhasil di hapus."
        ]);
        return redirect()->route('admin.saran.index');
    }


    public function pesan(Request $request, Builder $htmlBuilder)
    {
        $data['amountBeritas'] = count(Berita::all());
        $data['amountAgendas'] = count(Agenda::all());
        $data['amountGalleries'] = count(Gallery::all());
        if ($request->ajax()) {
            $messages = Message::select(['id', 'nama', 'email', 'telp', 'isiPesan', 'created_at']);
            return Datatables::of($messages)
            ->addColumn('action', function($message){
                return view('partials._action', [
                'edit' => 'javascript:void(0)',
                'hapus' => url('admin/message', $message->id),
                ]);
            })->make(true);
        }
        $data['html'] = $htmlBuilder
        ->addColumn(['data' => 'id', 'name'=>'id', 'title'=>'Id'])
        ->addColumn(['data' => 'nama', 'name'=>'nama', 'title'=>'Nama'])
        ->addColumn(['data' => 'email', 'name'=>'email', 'title'=>'Email'])
        ->addColumn(['data' => 'telp', 'name' => 'telp', 'title' => 'No Telp'])
        ->addColumn(['data' => 'isiPesan', 'name' => 'isiPesan', 'title' => 'Isi Pesan'])
        ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => 'Tanggal'])
        ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);
        return view('admin.saranPesan.pesan', $data);
    }
    public function pesanDelete($id)
    {
        Message::destroy($id);
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Pesan telah berhasil di hapus."
        ]);
        return redirect()->route('admin.pesan.index');
    }
}
