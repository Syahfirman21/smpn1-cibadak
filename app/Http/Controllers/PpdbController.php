<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\agenda;
use App\Http\Requests;
use App\Model\Ppdb\Register as Student;
use App\Model\Ppdb\Parents as OrangTua;
use App\Model\Ppdb\SkhuResult as Nilai;
use App\Model\Ppdb\ParentGuardian as Wali;
use App\Model\Ppdb\Attachment;
use App\Model\Ppdb\Raport;
use Carbon\Carbon;
use File;
use Storage;
use DB;

class PpdbController extends Controller
{
    //
    public function index() {
        return view('themes.ppdb.index');
    }

    public function regular() {
        return view('themes.ppdb.form-cek');
    }

    public function uploads_attachments(Request $request) {
        $validateItem = [
            "nisn" => ["required"],
            "file" => ["required"]
        ];
        $this->validate($request,$validateItem);
        $file = $request->file("file");
        $nisn = $request->nisn;
        $type = $request->attach_type;
        $fileNames = array();
        $PATH = storage_path('app/public/attachments/'.$nisn);
        if(!File::isDirectory($PATH)){
            File::makeDirectory($PATH, 0777, true, true);
        }
        if ($file) {
            $name = array("noname","KTP-Orangtua","KK","Akta-Kelahiran","Raport-4-1","Raport-4-2","Raport-5-1",
            "Raport-5-2","Raport-6-1","Surat-Tugas-Orangtua","Surat-Keterangan-Tidak-Mampu","Sertifikat-Kejuaraan");
            $fileName = $name[$type] . '.' . $file->getClientOriginalExtension();
            $response = $file->move($PATH, $fileName);
            $sourceFile = $PATH . '/' . $fileName;
            $fileNames[] = $fileName;
            Attachment::firstOrNew([ 
                "nisn"      => $nisn,
                "type"      => $type,
                "atachment" => $fileName,
            ])->save();
            echo json_encode($fileNames);

        }
    }

    public function result(Request $request) {
        $now = Carbon::today();
        $openReguler = Carbon::create(2021,7,5,0,0,0);
        $validateItem = [
            "register_number" => ["required"],
            "school_name"     => ["required"],
            "nisn"            => ["required"],
            "full_name"       => ["required"],
        ];
        $this->validate($request, $validateItem);
        $registrant = Student::where([
            "register_number" => $request->register_number,
            "nisn"            => $request->nisn
        ])->first();
        
        if ($registrant) {
        $pendaftaran = route('ppdb.success', ['token' => $registrant->register_number . "-" . $registrant->token]);
        }else{
            $pendaftaran = "#";
        }
        $jalur = array("None","EKTM/Afirmasi","Prestasi akademik ","Prestasi non akademik/Kejuaraan ","Pindah tugas orangtua/guru ","Zonasi");
        return view('themes.ppdb.result',compact("pendaftaran","registrant","now","openReguler","jalur"));
    }

    public function daftar() {
        return view('themes.ppdb.daftar');
    }

