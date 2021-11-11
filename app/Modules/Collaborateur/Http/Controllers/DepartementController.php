<?php

namespace App\Modules\Collaborateur\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Collaborateur\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Enums\eResponseCode;

class DepartementController extends Controller
{
    public function index(){

        return $this->resp->ok(eResponseCode::DEP_LISTED_200_00,Departement::all());
    }
    public function get($id){
        $departement=Departement::find($id);
        if(!$departement){
            //return response()->json("departement not found", 422);
            return $this->resp->not_found(eResponseCode::DEP_NOT_FOUND_404_00);
        }
        else {
            //return $departement;
            return $this->resp->ok(eResponseCode::DEP_GET_200_01,$departement);

        }
    }
    public function getFonctions($id){
        $departement=Departement::find($id);
        if(!$departement){
            return $this->resp->not_found(eResponseCode::DEP_NOT_FOUND_404_00);
        }
        else {
            return $this->resp->ok(eResponseCode::DEP_FONCTS_LIST_200_05,$departement->fonctions);
        }
    }
    public function create(Request $request){
        $validator=Validator::make($request->all(),[
            "libelle" => "required|string|max:40",
        ]);
        if ($validator->fails()) {
            //return response()->json($validator->errors(), 400);
            return $this->resp->not_acceptable(eResponseCode::DEP_NOT_ACCEPTED_406_00,$validator->errors());
        }

        $departement =new Departement;
        $departement->libelle=$request->libelle;
        $departement->createdBy="Fayssal";
        $departement->save();
        return $this->resp->ok(eResponseCode::DEP_STORED_200_02,$departement);
    }
    public function update(Request $request){
        $validator=Validator::make($request->all(),[
            "id" => "required",
            "libelle" => "string|max:40",
        ]);
        if ($validator->fails()) {
         //   return response()->json($validator->errors(), 422);
            return $this->resp->not_acceptable(eResponseCode::DEP_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $departement=Departement::find($request->id);

        if(!$departement){
            return $this->resp->not_found(eResponseCode::DEP_NOT_FOUND_404_00);
        }
        else {
            $departement->libelle = $request->libelle;
            $departement->updatedBy = "Fayssal";
            $departement->save();
            return $this->resp->ok(eResponseCode::DEP_UPDATED_200_03,$departement);
        }
    }
    public function destroy(Request $request){
        $departement=Departement::find($request->id);
        if(!$departement){
            return $this->resp->not_found(eResponseCode::DEP_NOT_FOUND_404_00);
        }
        else {
            $departement->delete();
            return $this->resp->ok(eResponseCode::DEP_DELETED_200_04);
        }
    }
}
