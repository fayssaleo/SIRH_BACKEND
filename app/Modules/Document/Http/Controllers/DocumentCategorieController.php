<?php

namespace App\Modules\Document\Http\Controllers;

use App\Enums\eResponseCode;
use App\Http\Controllers\Controller;
use App\Modules\Categorie\Models\Categorie;
use App\Modules\Document\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DocumentCategorieController extends Controller
{
    public function index(){
        return $this->resp->ok(eResponseCode::DCAT_LISTED_200_00,Categorie::where("type","=",Document::class)->get());
    }
    public function create(Request $request){
        $validator=Validator::make($request->all(),[
            "libelle" => "required|string|max:40",
        ]);
        if ($validator->fails()) {
            return $this->resp->not_acceptable(eResponseCode::DCAT_NOT_ACCEPTED_406_00,$validator->errors());
        }

        $documentCategorie =new Categorie();
        $documentCategorie->libelle=$request->libelle;
        $documentCategorie->type=Document::class;
        $documentCategorie->createdBy="Fayssal";
        $documentCategorie->save();
        return $this->resp->ok(eResponseCode::DCAT_STORED_200_02,$documentCategorie);
    }
    public function update(Request $request){
        $validator=Validator::make($request->all(),[
            "id" => "required",
            "libelle" => "required|string|max:40",
        ]);
        if ($validator->fails()) {
            //return response()->json($validator->errors(), 400);
            return $this->resp->not_acceptable(eResponseCode::DCAT_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $documentCategorie=Categorie::find($request->id);

        if(!$documentCategorie){
            return $this->resp->not_found(eResponseCode::DCAT_NOT_FOUND_404_00);
        }
        else {
            $documentCategorie->libelle=$request->libelle;
            $documentCategorie->updatedBy = "Fayssal";
            $documentCategorie->save();
            return $this->resp->ok(eResponseCode::DCAT_UPDATED_200_03,$documentCategorie);
        }
    }
    public function get($id){
        $documentCategorie=Categorie::find($id);
        if(!$documentCategorie){
            return $this->resp->not_found(eResponseCode::DCAT_NOT_FOUND_404_00);
        }
        else {
            return $this->resp->ok(eResponseCode::DCAT_GET_200_01,$documentCategorie);

        }
    }
    public function destroy(Request $request){
        $documentCategorie=Categorie::find($request->id);
        if(!$documentCategorie){
            return $this->resp->not_found(eResponseCode::DCAT_NOT_FOUND_404_00);
        }
        else {
            $documentCategorie->delete();
            return $this->resp->ok(eResponseCode::DCAT_DELETED_200_04);
        }
    }
    public function getDocuments($id){
        $documentCategorie=Categorie::find($id);
        if(!$documentCategorie){
            return $this->resp->not_found(eResponseCode::DCAT_NOT_FOUND_404_00);
        }
        return $this->resp->ok(eResponseCode::DCAT_DOC_LIST_200_05,$documentCategorie->documents()->get());
    }
}
