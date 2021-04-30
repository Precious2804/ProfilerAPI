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
        $result = Member::all();

        if ($result){
            return ["status"=>"true",
                    "message"=>"List of Users",
                    "data"=> $result
                ];
        } else{
            return ["status"=>"false",
                    "message"=>"Operation Failed",
                    "data"=>""
        ];
        }
    }

    function addMember(Request $req){
        $member = new Member;
        $member->username=$req->username;
        $member->email=$req->email;
        $member->password=$req->password;
        $details = [
                    $member->username,
                    $member->email,
                    $member->password
        ];
        $result = $member->save();

        if($result){
            return ["status"=>"true",
                    "message"=>"New Member has been Added",
                    "data"=>$details
        ];
        } else{
            return ["status"=>"false",
                    "message"=>"Operation Failed",
                    "data"=>""
        ];
        }
    }
    function deleteMember($id){
        $member = Member::find($id);
        $result = $member->delete();

        if($result){
            return ["status"=>"true",
                    "message"=>"Deleted",
                    "data"=>"$member has been Deleted"
        ];
        } else{
            return ["status"=>"false",
                    "message"=>"Operation Failed",
                    "data"=>""
        ];
        }
    }

    function showArtisans(){
        $result = Artisan::all();
        if ($result){
            return ["status"=>"true",
                    "message"=>"Artisans",
                    "data"=> $result
                ];
        } else{
            return ["status"=>"false",
                    "message"=>"Operation Failed",
                    "data"=>""
        ];
        }
    }

    function addArtisans(Request $req){
        // Artisan::create([
        //     'art_fname' => $req->art_fname,
        // ]);
        $artisan = new Artisan;
        $artisan->art_fname=$req->art_fname;
        $artisan->art_lname=$req->art_lname;
        $artisan->art_user=$req->art_user;
        $artisan->art_email=$req->art_email;
        $artisan->art_phone=$req->art_phone;
        $artisan->art_gender=$req->art_gender;
        $artisan->art_age=$req->art_age;
        $artisan->category=$req->category;
        $artisan->art_address=$req->art_address;
        $artisan->password=$req->password;
        $artisan->art_about=$req->art_about;
        $details = [
                    $artisan->art_fname,
                    $artisan->art_lname,
                    $artisan->art_user,
                    $artisan->art_email,
                    $artisan->art_phone,
                    $artisan->art_gender,
                    $artisan->art_age,
                    $artisan->category,
                    $artisan->art_address,
                    $artisan->password,
                    $artisan->art_about
        ];
        $result2 = $artisan->save();

        if($result2){
            return ["status"=>"true",
                    "message"=>"New Member has been Added",
                    "data"=>$details
        ];
        } else{
            return ["status"=>"false",
                    "message"=>"Operation Failed",
                     "data"=>""
                    ];
        }
    }
    function deleteArtisan($id){
        $artisan = Artisan::find($id);
        $result = $artisan->delete();

        if($result){
            return ["status"=>"true",
                    "message"=>"Deleted",
                    "data"=>"$artisan has been Deleted"
        ];
        } else{
            return ["status"=>"false",
                    "message"=>"Operation Failed",
                    "data"=>""
        ];
        }
    }

    function showRequests(){
        $result = User_request::all();
        if ($result){
            return ["status"=>"true",
                    "message"=>"List of Request",
                    "data"=> $result
                ];
        } else{
            return ["status"=>"false",
                    "message"=>"Operation Failed",
                    "data"=>""
        ];
        }
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
        $details = [
                    $fetch->id,
                    $fetch->username,
                    $fetch->category,
                    $fetch->sub_category,
                    $fetch->location,
                    $fetch->req_date,
                    $fetch->exp_date,
                    $fetch->description

        ];
        $result3 = $fetch->save();

        if($result3){
            return ["status"=>"true",
                    "message"=>"New Request Added",
                    "data"=>$details
        ];
        } else{
            return ["status"=>"false",
                    "message"=>"Operation Failed",
                     "data"=>""
                    ];
        }
    }  
}
