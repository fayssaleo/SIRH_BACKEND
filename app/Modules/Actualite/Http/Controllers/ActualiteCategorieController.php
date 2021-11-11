<?php

namespace App\Modules\Actualite\Http\Controllers;

use App\Enums\eResponseCode;
use App\Http\Controllers\Controller;
use App\Modules\Actualite\Models\Actualite;
use App\Modules\Categorie\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActualiteCategorieController extends Controller
{
        public function index(){
        return $this->resp->ok(eResponseCode::ACAT_LISTED_200_00,Categorie::where("type","=",Actualite::class)->get());
        }
        public function create(Request $request){
        $validator=Validator::make($request->all(),[
            "libelle" => "required|string|max:40",
        ]);
        if ($validator->fails()) {
            return $this->resp->not_acceptable(eResponseCode::ACAT_NOT_ACCEPTED_406_00,$validator->errors());
        }

        $actualiteCategorie =new Categorie();
        $actualiteCategorie->libelle=$request->libelle;
        $actualiteCategorie->type=Actualite::class;
        $actualiteCategorie->createdBy="Fayssal";
        $actualiteCategorie->save();
        return $this->resp->ok(eResponseCode::ACAT_STORED_200_02,$actualiteCategorie);
    }
        public function update(Request $request){
        $validator=Validator::make($request->all(),[
            "id" => "required",
            "libelle" => "required|string|max:40",
        ]);
        if ($validator->fails()) {
            //return response()->json($validator->errors(), 400);
            return $this->resp->not_acceptable(eResponseCode::ACAT_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $actualiteCategorie=Categorie::find($request->id);

        if(!$actualiteCategorie){
            return $this->resp->not_found(eResponseCode::ACAT_NOT_FOUND_404_00);
        }
        else {
            $actualiteCategorie->libelle=$request->libelle;
            $actualiteCategorie->updatedBy = "Fayssal";
            $actualiteCategorie->save();
            return $this->resp->ok(eResponseCode::ACAT_UPDATED_200_03,$actualiteCategorie);
        }
    }
        public function get($id){
        $actualiteCategorie=Categorie::find($id);
        if(!$actualiteCategorie){
            return $this->resp->not_found(eResponseCode::ACAT_NOT_FOUND_404_00);
        }
        else {
            return $this->resp->ok(eResponseCode::ACAT_GET_200_01,$actualiteCategorie);

        }
    }
        public function destroy(Request $request){
        $actualiteCategorie=Categorie::find($request->id);
        if(!$actualiteCategorie){
            return $this->resp->not_found(eResponseCode::ACAT_NOT_FOUND_404_00);
        }
        else {
            $actualiteCategorie->delete();
            return $this->resp->ok(eResponseCode::ACAT_DELETED_200_04);
        }
    }
        public function getActualites($id){
            $actualiteCategorie=Categorie::find($id);
            if(!$actualiteCategorie){
                return $this->resp->not_found(eResponseCode::ACAT_NOT_FOUND_404_00);
            }
            return $this->resp->ok(eResponseCode::ACAT_ACT_LIST_200_05,$actualiteCategorie->actualites()->get());
        }

}
