<?php

namespace App\Modules\Evenement\Http\Controllers;

use App\Enums\eResponseCode;
use App\Http\Controllers\Controller;
use App\Libs\UploadTrait;
use App\Modules\Collaborateur\Models\Collaborateur;
use App\Modules\Evenement\Models\Evenement;
use App\Modules\Evenement\Models\Evenements_Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EvenementController extends Controller
{
    use UploadTrait;
    public function index(){
        $evenements=Evenement::select('evenements.*', 'evenements_categories.nom as categorie_name','evenements_categories.couleur')
            ->leftJoin('evenements_categories',"evenements_categories.id","=","evenements.evenements_categorie_id")
            ->with('invites')
            ->get();
        return $this->resp->ok(eResponseCode::EVNT_LISTED_200_00,$evenements);
    }
    public function get($id){
        $evenement=Evenement::find($id);
        if(!$evenement){
            return $this->resp->not_found(eResponseCode::EVNT_GET_200_01);
        }
        else {
            $eventCategorie=Evenements_Categorie::find($evenement->evenements_categorie_id);
            $evenement->couleur=$eventCategorie->couleur;
            $evenement->categorie_name=$eventCategorie->nom;
            return $this->resp->ok(eResponseCode::EVNT_GET_200_01,$evenement);

        }
    }
    public function create(Request $request){
        $validator=Validator::make($request->all(),[
            "titre" => "required|string|max:40",
            "text" => "required|string",
            "date" => "required",
            "time" => "required",
            "lieu" => "required",
            "evenements_categorie_id" => "required",
            "file" => "mimes:jpg,jpeg,png|max:2048"
        ]);
        if ($validator->fails()) {
            return $this->resp->not_acceptable(eResponseCode::EVNT_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $eventCategorie=Evenements_Categorie::find($request->evenements_categorie_id);
        if(!$eventCategorie){
            return $this->resp->not_found(eResponseCode::ECAT_NOT_FOUND_404_00);
        }
        $evenement = Evenement::make($request->all());
        $evenement->createdBy="fayssal";
        if($request->file()) {
            $filename=time().'_'.$request->file('file')->getClientOriginalName();
            $this->uploadOne($request->file, config('cdn.evenement.path'),$filename);
            $evenement->image=$filename;
        }
        $eventCategorie->evenements()->save($evenement);
        if($request->invites!=null){
            foreach ($request->invites as $collaborateurId){
                $collaborateur=Collaborateur::find($collaborateurId);
                if(!$collaborateur){
                    return $this->resp->not_found(eResponseCode::COLL_NOT_FOUND_404_00);
                }
                $evenement->invites()->attach($collaborateur);
            }
        }else{
            $collaborateurs=Collaborateur::all();
            foreach ($collaborateurs as $collaborateur){
                $evenement->invites()->attach($collaborateur);
            }
        }
        $evenement->couleur=$eventCategorie->couleur;
        $evenement->categorie_name=$eventCategorie->nom;
        $evenement->actif=1;
        $evenement->invites=$evenement->invites;
        return $this->resp->ok(eResponseCode::EVNT_STORED_200_02,$evenement);
    }
    public function update(Request $request){
        $validator=Validator::make($request->all(),[
            "id" => "required",
            "titre" => "required|string|max:40",
            "text" => "required|string",
            "date" => "required",
            "time" => "required",
            "lieu" => "required",
            "evenements_categorie_id" => "required",
            "file" => "mimes:jpg,jpeg,png|max:2048"
        ]);
        $eventCategorie=Evenements_Categorie::find($request->evenements_categorie_id);
        if(!$eventCategorie){
            return $this->resp->not_found(eResponseCode::ECAT_NOT_FOUND_404_00);
        }
        if ($validator->fails()) {
            return $this->resp->not_acceptable(eResponseCode::EVNT_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $evenement=Evenement::find($request->id);

        if(!$evenement){
            return $this->resp->not_found(eResponseCode::EVNT_NOT_FOUND_404_00);
        }
        else {
            if($request->file()) {
                $filename=time().'_'.$request->file('file')->getClientOriginalName();
                $this->uploadOne($request->file, config('cdn.evenement.path'),$filename);
                $evenement->image=$filename;
            }
            else if($request->image==null){
                $filename=$evenement->image;
                $this->deleteOne(config('cdn.evenement.path'),$filename);
                $evenement->image=null;
            }
            $evenement->titre = $request->titre;
            $evenement->text = $request->text;
            $evenement->date = $request->date;
            $evenement->time = $request->time;
            $evenement->lieu = $request->lieu;
            $evenement->evenements_categorie_id = $request->evenements_categorie_id;
            $evenement->updateddBy = "Fayssal";
            $eventCategorie=Evenements_Categorie::find($request->evenements_categorie_id);
            if(!$eventCategorie){
                return response()->json(eResponseCode::ECAT_NOT_FOUND_404_00, 422);
            }
            $evenement->evenements_categorie_id = $request->evenements_categorie_id;

            $evenement->save();

            if($request->invites!=null){
                $evenement->invites()->detach();
                foreach ($request->invites as $collaborateurId){
                    $collaborateur=Collaborateur::find($collaborateurId);
                    if(!$collaborateur){
                        return $this->resp->not_found(eResponseCode::COLL_NOT_FOUND_404_00);

                    }
                    $evenement->invites()->attach($collaborateur);
                }
            }
            $evenement->couleur=$eventCategorie->couleur;
            $evenement->categorie_name=$eventCategorie->nom;
            $evenement->invites=$evenement->invites;
            return $this->resp->ok(eResponseCode::EVNT_UPDATED_200_03,$evenement);

        }
    }
    public function destroy(Request $request){
        $evenement=Evenement::find($request->id);
        if(!$evenement){
            return $this->resp->not_found(eResponseCode::EVNT_NOT_FOUND_404_00);
        }
        else {
            $evenement->invites()->detach();
            $evenement->delete();
            return $this->resp->ok(eResponseCode::EVNT_DELETED_200_04);
        }
    }
    public function disable(Request $request){
        $evenement=Evenement::find($request->id);
        if(!$evenement){
            return $this->resp->not_found(eResponseCode::EVNT_NOT_FOUND_404_00);
        }
        else {
            $evenement->actif=0;
            $evenement->save();
            $eventCategorie=Evenements_Categorie::find($evenement->evenements_categorie_id);
            $evenement->couleur=$eventCategorie->couleur;
            $evenement->categorie_name=$eventCategorie->nom;
            return $this->resp->ok(eResponseCode::EVNT_DISABLED_200_06,$evenement);
        }
    }
    public function enable(Request $request){
        $evenement=Evenement::find($request->id);
        if(!$evenement){
            return $this->resp->not_found(eResponseCode::EVNT_NOT_FOUND_404_00);
        }
        else {
            $evenement->actif=1;
            $evenement->save();
            $eventCategorie=Evenements_Categorie::find($evenement->evenements_categorie_id);
            $evenement->couleur=$eventCategorie->couleur;
            $evenement->categorie_name=$eventCategorie->nom;
            return $this->resp->ok(eResponseCode::EVNT_ENABLED_200_07,$evenement);
        }
    }
    public function sendEvenementImagesStoragePath(){
        return $this->resp->ok(eResponseCode::ECAT_FOLDER_LINK_407_00,asset("/storage/cdn/evenement/"));
    }
}
