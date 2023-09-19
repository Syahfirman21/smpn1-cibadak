<?php

namespace App\Model\Ppdb;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    protected $table = "ppdb_registers";
    protected $guarded = ["id"];
    public $timestamps = true;

    public function nilai() {
        return $this->belongsTo("App\Model\Ppdb\SkhuResult","id","registerid");
    }
    public static function get_datatable($jalur="all") {
        $lat = "-6.8943916";
        $lon = "106.7903947";
        DB::statement(DB::raw("SET @rownum=0"));
        $query = self::select([DB::raw("@rownum := @rownum+1 AS rownum, 
        (select (nilai_4_1+nilai_4_2+nilai_5_1+nilai_5_2+nilai_6_1)/5 from ppdb_raports WHERE registerid=ppdb_registers.id and mapel='1') as indo,
        (select (nilai_4_1+nilai_4_2+nilai_5_1+nilai_5_2+nilai_6_1)/5 from ppdb_raports WHERE registerid=ppdb_registers.id and mapel='2') as pai,
        (select (nilai_4_1+nilai_4_2+nilai_5_1+nilai_5_2+nilai_6_1)/5 from ppdb_raports WHERE registerid=ppdb_registers.id and mapel='3') as pkn,
        (select (nilai_4_1+nilai_4_2+nilai_5_1+nilai_5_2+nilai_6_1)/5 from ppdb_raports WHERE registerid=ppdb_registers.id and mapel='4') as mtk,
        (select (nilai_4_1+nilai_4_2+nilai_5_1+nilai_5_2+nilai_6_1)/5 from ppdb_raports WHERE registerid=ppdb_registers.id and mapel='5') as ipa,
        (select (nilai_4_1+nilai_4_2+nilai_5_1+nilai_5_2+nilai_6_1)/5 from ppdb_raports WHERE registerid=ppdb_registers.id and mapel='6') as ips, 
        (select (nilai_4_1+nilai_4_2+nilai_5_1+nilai_5_2+nilai_6_1)/5 from ppdb_raports WHERE registerid=ppdb_registers.id and mapel='7') as seni, 
        (select (nilai_4_1+nilai_4_2+nilai_5_1+nilai_5_2+nilai_6_1)/5 from ppdb_raports WHERE registerid=ppdb_registers.id and mapel='8') as pjok, 
        0 as rata"),'ppdb_registers.id', 'register_number', 'nisn', 'jalur', 'school_name', 'full_name','birth_place','birth_date','gender','religion', 'blood_type', 'family_status', 'child_sequence', 'address', 'phone','email','father_name','mother_name','parent_address','parent_phone','father_jobs','mother_jobs','father_education','mother_education','pg_name','pg_address','pg_phone','pg_jobs','pg_education','pg_relation','token', 'status','rank_4_1','rank_4_2','rank_5_1','rank_5_2','rank_6_1','awards','rank_awards','level_awards','lattitudes','longitudes',DB::raw('111.111 * DEGREES(ACOS(LEAST(1.0, COS(RADIANS('.$lat.'))
         * COS(RADIANS(lattitudes))
         * COS(RADIANS('.$lon.' - longitudes))
         + SIN(RADIANS('.$lat.'))
         * SIN(RADIANS(lattitudes))))) AS distance_in_km')])->leftJoin("ppdb_parent_guardians", function($join) {
            $join->on("ppdb_parent_guardians.registerid","=","ppdb_registers.id");
        })->leftJoin("ppdb_parents", function($join) {
            $join->on("ppdb_parents.registerid","=","ppdb_registers.id");
        });
        
        // $query = self::select([DB::raw("@rownum := @rownum+1 AS rownum"),'ppdb_registers.id', 'register_number', 'nisn', 'school_name', 'full_name','token', 'status']);

        if ($jalur != "all") 
            return $query->where("jalur",$jalur);
        else
            return $query;
    }
    
    public static function getRegisterNumber($jalur="2") {
        $jalurArr = array("0","A","B","C","D","E");
        $code = $jalurArr[$jalur];
        $now = Carbon::now();
        $tahunAjaran = $now->format("y").($now->copy()->addYear())->format("y");
        return $code.$tahunAjaran.self::getSquence();
    }

    public static function getSquence() {
        $now = Carbon::now();
        $year = $now->year;
        $month = $now->month;
        $data = self::select(DB::raw("CONVERT(substr(register_number,-3),integer) as seq_number"))->where(DB::raw("YEAR('regiter_date') = '$year'"))->orderBy("id","desc")->first();
        $seq_number = $data ? $data->seq_number+1 : 1;
        return str_pad($seq_number,3,"0",STR_PAD_LEFT);
    }
}
