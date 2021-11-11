<?php

namespace App\Modules\DemandeConge\Http\Controllers;

use App\Enums\CategorieTypes;
use App\Enums\eResponseCode;
use App\Http\Controllers\Controller;
use App\Modules\Categorie\Models\Categorie;
use App\Modules\DemandeConge\Models\TypeConge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeCongeController extends Controller
{
    public function index(){
        return $this->resp->ok(eResponseCode::TCONG_LISTED_200_00,TypeConge::select('type_conges.*', 'categories.id as categorie_id','categories.libelle')
            ->leftJoin('categories',"categories.id","=","type_conges.categorie_id")
            ->get());
    }
    public function get($id){
        $typeConge=TypeConge::find($id);
        if(!$typeConge){
            //return response()->json("departement not found", 422);
            return $this->resp->not_found(eResponseCode::TCONG_NOT_FOUND_404_00);
        }
        else {
            //return $departement;
            return $this->resp->ok(eResponseCode::TCONG_GET_200_01,$typeConge);

        }
    }
    public function create(Request $request){
        $validator=Validator::make($request->all(),[
            "name" => "required|string",
            "nombreDeJours" => "required|integer",
            "categorie_id" => "required|integer"
        ]);
        if ($validator->fails()) {
            //return response()->json($validator->errors(), 400);
            return $this->resp->not_acceptable(eResponseCode::TCONG_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $categorie=Categorie::find($request->categorie_id);
        if(!$categorie){
            return $this->resp->not_found(eResponseCode::TCGCAT_NOT_FOUND_404_00);
        }
        $typeConge =new TypeConge;
        $typeConge->name=$request->name;
        $typeConge->nombreDeJours=$request->nombreDeJours;
        $typeConge->actif=1;
        $categorie->typeConges()->save($typeConge);
        return $this->resp->ok(eResponseCode::TCONG_STORED_200_02,$typeConge);
    }
    public function update(Request $request){
        $validator=Validator::make($request->all(),[
            "id" => "required",
            "name" => "required|string",
            "nombreDeJours" => "required|integer",
        ]);
        if ($validator->fails()) {
            //return response()->json($validator->errors(), 400);
            return $this->resp->not_acceptable(eResponseCode::TCONG_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $typeConge=TypeConge::find($request->id);

        if(!$typeConge){
            return $this->resp->not_found(eResponseCode::TCONG_NOT_FOUND_404_00);
        }
        else {
            $typeConge->name=$request->name;
            $typeConge->nombreDeJours=$request->nombreDeJours;
            $typeConge->save();
            return $this->resp->ok(eResponseCode::TCONG_UPDATED_200_03,$typeConge);
        }
    }
    public function disable(Request $request){
        $typeConge=TypeConge::find($request->id);
        if(!$typeConge){
            return $this->resp->not_found(eResponseCode::TCONG_NOT_FOUND_404_00);
        }
        else {
            $typeConge->actif=0;
            $typeConge->save();
            return $this->resp->ok(eResponseCode::TCONG_DISABLED_200_04);
        }
    }
    public function enable(Request $request){
        $typeConge=TypeConge::find($request->id);
        if(!$typeConge){
            return $this->resp->not_found(eResponseCode::TCONG_NOT_FOUND_404_00);
        }
        else {
            $typeConge->actif=1;
            $typeConge->save();
            return $this->resp->ok(eResponseCode::TCONG_ENABLED_200_04);
        }
    }
    public function addCongeCategorie(Request $request){
        $validator=Validator::make($request->all(),[
            "libelle" => "required|string",
        ]);
        if ($validator->fails()) {
            //return response()->json($validator->errors(), 400);
            return $this->resp->not_acceptable(eResponseCode::TCGCAT_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $categorie = new Categorie();
        $categorie->libelle=$request->libelle;
        $categorie->actif=true;
        $categorie->createdBy="Fayssal ourezzouq";
        $categorie->type=CategorieTypes::CONGE;
        $categorie->save();
        return $this->resp->ok(eResponseCode::TCGCAT_STORED_200_02,$categorie);
    }
    public function updateCongeTypeCategorie(Request $request){
        $validator=Validator::make($request->all(),[
            "id" => "required",
            "libelle" => "required|string",
        ]);
        if ($validator->fails()) {
            //return response()->json($validator->errors(), 400);
            return $this->resp->not_acceptable(eResponseCode::TCGCAT_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $categorie=Categorie::find($request->id);
        if(!$categorie){
            return $this->resp->not_found(eResponseCode::TCGCAT_NOT_FOUND_404_00);
        }

        $categorie = new Categorie();
        $categorie->libelle=$request->libelle;
        $categorie->actif=true;
        $categorie->updatedBy="Fayssal ourezzouq";
        $categorie->type=CategorieTypes::CONGE;
        $categorie->save();
        return $this->resp->ok(eResponseCode::TCGCAT_UPDATED_200_03,$categorie);
    }
    public function listCongeCategorie(){
        return $this->resp->ok(eResponseCode::TCGCAT_LISTED_200_00,Categorie::where('type',CategorieTypes::CONGE)->get());
    }
    public function disableCongeCategorie(Request $request){
        $categorie=Categorie::find($request->id);
        if(!$categorie){
            return $this->resp->not_found(eResponseCode::TCGCAT_NOT_FOUND_404_00);
        }
        else {
            $categorie->actif=0;
            $categorie->save();
            return $this->resp->ok(eResponseCode::TCGCAT_DISABLED_200_05);
        }
    }
    public function enableCongeCategorie(Request $request){
        $categorie=Categorie::find($request->id);
        if(!$categorie){
            return $this->resp->not_found(eResponseCode::TCGCAT_NOT_FOUND_404_00);
        }
        else {
            $categorie->actif=1;
            $categorie->save();
            return $this->resp->ok(eResponseCode::TCGCAT_ENABLED_200_06);
        }
    }
    public function getCongeType($id){
        $categorie=Categorie::find($id);
        if(!$categorie){
            //return response()->json("departement not found", 422);
            return $this->resp->not_found(eResponseCode::TCGCAT_NOT_FOUND_404_00);
        }
        else {
            //return $departement;
            return $this->resp->ok(eResponseCode::TCGCAT_GET_200_01,$categorie);

        }
    }
    public function getCongeTypesByCategorie(Request $request){
        $categorie=Categorie::find($request->id);
        if(!$categorie){
            //return response()->json("departement not found", 422);
            return $this->resp->not_found(eResponseCode::TCGCAT_NOT_FOUND_404_00);
        }
        else {
            //return $departement;
            return $this->resp->ok(eResponseCode::TCGCAT_TYPES_LISTED_200_07,$categorie->typeConges);

        }
    }

}
