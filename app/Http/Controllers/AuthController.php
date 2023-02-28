<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function Register(Request $request)
    {

       $data = $request->validate([
            'name'=> 'required',
            'last_name'=> 'required',
            'email'=>'required|email',
            'user_types'=>'required',
            'country'=>'required',
            'password'=>[
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\~\`\!\@\#\$\%\^\&\*\(\)\-\_\+\=\{\}\[\]\|\\\;\:\"\<\>\,\.\?]).+$/'
            ]
        ]);
       $data["password"] = \Hash::make($data["password"]);
       $user = User::create($data);
       $user->createToken('auth_token')->plainTextToken;
       return responder()->success($user)->respond();
    }

    public function login(Request $request){

        $credentials = $request->validate([
            'email'=> ['required', 'email'],
            'password' => 'required',
            'remember' => 'boolean'
        ]);
        $remember = $credentials['remember'] ?? false;
        unset($credentials['remember']);

        if (!Auth::attempt($credentials, $remember)) {
            return response([
                'message' => 'Email or password is incorrect'
            ], 422);
        }

        $user = Auth::user();

        $token = $user->createToken('auth_token')->plainTextToken;
        return response([
            'user' => new UserResource($user),
            'token' => $token
        ]);
    }
    public function logout()
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        return response('', 204);
    }

    public function getUser(Request $request)
    {
        return new UserResource($request->user());
    }

}
