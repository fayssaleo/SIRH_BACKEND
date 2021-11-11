<?php

namespace App\Modules\Evenement\Http\Controllers;

use App\Enums\eResponseCode;
use App\Http\Controllers\Controller;
use App\Modules\Evenement\Models\Evenements_Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Evenements_CategorieController extends Controller
{
    public function index(){
        return $this->resp->ok(eResponseCode::ECAT_LISTED_200_00,Evenements_Categorie::all());
    }
    public function get($id){
        $eventCategorie=Evenements_Categorie::find($id);
        if(!$eventCategorie){
            //return response()->json("departement not found", 422);
            return $this->resp->not_found(eResponseCode::ECAT_NOT_FOUND_404_00);
        }
        else {
            //return $departement;
            return $this->resp->ok(eResponseCode::ECAT_GET_200_01,$eventCategorie);

        }
    }
    public function getEvenements($id){
        $eventCategorie=Evenements_Categorie::find($id);
        if(!$eventCategorie){
            return $this->resp->not_found(eResponseCode::ECAT_NOT_FOUND_404_00);
        }
        else {
            return $this->resp->ok(eResponseCode::ECAT_EVNT_LIST_200_05,$eventCategorie->evenements);
        }
    }
    public function create(Request $request){
        $validator=Validator::make($request->all(),[
            "nom" => "required|string|max:40",
            "couleur" => "required|string|max:40",
        ]);
        if ($validator->fails()) {
            //return response()->json($validator->errors(), 400);
            return $this->resp->not_acceptable(eResponseCode::ECAT_NOT_ACCEPTED_406_00,$validator->errors());
        }

        $eventCategorie =new Evenements_Categorie();
        $eventCategorie->nom=$request->nom;
        $eventCategorie->couleur=$request->couleur;
        $eventCategorie->createdBy="Fayssal";
        $eventCategorie->save();
        return $this->resp->ok(eResponseCode::ECAT_STORED_200_02,$eventCategorie);
    }
    public function update(Request $request){
        $validator=Validator::make($request->all(),[
            "id" => "required",
            "nom" => "required|string|max:40",
            "couleur" => "required|string|max:40",
        ]);
        if ($validator->fails()) {
            //return response()->json($validator->errors(), 400);
            return $this->resp->not_acceptable(eResponseCode::ECAT_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $eventCategorie=Evenements_Categorie::find($request->id);

        if(!$eventCategorie){
            return $this->resp->not_found(eResponseCode::ECAT_NOT_FOUND_404_00);
        }
        else {
            $eventCategorie->nom=$request->nom;
            $eventCategorie->couleur=$request->couleur;
            $eventCategorie->updatedBy = "Fayssal";
            $eventCategorie->save();
            return $this->resp->ok(eResponseCode::ECAT_UPDATED_200_03,$eventCategorie);
        }
    }
    public function destroy(Request $request){
        $eventCategorie=Evenements_Categorie::find($request->id);
        if(!$eventCategorie){
            return $this->resp->not_found(eResponseCode::ECAT_NOT_FOUND_404_00);
        }
        else {
            $eventCategorie->delete();
            return $this->resp->ok(eResponseCode::ECAT_DELETED_200_04);
        }
    }



}
