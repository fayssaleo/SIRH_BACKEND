<?php

namespace App\Modules\Actualite\Http\Controllers;

use App\Enums\eResponseCode;
use App\Http\Controllers\Controller;
use App\Libs\UploadTrait;
use App\Modules\Actualite\Models\Actualite;
use App\Modules\Categorie\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActualiteController extends Controller
{
    use UploadTrait;
    public function index(){
        return $this->resp->ok(eResponseCode::ACT_LISTED_200_00,Actualite::select("actualites.*")->with("categories")->get());
    }
    public function create(Request $request){
        $validator=Validator::make($request->all(),[
            "titre" => "required|string|max:40",
            "contenu" => "required|string",
            "actualite_categorie_ids" => "required|array|min:1",
            "file" => "mimes:jpg,jpeg,png|max:2048"
        ]);
        if ($validator->fails()) {
            return $this->resp->not_acceptable(eResponseCode::ACT_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $actualite = Actualite::make($request->all());
        $actualite->createdBy="fayssal";
        if($request->file()) {
            $filename=time().'_'.$request->file('file')->getClientOriginalName();
            $this->uploadOne($request->file, config('cdn.actualite.path'),$filename);
            $actualite->image=$filename;
        }
        $actualite->save();

        foreach ($request->actualite_categorie_ids as $actualite_categorie_id){
            $actualiteCategorie=Categorie::find($actualite_categorie_id);
            if(!$actualiteCategorie){
                return $this->resp->not_found(eResponseCode::ACAT_NOT_FOUND_404_00);
            }
            $actualiteCategorie->actualites()->attach($actualite);
        }
        $actualite->categories=$actualite->categories()->get();
        return $this->resp->ok(eResponseCode::ACT_STORED_200_02,$actualite);

    }
    public function update(Request $request){
        $validator=Validator::make($request->all(),[
            "id" => "required",
            "titre" => "required|string|max:40",
            "contenu" => "required|string",
            "actualite_categorie_ids" => "required|array|min:1",
            "file" => "mimes:jpg,jpeg,png|max:2048"
        ]);
        if ($validator->fails()) {
            return $this->resp->not_acceptable(eResponseCode::ACT_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $actualite = Actualite::find($request->id);
        if(!$actualite){
            return $this->resp->not_found(eResponseCode::ACT_NOT_FOUND_404_00);
        }
        $actualite->titre=$request->titre;
        $actualite->contenu=$request->contenu;


        if($request->file()) {
            $filename=time().'_'.$request->file('file')->getClientOriginalName();
            $this->uploadOne($request->file, config('cdn.actualite.path'),$filename);
            $actualite->image=$filename;
        }else if($request->image==null){
            $filename=$actualite->image;
            $this->deleteOne(config('cdn.actualite.path'),$filename);
            $actualite->image=null;
        }
        $actualite->save();
        $actualite->categories()->detach();
        foreach ($request->actualite_categorie_ids as $actualite_categorie_id){
            $actualiteCategorie=Categorie::find($actualite_categorie_id);
            if(!$actualiteCategorie){
                return $this->resp->not_found(eResponseCode::ACAT_NOT_FOUND_404_00);
            }
            $actualiteCategorie->actualites()->attach($actualite);
        }
        $actualite->categories=$actualite->categories()->get();
        return $this->resp->ok(eResponseCode::ACT_UPDATED_200_03,$actualite);

    }
    public function getCategories($id){
        $actualite=Actualite::find($id);

        if(!$actualite){
            return $this->resp->not_found(eResponseCode::ACT_NOT_FOUND_404_00);
        }

        return $this->resp->ok(eResponseCode::ACT_CAT_LIST_200_05,$actualite->categories);
    }
    public function destroy(Request $request){
        $actualite=Actualite::find($request->id);
        if(!$actualite){
            return $this->resp->not_found(eResponseCode::ACT_NOT_FOUND_404_00);
        }
        else {
            $actualite->categories()->detach();
            $actualite->delete();
            return $this->resp->ok(eResponseCode::ACT_DELETED_200_04);
        }
    }
    public function disable(Request $request){
        $actualite=Actualite::find($request->id);
        if(!$actualite){
            return $this->resp->not_found(eResponseCode::ACT_NOT_FOUND_404_00);
        }
        else {
            $actualite->actif=0;
            $actualite->save();
            $actualite->categories=$actualite->categories()->get();
            return $this->resp->ok(eResponseCode::ACT_DISABLED_200_06,$actualite);
        }
    }
    public function enable(Request $request){
        $actualite=Actualite::find($request->id);
        if(!$actualite){
            return $this->resp->not_found(eResponseCode::EVNT_NOT_FOUND_404_00);
        }
        else {
            $actualite->actif=1;
            $actualite->save();
            $actualite->categories=$actualite->categories()->get();
            return $this->resp->ok(eResponseCode::ACT_ENABLED_200_07,$actualite);
        }
    }
    public function showCategorie(Request $request){
        $actualite=Categorie::find($request->id)->actualites;
        return $actualite;
    }
    public function sendActualiteImagesStoragePath(){
        return $this->resp->ok(eResponseCode::ECAT_FOLDER_LINK_407_00,asset("/storage/cdn/actualite/"));
    }
}