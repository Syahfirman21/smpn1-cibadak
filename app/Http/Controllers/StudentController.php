<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Home;
use App\Http\Requests;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($class_id, $kelas)
    {
        $data['home'] = Home::first();
        $data['siswa'] = Student::where('kelas', $kelas)->where('class_id', $class_id)->orderBy('nama', 'asc')->get();
        return view('themes.siswa', $data);
    }
}
