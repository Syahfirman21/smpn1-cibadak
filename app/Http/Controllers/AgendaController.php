<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Home;
use App\agenda;
use App\Http\Requests;
use DB;

class AgendaController extends Controller
{
    public function show($id, $slug)
    {
    	$data['agendas'] = agenda::where('id', '=', $id)->where('slug','=', $slug)->firstOrFail();
    	$data['home'] = Home::first();
	    return view('themes.agenda', $data);
    }
}
