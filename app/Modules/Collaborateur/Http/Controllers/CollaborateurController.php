<?php

namespace App\Modules\Collaborateur\Http\Controllers;

use App\Enums\eResponseCode;
use App\Http\Controllers\Controller;
use App\Libs\UploadTrait;
use App\Modules\Collaborateur\Models\Collaborateur;
use App\Modules\Collaborateur\Models\Fonction;
use App\Modules\Utilisateur\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CollaborateurController extends Controller
{
    use UploadTrait;
    public function index(){
        return $this->resp->ok(eResponseCode::COLL_LISTED_200_00,Collaborateur::select('collaborateurs.*', 'fonctions.libelle as fonction','fonctions.departement_id')
            ->leftJoin('fonctions',"fonctions.id","=","collaborateurs.fonction_id")
            ->leftJoin('departements',"departements.id","=","fonctions.departement_id")
            ->get());
    }
    public function get($id){
        
        $collaborateur=Collaborateur::find($id);
        if(!$collaborateur){
            return $this->resp->not_found(eResponseCode::COLL_NOT_FOUND_404_00);

        }
        else {
            return $this->resp->ok(eResponseCode::COLL_GET_200_01,$collaborateur);
        }
    }
    public function create(Request $request){

        //$requestedCollaborateur=json_decode($request->json);
        //dd($requestedCollaborateur->all());
        //dd($request);
        $validator=Validator::make($request->all(),[
            "nom" => "required|string|max:20",
            "prenom" => "required|string|max:20",
            "sexe" => "required|string",
            "birthday" => "required|date",
            "lieuDeNaissance" => "required|string|max:50",
            "nationalite" => "required|string|max:50",
            "email" => "required|string|email|max:50",
            "telephone" => "required|string|max:50",
            "telephoneUrgent" => "required|string|max:50",
            "adresse" => "required|string|max:255",
            "enfants" => "integer",
            "typeContrat" => "required|string|max:50",
            "situationMatrimoniale" => "required|string|max:50",
            "salaire" => "required",
            "cnss" => "required|string|max:100",
            "rib" => "required|string",
            "soldeConge" => "integer",
            "cin" => "required|string|max:50",
            "dateEmbauche" => "required|date",
            "actif" => "required",
            'file' => 'mimes:jpg,jpeg,png|max:2048'
        ]);
        if ($validator->fails()) {
            return $this->resp->not_acceptable(eResponseCode::COLL_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $collaborateur = Collaborateur::make($request->except(['birthday','anciennete','dateEmbauche']));
        $collaborateur->birthday=$request->birthday;
        $collaborateur->dateEmbauche=$request->dateEmbauche;
        $fonction=Fonction::find($request->fonction_id);
        if(!$fonction){
            return $this->resp->not_found(eResponseCode::FONCT_NOT_FOUND_404_00);
        }

        if($request->file()) {
            $filename=time().'_'.$request->file('file')->getClientOriginalName();
            $this->uploadOne($request->file, config('cdn.collaborateur.path'),$filename);
            $collaborateur->photo=$filename;
        }
        $collaborateur->save();
        $collaborateur->fonction=$fonction->libelle;
        $collaborateur->departement_id=$fonction->departement_id;
        return $this->resp->ok(eResponseCode::COLL_STORED_200_02,$collaborateur);
    }
    public function destroy(Request $request){
        $collaborateur=Collaborateur::find($request->id);
        if($collaborateur==null){
            return $this->resp->not_found(eResponseCode::COLL_NOT_FOUND_404_00);
        }
        else {
            if($collaborateur->evenements!=null){
                $collaborateur->evenements()->detach();
            }
            $collaborateur->delete();
            return $this->resp->ok(eResponseCode::COLL_DELETED_200_04);
        }
    }
    public function update(Request $request){
        $validator=Validator::make($request->all(),[
            "id" => "required",
            "nom" => "required|string|max:20",
            "prenom" => "required|string|max:20",
            "sexe" => "required|string",
            "birthday" => "required|date",
            "lieuDeNaissance" => "required|string|max:50",
            "nationalite" => "required|string|max:50",
            "email" => "required|string|email|max:50",
            "telephone" => "required|string|max:50",
            "telephoneUrgent" => "required|string|max:50",
            "adresse" => "required|string|max:255",
            "enfants" => "integer",
            "typeContrat" => "required|string|max:50",
            "situationMatrimoniale" => "required|string|max:50",
            "salaire" => "required",
            "cnss" => "required|string|max:100",
            "rib" => "required|string",
            "soldeConge" => "integer",
            "cin" => "required|string|max:50",
            "dateEmbauche" => "required|date",
            "actif" => "required"
        ]);
        if ($validator->fails()) {
            return $this->resp->not_acceptable(eResponseCode::COLL_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $collaborateur=Collaborateur::find($request->id);

        if(!$collaborateur){
            return $this->resp->not_found(eResponseCode::COLL_NOT_FOUND_404_00);
        }
        else {
            if($request->file()) {
                $filename=time().'_'.$request->file('file')->getClientOriginalName();
                $this->uploadOne($request->file, config('cdn.collaborateur.path'),$filename);
                $collaborateur->photo=$filename;
            }
          $collaborateur->nom=$request->nom;
          $collaborateur->prenom=$request->prenom;
          $collaborateur->sexe=$request->sexe;
          $collaborateur->birthday=$request->birthday;
          $collaborateur->lieuDeNaissance=$request->lieuDeNaissance;
          $collaborateur->nationalite=$request->nationalite;
          $collaborateur->email=$request->email;
          $collaborateur->telephone=$request->telephone;
          $collaborateur->telephoneUrgent=$request->telephoneUrgent;
          $collaborateur->adresse=$request->adresse;
          $collaborateur->enfants=$request->enfants;
          $collaborateur->typeContrat=$request->typeContrat;
          $collaborateur->situationMatrimoniale=$request->situationMatrimoniale;
          $collaborateur->salaire=$request->salaire;
          $collaborateur->cnss=$request->cnss;
          $collaborateur->rib=$request->rib;
          $collaborateur->soldeConge=$request->soldeConge;
          $collaborateur->cin=$request->cin;
          $collaborateur->dateEmbauche=$request->dateEmbauche;
          $collaborateur->actif=$request->actif;
          $collaborateur->fonction_id=$request->fonction_id;
          $fonction=Fonction::find($request->fonction_id);

            if(!$fonction){
                return $this->resp->not_found(eResponseCode::FONCT_NOT_FOUND_404_00);
            }
          $collaborateur->save();
          $collaborateur->fonction=$fonction->libelle;
          $collaborateur->departement_id=$fonction->departement_id;
        }
        return $this->resp->ok(eResponseCode::COLL_UPDATED_200_03,$collaborateur);
    }
    public function disable(Request $request){
        $collaborateur=Collaborateur::find($request->id);
        if(!$collaborateur){
            return $this->resp->not_found(eResponseCode::COLL_NOT_FOUND_404_00);
        }
        else {
            $collaborateur->actif=0;
            $collaborateur->save();
            return $this->resp->ok(eResponseCode::COLL_DISABLED_200_05,$collaborateur);
        }
    }
    public function enable(Request $request){
        $collaborateur=Collaborateur::find($request->id);
        if(!$collaborateur){
            return $this->resp->not_found(eResponseCode::COLL_NOT_FOUND_404_00);
        }
        else {
            $collaborateur->actif=1;
            $collaborateur->save();
            return $this->resp->ok(eResponseCode::COLL_ENABLED_200_06,$collaborateur);
        }
    }
    public function collCreateUser(Request $request){
        $validator=Validator::make($request->all(),[
            "collaborateur_id" => "required",
            "password" => "required|string|confirmed"

        ]);
        if ($validator->fails()) {
            return $this->resp->not_acceptable(eResponseCode::USER_LOGGED_INFOS_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $collaborateur=Collaborateur::find($request->collaborateur_id);

        if(!$collaborateur){
            return $this->resp->not_found(eResponseCode::COLL_NOT_FOUND_404_00);
        }

        $utilisateur=Utilisateur::make([
            "username" => $collaborateur->email,
            "password" => bcrypt($request->password),
        ]);
        $collaborateur->utilisateur()->save($utilisateur);
        $token = $utilisateur->createToken("myapptoken")->plainTextToken;
        $collaborateur=$utilisateur->collaborateur;
        $response = [
            "utilisateur" => $utilisateur,
            "collaborateur" => $collaborateur,
            "token" => $token
        ];

        return $this->resp->ok(eResponseCode::USER_LOGGED_REGISTERED_200_05,$response);
    }
    public function sendPhotosStoragePath(){
        return $this->resp->ok(eResponseCode::COLL_FOLDER_LINK_407_00,asset("/storage/cdn/collaborateur/"));
    }
}
