<?php

namespace App\Modules\DemandeConge\Http\Controllers;

use App\Enums\eResponseCode;
use App\Http\Controllers\Controller;
use App\Modules\Collaborateur\Models\Collaborateur;
use App\Modules\DemandeConge\Models\DemandeConge;
use App\Modules\DemandeConge\Models\TypeConge;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DemandeCongeController extends Controller
{
    public function index(){
        return $this->resp->ok(eResponseCode::DCONG_LISTED_200_00,DemandeConge::select('demande_conges.*', 'type_conges.name as type','collaborateurs.nom as nom','collaborateurs.prenom as prenom')
            ->leftJoin('type_conges',"type_conges.id","=","demande_conges.type_conge_id")
            ->leftJoin('collaborateurs',"collaborateurs.id","=","demande_conges.collaborateur_id")
            ->get());
    }
    public function get($id){
        $demandeConge=DemandeConge::find($id);
        if(!$demandeConge){
            return $this->resp->not_found(eResponseCode::DCONG_NOT_FOUND_404_00);
        }
        else {
            return $this->resp->ok(eResponseCode::DCONG_GET_200_01,$demandeConge);

        }
    }
    public function create(Request $request){
        $validator=Validator::make($request->all(),[
            "dateDebut" => "required|date",
            "dateFin" => "required|date",
            "motif" => "required|string|max:20",
            "traiteePar" => "required|string|max:40",
            "type_conge_id" => "required",
        ]);
        if ($validator->fails()) {
            //return response()->json($validator->errors(), 400);
            return $this->resp->not_acceptable(eResponseCode::DCONG_NOT_ACCEPTED_406_00,$validator->errors());
        }

        $demandeConge =new DemandeConge;
        $demandeConge->dateDemande=$request->dateDemande;
        $demandeConge->dateValidation=$request->dateValidation;
        $demandeConge->dateDebut=$request->dateDebut;
        $demandeConge->dateFin=$request->dateFin;
        $demandeConge->statut="En attente";
        $demandeConge->motif=$request->motif;
        $demandeConge->feedback_msg=$request->feedback_msg;
        $demandeConge->traiteePar=$request->traiteePar;
        $demandeConge->demiJourAuDebut=$request->demiJourAuDebut;
        $demandeConge->demiJourAuFin=$request->demiJourAuFin;
        $typeConge=TypeConge::find($request->type_conge_id);

        if(!$typeConge){
            return $this->resp->not_found(eResponseCode::TCONG_NOT_FOUND_404_00);
        }
        $collaborateur=Collaborateur::find($request->collaborateur_id);

        if(!$collaborateur){
            return $this->resp->not_found(eResponseCode::COLL_NOT_FOUND_404_00);
        }
        $demandeConge->collaborateur_id=$collaborateur->id;
        $demandeConge->dateDemande=Carbon::now();
        $typeConge->demandeConges()->save($demandeConge);
        $demandeConge->type=$typeConge->name;
        $demandeConge->nom=$collaborateur->nom;
        $demandeConge->prenom=$collaborateur->prenom;
        return $this->resp->ok(eResponseCode::DCONG_STORED_200_02,$demandeConge);
    }
    public function update(Request $request){
        $validator=Validator::make($request->all(),[
            "id"=>"required",
            "dateDebut" => "required|date",
            "dateFin" => "required|date",
            "statut" => "required|string|max:20",
            "motif" => "required|string|max:20",
            "traiteePar" => "required|string|max:40",
            "type_conge_id" => "required",
        ]);
        if ($validator->fails()) {
            return $this->resp->not_acceptable(eResponseCode::DCONG_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $demandeConge=DemandeConge::find($request->id);

        if(!$demandeConge){
            return $this->resp->not_found(eResponseCode::DCONG_NOT_FOUND_404_00);
        }
        else {
            $demandeConge->dateDemande=$request->dateDemande;
            $demandeConge->dateValidation=$request->dateValidation;
            $demandeConge->dateDebut=$request->dateDebut;
            $demandeConge->dateFin=$request->dateFin;
            $demandeConge->statut=$request->statut;
            $demandeConge->motif=$request->motif;
            $demandeConge->feedback_msg=$request->feedback_msg;
            $demandeConge->traiteePar=$request->traiteePar;
            $typeConge=TypeConge::find($request->type_conge_id);

            if(!$typeConge){
                return $this->resp->not_found(eResponseCode::TCONG_NOT_FOUND_404_00);
            }else{
                $demandeConge->type_conge_id=$request->type_conge_id;
            }
            $demandeConge->save();
            return $this->resp->ok(eResponseCode::DCONG_UPDATED_200_03,$demandeConge);
        }
    }
    public function destroy(Request $request){
        $demandeConge=DemandeConge::find($request->id);
        if(!$demandeConge){
            return $this->resp->not_found(eResponseCode::DCONG_NOT_FOUND_404_00);
        }
        else {
            $demandeConge->delete();
            return $this->resp->ok(eResponseCode::DCONG_DELETED_200_04);
        }
    }
    public function accepter(Request $request){

        $validator=Validator::make($request->all(),[
            "id"=>"required",
        ]);
        if ($validator->fails()) {
            return $this->resp->not_acceptable(eResponseCode::DCONG_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $demandeConge=DemandeConge::find($request->id);

        if(!$demandeConge){
            return $this->resp->not_found(eResponseCode::DCONG_NOT_FOUND_404_00);
        }
        else {
            $demandeConge->statut="valide";
            $demandeConge->save();
            $demandeConge->type=$demandeConge->typeConge->name;
            $demandeConge->nom=$demandeConge->collaborateur->nom;
            $demandeConge->prenom=$demandeConge->collaborateur->prenom;
            return $this->resp->ok(eResponseCode::DCONG_ACCEPTED_207_00,$demandeConge);
        }

    }
    public function refuser(Request $request){

        $validator=Validator::make($request->all(),[
            "id"=>"required",
            "feedback_msg" => "required|string|max:255",
        ]);
        if ($validator->fails()) {
            return $this->resp->not_acceptable(eResponseCode::DCONG_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $demandeConge=DemandeConge::find($request->id);

        if(!$demandeConge){
            return $this->resp->not_found(eResponseCode::DCONG_NOT_FOUND_404_00);
        }
        else {
            $demandeConge->statut="refuse";
            $demandeConge->feedback_msg=$request->feedback_msg;
            $demandeConge->save();
            $demandeConge->type=$demandeConge->typeConge->name;
            $demandeConge->nom=$demandeConge->collaborateur->nom;
            $demandeConge->prenom=$demandeConge->collaborateur->prenom;
            return $this->resp->ok(eResponseCode::DCONG_REJECTED_208_00,$demandeConge);
        }

    }
    public function feedMSgEdit(Request $request){

        $validator=Validator::make($request->all(),[
            "id"=>"required",
            "feedback_msg" => "required|string|max:255",
        ]);
        if ($validator->fails()) {
            return $this->resp->not_acceptable(eResponseCode::DCONG_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $demandeConge=DemandeConge::find($request->id);

        if(!$demandeConge){
            return $this->resp->not_found(eResponseCode::DCONG_NOT_FOUND_404_00);
        }
        else {

            $demandeConge->feedback_msg=$request->feedback_msg;
            $demandeConge->save();
            $demandeConge->type=$demandeConge->typeConge->name;
            $demandeConge->nom=$demandeConge->collaborateur->nom;
            $demandeConge->prenom=$demandeConge->collaborateur->prenom;
            return $this->resp->ok(eResponseCode::DCONG_REJECTED_209_00,$demandeConge);
        }

    }
}
