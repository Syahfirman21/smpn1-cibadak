<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\berita as Berita;
use App\agenda as Agenda;
use App\teacher as Teacher;
use App\Gallery;
use App\Model\Ppdb\Register as Student;
use App\Model\Ppdb\Parents as OrangTua;
use App\Model\Ppdb\SkhuResult as Nilai;
use App\Model\Ppdb\ParentGuardian as Wali;
use Storage;
use Excel;
use Session;

class PpdbController extends Controller
{
    public function index(Request $request, Builder $htmlBuilder) {
        return $this->showData($request, $htmlBuilder);
    }

    public function import_form() {
        $data['amountBeritas'] = count(Berita::all());
        $data['amountAgendas'] = count(Agenda::all());
        $data['amountGalleries'] = count(Gallery::all());
        return view('admin.ppdb.add', $data);
    }

    public function import_post(Request $request) {
        $excelFile = $request->file("uploadXls");

        if ($excelFile) {
            $fileName = time() . '.' . $excelFile->getClientOriginalExtension();
            $response = $excelFile->move(storage_path('app/public/uploads'), $fileName);
            $success = Storage::disk('uploads')->exists($fileName);
            $sourceFile = storage_path('app/public/uploads') . '/' . $fileName;
            $isError = false;
            if ($excelFile->getClientOriginalExtension() == "csv") {
                Excel::load($sourceFile, function ($reader) use (&$isError) {
                    foreach ($reader->toArray() as $value) {
                        $row = array_values($value)[0];
                        $dataSplit = explode(";",$row);
                        $type = $dataSplit[0];
                        $register_number = $dataSplit[1];
                        $nisn = $dataSplit[2];
                        $school_name = $dataSplit[3];
                        $full_name = $dataSplit[4];
                        $status = $dataSplit[5];
                        $randomToken = str_random(16);

                        if ($register_number == "" || $nisn == "") {
                            $isError = true;
                            break;
                        }
                        try {
                            $randomToken = str_random(16);
                            $studentData = array(
                                "register_number" => $register_number,
                                "type"            => $type,
                                "school_name"     => $school_name,
                                "nisn"            => $nisn,
                                "full_name"       => $full_name,
                                "status"          => $status,
                                "token"           => $randomToken,
                            );
                            Student::create($studentData);
                        } catch (\Exception $e) {
                            $isError = true;
                            echo $e->getMessage();
                            break;
                        }
                    }
                });
            }else{
                Excel::load($sourceFile, function ($reader) use (&$isError) {
                    // print_r($reader->all()); exit;
                    foreach ($reader->all() as $data) {
                        if ($data->nomor_peserta == "" || $data->nisn == "") {
                            $isError = true;
                            break;
                        }
                        try {
                            $randomToken = str_random(16);
                            $studentData = array(
                                "register_number" => $data->nomor_peserta,
                                "type"            => $data->jalur,
                                "school_name"     => $data->asal_sekolah,
                                "nisn"            => preg_replace('/[^A-Za-z0-9\-]/', '', $data->nisn),
                                "full_name"       => $data->nama_lengkap,
                                "status"          => $data->status,
                                "token"           => $randomToken,
                            );
                            Student::create($studentData);
                        } catch (\Exception $e) {
                            $isError = true;
                            echo $e->getMessage();
                            break;
                        }
                    }
                });
            }
            if ($isError == true) {
                Session::flash("flash_notification", [
                    "level"   => "danger",
                    "message" => "gagal import data dikarenakan ada double data. silakan cek kembali",
                ]);
                return redirect()->route('admin.ppdb.prestasi');

            }
            Storage::disk('uploads')->delete($fileName);
            Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Berhasil mengimport data",
            ]);
            return redirect()->route('admin.ppdb.prestasi');
        }
    }
    public function ch_status(Request $request, $id) {
        $student = Student::findOrFail($id);
        $student->update(["status"=>$request->status]);
        return response()->json(["msg"=>"berhasil update status"]);
    }
    public function postRegular(Request $request) {
        if ($request->ajax()) {
            $registrant = Student::get_datatable();
            return Datatables::of($registrant)
                ->addColumn('action', function ($row) {
                    return view('partials._update_status', [
                        'update_status' => route("admin.ppdb.status", array("id" => $row->id)),
                        'view_data' => route("ppdb.success", array("token" => $row->register_number."-".$row->token)),
                        "status" => $row->status,
                        'hapus' => route("admin.ppdb.delete", array("id" => $row->id)),
                    ]);
                })->editColumn('status', function ($row) {
                $status = "Menunggu Konfirmasi";
                if ($row->status == 1) {
                    $status = "Diterima";
                } else if ($row->status == 2) {
                    $status = "Tidak Diterima";
                }
                return $status;
            })->editColumn('rata', function ($row) {
                return number_format(($row->indo+$row->pai+$row->pkn+$row->mtk+$row->ipa+$row->ips+$row->seni+$row->pjok)/8,2);
            })->editColumn('rownum', function ($row) use ($request) {
                return $row->rownum+$request->start;
            })
                ->make(true);
        }
    }
    private function showData($request, $htmlBuilder) {
        $data['amountBeritas'] = count(Berita::all());
        $data['amountAgendas'] = count(Agenda::all());
        $data['amountGalleries'] = count(Gallery::all());
        $htmlBuilder
        ->addColumn(['data' => 'rownum', 'name' => 'rownum', 'title' => 'No', 'orderable' => false, 'searchable' => false])
        ->addColumn(['data' => 'register_number', 'name' => 'register_number', 'title' => 'ID'])
        ->addColumn(['data' => 'nisn', 'name' => 'nisn', 'title' => 'NISN'])
        ->addColumn(['data' => 'school_name', 'name' => 'school_name', 'title' => 'Asal Sekolah'])
        ->addColumn(['data' => 'full_name', 'name' => 'full_name', 'title' => 'Nama Lengkap','class'])
        ->addColumn(['data' => 'birth_place', 'name' => 'birth_place', 'title' => 'Tempat Lahir','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'birth_date', 'name' => 'birth_date', 'title' => 'Tanggal Lahir','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'gender', 'name' => 'gender', 'title' => 'Jenis Kelamin','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'religion', 'name' => 'religion', 'title' => 'Agama','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'blood_type', 'name' => 'blood_type', 'title' => 'Golongan Darah','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'family_status', 'name' => 'family_status', 'title' => 'Status Dalam Keluarga','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'child_sequence', 'name' => 'child_sequence', 'title' => 'Anak Ke','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'address', 'name' => 'address', 'title' => 'Alamat','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'phone', 'name' => 'phone', 'title' => 'No. Telepon/HP','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'email', 'name' => 'email', 'title' => 'Email','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'father_name', 'name' => 'father_name', 'title' => 'Nama Ayah','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'mother_name', 'name' => 'mother_name', 'title' => 'Nama Ibu','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'parent_address', 'name' => 'parent_address', 'title' => 'Alamat Orangtua','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'parent_phone', 'name' => 'parent_phone', 'title' => 'No. Telepon/HP Orangtua','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'father_jobs', 'name' => 'father_jobs', 'title' => 'Pekerjaan Ayah','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'mother_jobs', 'name' => 'mother_jobs', 'title' => 'Pekerjaan Ibu','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'father_education', 'name' => 'father_education', 'title' => 'Pendidikan Terakhir Ayah','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'mother_education', 'name' => 'mother_education', 'title' => 'Pendidikan Terakhir Ibu','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'pg_name', 'name' => 'pg_name', 'title' => 'Nama Wali','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'pg_address', 'name' => 'pg_address', 'title' => 'Alamat Wali','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'pg_phone', 'name' => 'pg_phone', 'title' => 'Nomer Telepon Wali','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'pg_jobs', 'name' => 'pg_jobs', 'title' => 'Pekerjaan Wali','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'pg_education', 'name' => 'pg_education', 'title' => 'Pendidikan Terakhir Wali','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'pg_relation', 'name' => 'pg_relation', 'title' => 'Hubungan Wali dengan peseta','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'lattitudes', 'name' => 'lattitudes', 'title' => 'lattitudes','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'longitudes', 'name' => 'longitudes', 'title' => 'Longitudes','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'distance_in_km', 'name' => 'distance_in_km', 'title' => 'Jarak (km)','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'awards', 'name' => 'awards', 'title' => 'Kejuaraan','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'rank_awards', 'name' => 'rank_awards', 'title' => 'Peringkat Kejuaraan','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'level_awards', 'name' => 'level_awards', 'title' => 'Level','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'indo', 'name' => 'indo', 'title' => 'B. Indonesia','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'pai', 'name' => 'pai', 'title' => 'PAI','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'pkn', 'name' => 'pkn', 'title' => 'PKN','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'mtk', 'name' => 'mtk', 'title' => 'MTK','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'ipa', 'name' => 'ipa', 'title' => 'IPA','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'ips', 'name' => 'ips', 'title' => 'IPS','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'seni', 'name' => 'seni', 'title' => 'Seni Budaya','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'pjok', 'name' => 'pjok', 'title' => 'PJOK','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'rata', 'name' => 'rata', 'title' => 'Rata-rata','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'rank_4_1', 'name' => 'rank_4_1', 'title' => 'Rangking K4-1','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'rank_4_2', 'name' => 'rank_4_2', 'title' => 'Rangking K4-2','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'rank_5_1', 'name' => 'rank_5_1', 'title' => 'Rangking K5-1','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'rank_5_2', 'name' => 'rank_5_2', 'title' => 'Rangking K5-2','orderable' => false, 'searchable' => false, 'class'=>'column-hide'])
        ->addColumn(['data' => 'rank_6_1', 'name' => 'rank_6_1', 'title' => 'Rangking K6-1','orderable' => false, 'searchable' => false, 'class'=>'column-hide']);
        
        $htmlBuilder
            ->addColumn(['data' => 'status', 'name' => 'status', 'title' => 'Status Kelulusan', 'class' => 'column-print dt-row-status'])
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'class' => 'dt-action', 'orderable' => false, 'searchable' => false])->parameters([
                    'dom' => 'lBfrtip',
                    'drawCallback'=> 'function() { $(".update-status-ajax").bootstrapToggle(); }',
                    'buttons' => [
                        [
                            'extend'=> 'excel',
                            'exportOptions' => ["columns"=>':not(.dt-action)'],
                            "className" => "btn btn-sm btn-success",
                            "text" => '<i class="fa fa-file-excel-o fa-fw"></i> Export Data',
                        ],
                    ],
                    "lengthMenu"=> [[10, 25, 50, 100,-1], [10, 25, 50, 100, "All"]]
                ])
            ->ajax(['type' => 'POST', 'data' => '{"_method":"POST","_token": "'.csrf_token().'"}']);
        $data["html"] = $htmlBuilder;
        return view('admin.ppdb.list', $data);

    }

    public function ppdb_delete($id) {
        $student = Student::findOrFail($id);
        Student::destroy($id);
        Session::flash("flash_notification", [
            "level"   => "success",
            "message" => "Peserta telah berhasil di hapus.",
        ]);
        return redirect()->route('admin.ppdb.prestasi');
    }
}
