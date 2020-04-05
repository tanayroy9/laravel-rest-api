<?php
/**
 * User:Tanay Kumar Roy
 * Email:tanayroy12@gmail.com
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com> on 4/3/2020.
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomController extends Controller
{
    public function registration(Request $request){
        $this->validate($request,[
           'name'=>'required',
           'email'=>'required|unique:users,email',
           'password'=>'required',
           'confirm_password'=>'required|same:password'
        ]);
        $row = User::create([
           'name'=>$request->name,
           'email'=>$request->email,
           'password'=>bcrypt($request->password)
        ]);
        $success['token'] = $row->createToken('MyApp')-> accessToken;
        return response()->json(['success'=>$success],200);
    }
    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            return response()->json(['success' => $success], 200);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
    public function forgetPassword(){

    }
    public function hello(){
        $name = Auth::id();
        return response()->json(['name'=>$name],200);
    }
    public function logoutApi()
    {
        if (Auth::check()) {
            Auth::user()->AauthAcessToken()->delete();
        }
    }
    public function reset(){
        PasswordReset::class;
    }
}