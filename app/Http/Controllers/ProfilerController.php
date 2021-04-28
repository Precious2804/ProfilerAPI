<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Artisan;
use App\Models\User_request;
use Illuminate\Http\Request;

class ProfilerController extends Controller
{
    //
    function showMembers(Request $req){
        return Member::all();
    }

    function addMember(Request $req){
        $member = new Member;
        $member->username=$req->username;
        $member->email=$req->email;
        $member->password=$req->password;
        $result = $member->save();

        if($result){
            return ["Result"=>"New Data has been Added"];
        } else{
            return ["Result"=>"Operation Failed!!"];
        }
    }
    function deleteMember($id){
        $member = Member::find($id);
        $result = $member->delete();

        if($result){
            return ["Result"=>"Deleted"];
        } else{
            return ["Result"=>"Operation Failed!!"];
        }
    }

    function showArtisans(){
        return Artisan::all();
    }

    function addArtisans(Request $req){
        // Artisan::create([
        //     'art_fname' => $req->art_fname,
        // ]);
        $artisan = new Artisan;
        $artisan->artFname=$req->artFname;
        $artisan->artLname=$req->artLname;
        $artisan->artUser=$req->artUser;
        $artisan->artEmail=$req->artEmail;
        $artisan->artPhone=$req->artPhone;
        $artisan->artGender=$req->artGender;
        $artisan->artDate=$req->artDate;
        $artisan->category=$req->category;
        $artisan->artAddress=$req->artAddress;
        $artisan->password=$req->password;
        $artisan->artAbout=$req->artAbout;
        $result2 = $artisan->save();

        if($result2){
            return ["Result"=>"New Data has been Added"];
        } else{
            return ["Result"=>"Operation Failed!!"];
        }
    }
    function deleteArtisan($id){
        $artisan = Artisan::find($id);
        $result = $artisan->delete();

        if($result){
            return ["Result"=>"Deleted"];
        } else{
            return ["Result"=>"Operation Failed!!"];
        }
    }

    function showRequests(){
        return User_request::all();
    }
    function addRequests(Request $req){
        $fetch = new User_request;
        $fetch->id=$req->id;
        $fetch->username=$req->username;
        $fetch->category=$req->category;
        $fetch->sub_category=$req->sub_category;
        $fetch->location=$req->location;
        $fetch->req_date=$req->req_date;
        $fetch->exp_date=$req->exp_date;
        $fetch->description=$req->description;
        $result3 = $fetch->save();

        if($result3){
            return ["Result"=>"New Request has been Sent"];
        } else{
            return ["Result"=>"Operation Failed!!"];
        }
    }  
}
