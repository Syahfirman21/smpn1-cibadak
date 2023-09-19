<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\berita as Berita;
use App\agenda as Agenda;
use App\Student;
use App\Gallery;
use Session;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Excel;
use Config;

class StudentController extends Controller
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

        return view('admin.siswa.select', $data);
    }

    public function tampil($id, $kelas, Request $request, Builder $htmlBuilder)
    {
        $data['amountBeritas'] = count(Berita::all());
        $data['amountAgendas'] = count(Agenda::all());
        $data['amountGalleries'] = count(Gallery::all());
        $data['id'] = $id;
        $data['kelas'] = $kelas;
        $rombel = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];
        $data['kelasAtas'] = $kelas.' '.$rombel[$id-1];
        if ($request->ajax()) {
            $students = Student::where('kelas', $kelas)->where('class_id', $id)->orderBy('nama', 'desc')->get();
            return Datatables::of($students)
            ->addColumn('action', function($student){
                return view('partials._action', [
                'edit' => url('admin/siswa/'.$student->id.'/edit'),
                'hapus' => url('admin/siswa/'.$student->id.'/'.$student->kelas.'/'.$student->class_id),
                ]);
            })->make(true);
        }
        $data['html'] = $htmlBuilder
        ->addColumn(['data' => 'id', 'name'=>'id', 'title'=>'Id'])
        ->addColumn(['data' => 'nama', 'name'=>'nama', 'title'=>'Nama Siswa'])
        ->addColumn(['data' => 'nis', 'name'=>'nis', 'title'=>'Nomor Induk Sekolah'])
        ->addColumn(['data' => 'gender', 'name' => 'gender', 'title' => 'Jenis Kelamin'])
        ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);
        return view('admin.siswa.list', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function importIndex()
    {
        $data['amountBeritas'] = count(Berita::all());
        $data['amountAgendas'] = count(Agenda::all());
        $data['amountGalleries'] = count(Gallery::all());
        return view('admin.siswa.import', $data);
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'dataSiswa' => 'required'
        ]);

        $csv = $request->file('dataSiswa');
        if($csv->getClientOriginalExtension() != 'csv'){
            Session::flash("flash_notification", [
                "level"=>"danger",
                "message"=>"Gagal mengimport karena format file bukan .csv"
            ]);
            return redirect()->route('admin.siswa.importIndex');
        }

        Excel::load($csv, function($reader) {
            $reader->each(function($sheet){
                Student::firstOrCreate($sheet->toArray());
            });
        });
            
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil mengimport data"
        ]);

        return redirect()->route('admin.siswa.importIndex');
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
        $data['siswa'] = Student::find($id);
        return view('admin.siswa.edit', $data);
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
            'nis' => 'required|max:60',
            'gender' => 'required'
        ]);
        $siswa = Student::find($id);
        $siswa->update([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'gender' => $request->gender
        ]);
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Sukses mengedit siswa : $siswa->nama"
        ]);
        return redirect()->route('admin.siswa.editSiswa', ['id'=>$siswa->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $kelas, $class_id)
    {
        $student = Student::find($id);
        Student::destroy($id);
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Sukses menghapus siswa : $student->nama"
        ]);
        return redirect()->route('admin.kelas.tampil', [
            'id'=>$class_id,
            'kelas'=>$kelas
        ]);
    }

    public function destroyAll($id, $kelas)
    {
        Student::where('kelas',$kelas)->where('class_id', $id)->delete();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Sukses menghapus semua data"
        ]);
        return redirect()->route('admin.kelas.tampil', ['id'=>$id, 'kelas'=>$kelas]);
    }
}
