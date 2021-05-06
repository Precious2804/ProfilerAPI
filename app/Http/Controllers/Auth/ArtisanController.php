<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArtisanController extends Controller
{
    /**
     * Create a new ArtisanController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('jwt', ['except' => ['loginArtisan', 'registerArtisan']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginArtisan(Request $request){
    	$validator = Validator::make($request->all(), [
            'art_user' => 'required',
            'password' => 'required|string'
        ]);

        $validated = $validator->validated();

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = auth()->guard('artisan')->attempt(['art_user' => $validated['art_user'], 'password' => $request->password])) {
            return response([
                'status' => false,
                'message' => "Incorrect Username / Password",
                'data' => ""
            ], 401);
        }

        return response([
            'status' => true,
            'message' => "Login Was Successful",
            "data" => auth()->guard('artisan')->user()
        ], 201)->header('Authorization', "Bearer ".$token);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function registerArtisan(Request $request) {
        $validator = Validator::make($request->all(), [
            'art_fname' => 'required|string|between:2,20',
            'art_lname' => 'required|string|between:2,20',
            'art_user' => 'required|string|between:2,100|unique:artisans',
            'art_email' => 'required|string|email|max:100|unique:artisans',
            'art_phone' => 'required|string|max:11|min:11',
            'art_gender' => 'required|string',
            'art_age' => 'required|string',
            'category' => 'required|string',
            'art_address' => 'required|string|max:255',
            'art_about' => 'required|string|between:2,255',
            'password' => 'required|string|min:6'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 401);
        }

        $unique_id = $this->getUniqueId();

        $artisan = Artisan::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password), 'id' => $unique_id]
                ));

        return response()->json([
            'message' => 'Artisan successfully registered',
            'artisan' => $artisan
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

        if (Artisan::find($id)) {
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
    public function logoutArtisan() {
        Auth::guard('artisan')->logout();

        return response()->json(['message' => 'Artisan successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshArtisan() {
        return $this->createNewToken(auth()->guard('artisan')->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function artProfile() {
    //     return response()->json(auth()->guard('artisan')->user());
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
            'expires_in' => auth()->guard('artisan')->factory()->getTTL() * 60,
            'artisan' => auth()->guard('artisan')->user()
        ]);
    }

}

