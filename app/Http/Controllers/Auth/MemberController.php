<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class MemberController extends Controller
{
    /**
     * Create a new MemberController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('jwt', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = auth()->guard('member')->attempt($validator->validated())) {
            // return response()->json(['error' => 'Unauthorized'], 401);
            return response([
                'status' => false,
                'message' => "Incorrect Username / Password",
                'data' => ""
            ], 401);

        }

        return response([
            'status' => true,
            'message' => "Login Was Successful",
            "data" => auth()->guard('member')->user()
        ], 201)->header('Authorization', "Bearer ".$token);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|between:2,100|unique:members',
            'email' => 'required|string|email|max:100|unique:members',
            'phone' => 'required|string|max:11|min:11',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:6'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $unique_id = $this->getUniqueId();

        $member = Member::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password), 'id' => $unique_id]
                ));

        return response()->json([
            'status' => true,
            'message' => 'User successfully registered',
            'member' => $member
        ], 201);
    }

    private function generateId(){
        $unique_id = (string) Str::uuid();
        $exploded = explode('-', $unique_id);
        $n_unique_id = $exploded[4];
        return $n_unique_id;
    }

    private function getUniqueId(){
        $id = $this->generateId();

        if (Member::find($id)) {
            $this->getUniqueId();
        }else{
            return $id;
        }
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        Auth::guard('member')->logout();

        return response()->json(['message' => 'successfully signed out']);

        return response()->json([
            'status' => true,
            'message' => 'Log out was Successfull'
        ], 201);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->guard('member')->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function userProfile() {
    //     return response()->json(auth()->guard('member')->user());
    // }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('member')->factory()->getTTL() * 60,
            'member' => auth()->guard('member')->user()
        ]);
    }

}

