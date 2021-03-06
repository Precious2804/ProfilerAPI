<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Artisan;
use App\Models\Category;
use App\Models\User_request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            $member = Member::where('username', $req['username'])->where('email', $req['email']);

            if($member){
                $response['status'] = false;
                $response['message'] = "Username / Email Already Exists";
                $response['code'] = 409;
                $response['data'] = "";
            } 

        else{
            $this->validate($req, [
                'username' => 'required',
                'email' => 'required|email',
                'phone' => 'required|min:11|max:11',
                'password' => 'required|min:6|confirmed',
            ]);

            $member = Member::create([
            'username' =>$req->username,
            'email' =>$req->email,
            'phone' =>$req->phone,
            'address' =>$req->address,
            'password' =>bcrypt($req->password)
            ]);
            $response['status'] = true;
            $response['message'] = "New Member Has been added";
            $response['code'] = 200;
            $response['data'] = $member;
        }
        
        return response()->json($response);
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
                    "art_fname"=>$artisan->art_fname,
                    "art_lname"=>$artisan->art_lname,
                    "art_user"=>$artisan->art_user,
                    "art_email"=>$artisan->art_email,
                    "art_phone"=>$artisan->art_phone,
                    "art_gender"=>$artisan->art_gender,
                    "art_age"=>$artisan->art_age,
                    "category"=>$artisan->category,
                    "art_address"=>$artisan->art_address,
                    "art_passord"=>$artisan->password,
                    "art_about"=>$artisan->art_about
        ];
        $result2 = $artisan->save();

        if($result2){
            return ["status"=>"true",
                    "message"=>"New Artisan has been Added",
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
                    "id"=>$fetch->id,
                    "username"=>$fetch->username,
                    "category"=>$fetch->category,
                    "sub_category"=>$fetch->sub_category,
                    "location"=>$fetch->location,
                    "req_date"=>$fetch->req_date,
                    "exp_date"=>$fetch->exp_date,
                    "description"=>$fetch->description

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

    function showCategories(){
        $result = Category::all();
        if ($result){
            return ["status"=>"true",
                    "message"=>"List of Categories",
                    "data"=> $result
                ];
        } else{
            return ["status"=>"false",
                    "message"=>"Operation Failed",
                    "data"=>""
        ];
        }
    }
}