    public function daftarPost(Request $request) {
        $this->__validate($request);
        $randomToken = str_random(16);
        $registerNumber = Student::getRegisterNumber($request->jalur);
        $koordinat = explode(",",$request->koordinat);
        $studentData = array(
            "register_number" => $registerNumber,
            "register_date"   => Carbon::today(),
            "jalur"           => $request->jalur,
            "school_name"     => $request->school_name,
            "nisn"            => $request->nisn,
            "full_name"       => $request->full_name,
            "birth_place"     => $request->birth_place,
            "birth_date"      => $request->birth_date,
            "gender"          => $request->gender,
            "religion"        => $request->religion,
            "blood_type"      => $request->blood_type,
            "family_status"   => $request->family_status,
            "child_sequence"  => $request->child_sequence,
            "address"         => $request->address,
            "phone"           => $request->phone,
            "email"           => $request->email,
            "rank_4_1"        => $request->rank_4_1,
            "rank_4_2"        => $request->rank_4_2,
            "rank_5_1"        => $request->rank_5_1,
            "rank_5_2"        => $request->rank_5_2,
            "rank_6_1"        => $request->rank_6_1,
            "awards"          => $request->awards,
            "rank_awards"     => $request->rank_awards,
            "level_awards"    => $request->level_awards,
            "status"          => 0,
            "token"           => $randomToken,
        );
        if (isset($koordinat[0]) && isset($koordinat[1])) {
            $studentData["lattitudes"] = floatval($koordinat[0]);
            $studentData["longitudes"] = floatval($koordinat[1]);
        }

        $register = Student::create($studentData);

        $parents = array(
            "registerid"       => $register->id,
            "father_name"      => $request->father_name,
            "mother_name"      => $request->mother_name,
            "parent_address"   => $request->parent_address,
            "parent_phone"     => $request->parent_phone,
            "father_jobs"      => $request->father_jobs,
            "mother_jobs"      => $request->mother_jobs,
            "father_education" => $request->father_education,
            "mother_education" => $request->mother_education,
        );
        OrangTua::create($parents);

        $wali = array(
            "registerid"   => $register->id,
            "pg_name"      => $request->pg_name,
            "pg_address"   => $request->pg_address,
            "pg_phone"     => $request->pg_phone,
            "pg_jobs"      => $request->pg_jobs,
            "pg_education" => $request->pg_education,
            "pg_relation"  => $request->pg_relation
        );

        if ($request->pg_name !="") {
            Wali::create($wali);
        }

        //Nilai if jalur == Prestasi akademik == 2

        if ($request->jalur == 2) {
            //1=Bahasa Indonesia, 2=PAI, 3=PKN, 4=MTK, 5=IPA, 6=IPS, 7=Seni, 8=PJOK
            Raport::create([
                "registerid" => $register->id, "mapel"         => 1, 
                "nilai_4_1"  => $request->indo_4_1,"nilai_4_2" => $request->indo_4_2,
                "nilai_5_1"  => $request->indo_5_1,"nilai_5_2" => $request->indo_5_2,
                "nilai_6_1"  => $request->indo_6_1
            ]);

            Raport::create([
                "registerid" => $register->id, "mapel"         => 2, 
                "nilai_4_1"  => $request->pai_4_1,"nilai_4_2" => $request->pai_4_2,
                "nilai_5_1"  => $request->pai_5_1,"nilai_5_2" => $request->pai_5_2,
                "nilai_6_1"  => $request->pai_6_1
            ]);

            Raport::create([
                "registerid" => $register->id, "mapel"         => 3, 
                "nilai_4_1"  => $request->pkn_4_1,"nilai_4_2" => $request->pkn_4_2,
                "nilai_5_1"  => $request->pkn_5_1,"nilai_5_2" => $request->pkn_5_2,
                "nilai_6_1"  => $request->pkn_6_1
            ]);

            Raport::create([
                "registerid" => $register->id, "mapel"         => 4, 
                "nilai_4_1"  => $request->mtk_4_1,"nilai_4_2" => $request->mtk_4_2,
                "nilai_5_1"  => $request->mtk_5_1,"nilai_5_2" => $request->mtk_5_2,
                "nilai_6_1"  => $request->mtk_6_1
            ]);

            Raport::create([
                "registerid" => $register->id, "mapel"         => 5, 
                "nilai_4_1"  => $request->ipa_4_1,"nilai_4_2" => $request->ipa_4_2,
                "nilai_5_1"  => $request->ipa_5_1,"nilai_5_2" => $request->ipa_5_2,
                "nilai_6_1"  => $request->ipa_6_1
            ]);

            Raport::create([
                "registerid" => $register->id, "mapel"         => 6, 
                "nilai_4_1"  => $request->ips_4_1,"nilai_4_2" => $request->ips_4_2,
                "nilai_5_1"  => $request->ips_5_1,"nilai_5_2" => $request->ips_5_2,
                "nilai_6_1"  => $request->ips_6_1
            ]);

            Raport::create([
                "registerid" => $register->id, "mapel"         => 7, 
                "nilai_4_1"  => $request->seni_4_1,"nilai_4_2" => $request->seni_4_2,
                "nilai_5_1"  => $request->seni_5_1,"nilai_5_2" => $request->seni_5_2,
                "nilai_6_1"  => $request->seni_6_1
            ]);

            Raport::create([
                "registerid" => $register->id, "mapel"         => 8, 
                "nilai_4_1"  => $request->pjok_4_1,"nilai_4_2" => $request->pjok_4_2,
                "nilai_5_1"  => $request->pjok_5_1,"nilai_5_2" => $request->pjok_5_2,
                "nilai_6_1"  => $request->pjok_6_1
            ]);
        }

        return response()->json(["success" => "1", "redirect" => route('ppdb.success',['token' => $registerNumber."-".$randomToken]), "message" => "Pendaftaran berhasil disimpan, silakan klik ok untuk mengunduh form pendaftaran dan kartu peserta"]);
    }

