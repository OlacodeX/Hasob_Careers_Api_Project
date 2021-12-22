<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Http\Resources\AuthResource;
use Illuminate\Http\Request;
use App\Events\UserRegistered;
use Symfony\Component\HttpFoundation\Response; 

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_all_users()
    {
        //
        $user = User::paginate(10);
       if (count($user) < 1) {
           return  response([
               'message' => 'No registered user(s) yet!'
           ]);
        } else {
            return AuthResource::collection($user);
        }
        
        
    }

    public function getParticularUser($id)
    {
        //
        $user = User::findOrFail($id); 
        return new AuthResource($user); 
        
        
    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        //
       $this->validate($request, [
           'firstName' => 'required',
           'lastName' => 'required', 
            'middleName' => 'required',
           'email' => 'required',
           'phone_number' => 'required', 
            'is_disabled' => 'required',
           'password' => 'required',
           'picture_url' => 'required' 
            ]);
        $user = new User();
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->middleName = $request->middleName;
        $user->email = $request->email; 
        $user->phone_number = $request->phone_number;
        $user->is_disabled = $request->is_disabled;
        $user->picture_url = $request->picture_url;
        $user->password = Hash::make($request->password);
        if ($user->save()) {
            event(new UserRegistered($user));
           return new AuthResource($user);
        }

    }
    public function login(Request $request){
       if (!Auth::attempt($request->only('email', 'password'))){
           return response([
               'message' => 'Invalid credentials!'
           ], Response::HTTP_UNAUTHORIZED);
       }
       $user = Auth::user();
       if ($user->is_disabled == 'Yes') {
           return response([
               'message' => 'Your account has been disabled!'
           ], Response::HTTP_UNAUTHORIZED);
       }
       $token = $user->createToken('token')->plainTextToken;
       //we use cookie to store the generated token with which we will identify the logged in user
       $cookie = cookie('jwt', $token, 60 * 24); // 1 day validity

       return response([
           'message' => 'Success'
       ])->withCookie($cookie);
    }

    public function loggedInUser(){
        return Auth::user();
    }

    public function logout(Request $request){
        $cookie = Cookie::forget('jwt');
        
       return response([
           'message' => 'Success'
       ])->withCookie($cookie);
    }
    
    
    public function update(Request $request, $id)
    {
        //
        $user = User::findOrFail($id);
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->middleName = $request->middleName;
        $user->email = $request->email; 
        $user->phone_number = $request->phone_number;
        $user->is_disabled = $request->is_disabled;
        $user->picture_url = $request->picture_url;
        $user->password = Hash::make($request->password);
        if ($user->save()) {
           return new AuthResource($user);
        }
    } 

    public function destroy($id)
    {
        //
        $user = User::findOrFail($id); 
        if ($user->delete()) {
           return new AuthResource($user);
        }
    }
    
}
