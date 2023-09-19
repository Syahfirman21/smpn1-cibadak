<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Home;
use App\Page;
use App\teacher as Teacher;
use App\Http\Requests;

class PageController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($role)
    {
        $data['home'] = Home::first();
        $data['fotoKepala'] = Teacher::select('thumbnail')->where('nip', '195706111979031007')->first();
        $data['pageRole'] = Page::where('role', $role)->firstOrFail();
        return view('themes.pages', $data);
    }

}
