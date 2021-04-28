<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Crypt;

class WebProfilerController extends Controller
{
    //
    function index(){
        return view("index");
    } 

    function regArtisan(Request $req){
         $req->validate([
            'art_user' => 'required',
            'art_email' => 'required|email',
            'art_phone' => 'required',
            'category' => 'required',
            'art_address' => 'required',
            'password' => 'required|confirmed',
            ]);
        $artisan = new Member;
        $artisan->artFname=$req->artFname;
        $artisan->artLname=$req->artLname;
        $artisan->artUser=$req->artUser;
        $artisan->artEmail=$req->artEmail;
        $artisan->artPhone=$req->artPhone;
        $artisan->artGender=$req->artGender;
        $artisan->artDate=$req->artDate;
        $artisan->category=$req->category;
        $artisan->artAddress=$req->artAddress;
        $artisan->password = Crypt::encrypt($req->input('password'));
        $artisan->artAbout=$req->artAbout;
        $artisan->save();
        $req->session()->put('artUser', $req['artUser']);
        return redirect('login');

    }
    function loginArtisan(Request $req)
    {
        $artisan = Member::where('artUser', $req->input('artUser'))->get();

        if (Crypt::decrypt($artisan[0]->password)==$req->input('password')){
            $req->session()->put('artUser', $artisan[0]->artUser);
            return redirect('/');
        }
    }
}
