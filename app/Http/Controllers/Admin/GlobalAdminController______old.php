<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\berita as Berita;
use App\agenda as Agenda;
use App\Gallery;
use App\saran;
use App\Student;
use App\Home;
use App\User;
use Session;
use Auth;

class GlobalAdminController extends Controller
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
        $data['amountSarans'] = count(saran::all());
        $data['amountGalleries'] = count(Gallery::all());
        $data['amountStudents'] = count(Student::all());
        return view('admin.dashboard', $data);
    }

    public function editHome($id)
    {
        $data['amountBeritas'] = count(Berita::all());
        $data['amountAgendas'] = count(Agenda::all());
        $data['amountGalleries'] = count(Gallery::all());
        $data['home'] = Home::find($id);
        return view('admin.homePageEdit', $data);
    }
    public function updateHome(Request $request, $id)
    {
        $this->validate($request, [
            'profile' => 'required',
            'welcome' => 'required',
            'embed' => 'required',
            'profileSekolah' => 'required'
        ]);
        $home = Home::find($id);
        $home->update([
            'profile' => $request->profile,
            'welcome' => $request->welcome,
            'embed' => $request->embed,
            'profileSekolah' => $request->profileSekolah
        ]);
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Sukses mengedit home"
        ]);
        return redirect()->route('admin.home.edit', $id);
    }
    public function settingSite()
    {
        $data['amountBeritas'] = count(Berita::all());
        $data['amountAgendas'] = count(Agenda::all());
        $data['amountGalleries'] = count(Gallery::all());
        $data['setting'] = Home::find(1);
        return view('admin.setting', $data);
    }
    public function updateLink(Request $request)
    {
        $this->validate($request, [
            'fblink' => 'required',
            'twtlink' => 'required',
            'gpluslink' => 'required'
        ]);

        $link = Home::first();
        $link->update([
            'fblink' => $request->fblink,
            'twtlink' => $request->twtlink,
            'gpluslink' => $request->gpluslink
        ]);
        $link->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Sukses mengupdate social link"
        ]);
        return redirect()->route('admin.setting');
    }
    public function updatePass(Request $request) {
        $this->validate($request, [
            'password' => 'required|min:6',
            'newPassword' => 'required|min:6|confirmed',
        ]);

        if(!password_verify($request->password, Auth::user()->password)) {
            Session::flash("flash_notification", [
                "level"=>"danger",
                "message"=>"Password lama tidak valid"
            ]);
            return redirect()->route('admin.setting');
        }

        $pass = User::first();
        $pass->update([
            'password' => bcrypt($request->newPassword),
        ]);
        $pass->save();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Password berhasil diganti"
        ]);
        return redirect()->route('admin.setting');
    }
}
