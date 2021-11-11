<?php

namespace App\Modules\Collaborateur\Http\Controllers;

use App\Enums\eResponseCode;
use App\Http\Controllers\Controller;
use App\Modules\Collaborateur\Models\Departement;
use App\Modules\Collaborateur\Models\Fonction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isEmpty;

class FonctionController extends Controller
{
    public function index(){
        return $this->resp->ok(eResponseCode::FONCT_LISTED_200_00,Fonction::all());
    }
    public function get($id){
        $fonction=Fonction::find($id);
        if(!$fonction){
            return $this->resp->not_found(eResponseCode::FONCT_NOT_FOUND_404_00);
        }
        else {
            return $this->resp->ok(eResponseCode::FONCT_GET_200_01,$fonction);

        }
    }
    public function create(Request $request){
        $validator=Validator::make($request->all(),[
            "libelle" => "required|string|max:40",
            "fichePoste" => "required|string",
            "departement_id" => "required"
        ]);
        if ($validator->fails()) {
            return $this->resp->not_acceptable(eResponseCode::FONCT_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $departement=Departement::find($request->departement_id);
        if(!$departement){
            return $this->resp->not_found(eResponseCode::DEP_NOT_FOUND_404_00);
        }

        $fonction = Fonction::make($request->all());
        $fonction->createdBy="fayssal";
        $departement->fonctions()->save($fonction);

        return $this->resp->ok(eResponseCode::FONCT_STORED_200_02,$fonction);
    }
    public function update(Request $request){
        $validator=Validator::make($request->all(),[
            "id" => "required",
            "libelle" => "string|max:40",

        ]);
        if ($validator->fails()) {
            return $this->resp->not_acceptable(eResponseCode::FONCT_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $fonction=Fonction::find($request->id);

        if(!$fonction){
            return $this->resp->not_found(eResponseCode::FONCT_NOT_FOUND_404_00);
        }
        else {
            $fonction->libelle = $request->libelle;
            $fonction->fichePoste = $request->fichePoste;
            $fonction->updatedBy = "Fayssal";
            $departement=Departement::find($request->departement_id);
            if(!$departement){
                return response()->json(eResponseCode::FONCT_NOT_FOUND_404_00, 422);
            }
            $fonction->departement_id = $request->departement_id;

            $fonction->save();
            return $this->resp->ok(eResponseCode::FONCT_UPDATED_200_03,$fonction);

        }
    }
    public function destroy(Request $request){
        $fonction=Fonction::find($request->id);
        if(!$fonction){
            return $this->resp->not_found(eResponseCode::FONCT_NOT_FOUND_404_00);
        }
        else if($fonction->collaborateurs->count()!=0){
            return $this->resp->not_acceptable(eResponseCode::FONCT_HAVE_COLL_406_01);
        }
        else {
            $fonction->delete();
            return $this->resp->ok(eResponseCode::FONCT_DELETED_200_04);
        }
    }
    public function showDepartement($id){
        $fonction=Fonction::find($id);
        if(!$fonction){
            return $this->resp->not_found(eResponseCode::FONCT_NOT_FOUND_404_00);
        }
        else {
            return $this->resp->ok(eResponseCode::FONCT_DEPS_LIST_200_05,$fonction->departement);
        }
    }
}
