<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Agenda;
use App\Models\Gallery;
use App\Models\Saran;
use App\Models\Student;
use App\Models\Home;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class GlobalAdminController extends Controller
{
    public function index()
    {
        $data['amountBeritas'] = Berita::count();
        $data['amountAgendas'] = Agenda::count();
        $data['amountSarans'] = Saran::count();
        $data['amountGalleries'] = Gallery::count();
        $data['amountStudents'] = Student::count();
        return view('admin.dashboard', $data);
    }

    public function editHome($id)
    {
        $data['amountBeritas'] = Berita::count();
        $data['amountAgendas'] = Agenda::count();
        $data['amountGalleries'] = Gallery::count();
        $data['home'] = Home::find($id);
        return view('admin.homePageEdit', $data);
    }

    public function updateHome(Request $request, $id)
    {
        $this->validate($request, [
            'profile' => 'required',
            'embed' => 'required',
            'profileSekolah' => 'required'
        ]);

        $home = Home::find($id);
        $home->update([
            'profile' => $request->profile,
            'embed' => $request->embed,
            'profileSekolah' => $request->profileSekolah
        ]);

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Sukses mengedit home"
        ]);

        return redirect()->route('admin.home.edit', $id);
    }

    public function settingSite()
    {
        $data['amountBeritas'] = Berita::count();
        $data['amountAgendas'] = Agenda::count();
        $data['amountGalleries'] = Gallery::count();
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
            "level" => "success",
            "message" => "Sukses mengupdate social link"
        ]);

        return redirect()->route('admin.setting');
    }

    public function updatePass(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6',
            'newPassword' => 'required|min:6|confirmed',
        ]);

        if (!password_verify($request->password, Auth::user()->password)) {
            Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "Password lama tidak valid"
            ]);
            return redirect()->route('admin.setting');
        }

        $user = Auth::user();
        $user->update([
            'password' => bcrypt($request->newPassword),
        ]);

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Password berhasil diganti"
        ]);

        return redirect()->route('admin.setting');
    }
}