    public function success($token) {
        $split = explode("-",$token);
        if (!isset($split[1])) 
            return abort(404);
        $lat = "-6.8943916";
        $lon = "106.7903947";
        $cek = Student::select("*",
            DB::raw('111.111 * DEGREES(ACOS(LEAST(1.0, COS(RADIANS('.$lat.'))
         * COS(RADIANS(lattitudes))
         * COS(RADIANS('.$lon.' - longitudes))
         + SIN(RADIANS('.$lat.'))
         * SIN(RADIANS(lattitudes))))) AS distance_in_km')
        )->where(["register_number"=>$split[0],"token"=>$split[1]])->firstOrFail();
        $mapelArr = array("","Bahasa Indonesia", "PAI", "PKN", "MTK", "IPA", "IPS","Seni Budaya", "PJOK");
        if ($cek) {
            $registrant = $cek;
            $parents = OrangTua::where("registerid",$cek->id)->first();
            $wali = Wali::where("registerid", $cek->id)->first();
            $raports = Raport::where("registerid", $cek->id)->get();
            $raportArr = array();
            foreach ($raports as $raport) {
                $raport->matapel = $mapelArr[$raport->mapel];
                $raportArr[$raport->mapel] = $raport;
            }
            $attachments = Attachment::where("nisn", $cek->nisn)->get();
            $jalur = array("None","EKTM/Afirmasi","Prestasi akademik ","Prestasi non akademik/Kejuaraan ","Pindah tugas orangtua/guru ","Zonasi");
            return view('themes.ppdb.success',compact("registrant","jalur","parents","wali","raportArr","attachments"));
        }
    }

    public function view_attachment(Request $request) {
        $fileName = $request->get("filename");
        $nisn = $request->get("nisn");
        $PATH = 'app/public/attachments/'.$nisn.'/'.$fileName;
        $filePath =storage_path($PATH);
        $type = File::mimeType($filePath);
        return response(file_get_contents($filePath))->header('Content-type', $type);
    }
    
    public function download(Request $request) {
        $fileName = $request->filename;
        $nisn = $request->nisn;
        $PATH = 'app/public/attachments/'.$nisn.'/'.$fileName;
        if (\Storage::disk('attachments')->exists($nisn.'/'.$fileName)) {
            $file =storage_path($PATH);
            return response()->download($file);
        }else{
            return "File Not found";
        }
    }

    public function __validate(Request $request) {
        $validateItem = [
            "school_name"    => ["required"],
            "nisn"           => ["required","unique:ppdb_registers"],
            "jalur"          => ["required"],
            "koordinat"      => ["required"],
            "full_name"      => ["required"],
            "birth_place"    => ["required"],
            "birth_date"     => ["required","date"],
            "gender"         => ["required"],
            "religion"       => ["required"],
            "family_status"  => ["required"],
            "child_sequence" => ["required"],
            "address"        => ["required"],
            "father_name"    => ["required"],
            "mother_name"    => ["required"],
            "parent_address" => ["required"],
            "parent_phone"   => ["required"],
            "father_jobs"    => ["required"],
        ];

        return $this->validate($request,$validateItem);
    }
}
