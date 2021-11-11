<?php

namespace App\Modules\Utilisateur\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Modules\Utilisateur\Models\Utilisateur;
use App\Enums\eResponseCode;
use Illuminate\Support\Facades\Validator;


class UtilisateurController extends Controller
{
    public function register(Request $request){
        $validator=Validator::make($request->all(),[
            "username" => "required|email|unique:utilisateurs,username",
            "password" => "required|string|confirmed"
        ]);
        if ($validator->fails()) {
            return $this->resp->not_acceptable(eResponseCode::USER_LOGGED_INFOS_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $utilisateur=Utilisateur::create([
            "username" => $request->username,
            "password" => bcrypt($request->password),
        ]);
        $token = $utilisateur->createToken("myapptoken")->plainTextToken;
        $response = [
            "utilisateur" => $utilisateur,
            "token" => $token
        ];
        return $this->resp->ok(eResponseCode::USER_LOGGED_REGISTERED_200_05,$response);
    }
    public function login(Request $request) {
        $validator=Validator::make($request->all(),[
            "username" => "required|email",
            'password' => 'required|string'
        ]);
        if ($validator->fails()) {
            return $this->resp->not_acceptable(eResponseCode::USER_LOGGED_INFOS_NOT_ACCEPTED_406_00,$validator->errors());
        }
        // Check email
        $utilisateur = Utilisateur::where('username', $request->username)->first();
        // Check password
        if(!$utilisateur || !Hash::check($request->password, $utilisateur->password)) {
            return $this->resp->not_found(eResponseCode::USER_LOGGED_401_01);
        }
        $token = $utilisateur->createToken('test3')->plainTextToken;
        $collaborateur=$utilisateur->collaborateur;
        $response = [
            'utilisateur' => $utilisateur,
            'collaborateur' => $collaborateur,
            'token' => $token
        ];

        return $this->resp->ok(eResponseCode::USER_LOGGED_IN_200_02,$response);

    }
    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return $this->resp->ok(eResponseCode::USER_LOGGED_OUT_200_03);
    }
    public function test(Request $request){
        dd($request->user()->tokenCan("test3"));
        return "tessttttt";
    }
    public function loginMobileAPI(Request $request){
        $validator=Validator::make($request->all(),[
            "username" => "required|email",
            'password' => 'required|string'
        ]);
        if ($validator->fails()) {
            return $this->resp->not_acceptable(eResponseCode::USER_LOGGED_INFOS_NOT_ACCEPTED_406_00,$validator->errors());
        }
        // Check email
        $utilisateur = Utilisateur::where('username', $request->username)->first();
        // Check password
        if(!$utilisateur || !Hash::check($request->password, $utilisateur->password)) {
            return $this->resp->not_found(eResponseCode::USER_LOGGED_401_01);
        }
        $token = $utilisateur->createToken('myapptoken')->plainTextToken;
        $collaborateur=$utilisateur->collaborateur;
        $response = [
            'utilisateur' => $utilisateur,
            'TypeConges' => $collaborateur,
            'token' => $token
        ];

        return $this->resp->ok(eResponseCode::USER_LOGGED_IN_200_02,$response);
    }
}
