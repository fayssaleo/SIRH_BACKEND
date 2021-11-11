<?php

namespace App\Modules\DemandeDocAdmin\Http\Controllers;

use App\Enums\CategorieTypes;
use App\Enums\DOC_ADMIN_CATEGORIES;
use App\Enums\eResponseCode;
use App\Http\Controllers\Controller;
use App\Modules\Categorie\Models\Categorie;
use App\Modules\Collaborateur\Models\Collaborateur;
use App\Modules\DemandeDocAdmin\Models\DemandeDocAdmin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;
class DemandeDocAdminController extends Controller
{

    public function index (){
        return $this->resp->ok(eResponseCode::DDA_LISTED_200_00,DemandeDocAdmin::leftJoin('categories',"categories.id","=","demande_doc_admins.categorie_id")
            ->leftJoin('collaborateurs',"collaborateurs.id","=","demande_doc_admins.collaborateur_id")
            ->selectRaw("demande_doc_admins.*, categories.libelle as documentType,CONCAT(collaborateurs.nom ,' ', collaborateurs.prenom) as fullName")
            ->get());
    }
    public function create(Request $request){
        $validator=Validator::make($request->all(),[
            //"collaborateur_id" => "required",
            "categorie_id" => "required"
        ]);
        if ($validator->fails()) {
            //return response()->json($validator->errors(), 400);
            return $this->resp->not_acceptable(eResponseCode::DDA_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $categorie=Categorie::find($request->categorie_id);
        if(!$categorie){
            return $this->resp->not_found(eResponseCode::DDACAT_NOT_FOUND_404_01);
        }
        $collaborateur=Collaborateur::find(2);
        if(!$collaborateur){
            return $this->resp->not_found(eResponseCode::DDACOLL_NOT_FOUND_404_02);
        }
        $damndeDocAdmin =new DemandeDocAdmin;
        $damndeDocAdmin->dateDemande=Carbon::now();
        $damndeDocAdmin->collaborateur_id=$collaborateur->id;
        $damndeDocAdmin->autre=$request->autre;
        $damndeDocAdmin->msg=$request->msg;
        $categorie->demandeDocAdmins()->save($damndeDocAdmin);
        $damndeDocAdmin->documentType=$categorie->libelle;
        $damndeDocAdmin->fullName=$collaborateur->nom." ".$collaborateur->prenom;
        $damndeDocAdmin->statut="En attente";
        return $this->resp->ok(eResponseCode::DDA_STORED_200_02,$damndeDocAdmin);
    }
    public function accepter(Request $request){

        $validator=Validator::make($request->all(),[
            "id"=>"required",
        ]);
        if ($validator->fails()) {
            return $this->resp->not_acceptable(eResponseCode::DDA_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $damndeDocAdmin=DemandeDocAdmin::find($request->id);

        if(!$damndeDocAdmin){
            return $this->resp->not_found(eResponseCode::DDA_NOT_FOUND_404_00);
        }
        else {
            $damndeDocAdmin->statut="Validée";
            $damndeDocAdmin->dateValidation=Carbon::now();
            $damndeDocAdmin->save();
            $damndeDocAdmin->documentType=$damndeDocAdmin->categorie->libelle;
            $damndeDocAdmin->fullName=$damndeDocAdmin->collaborateur->nom." ".$damndeDocAdmin->collaborateur->prenom;
            return $this->resp->ok(eResponseCode::DDA_ACCEPTED_207_00,$damndeDocAdmin);
        }

    }
    public function refuser(Request $request){

        $validator=Validator::make($request->all(),[
            "id"=>"required",
            "feedback_msg" => "required|string|max:255",
        ]);
        if ($validator->fails()) {
            return $this->resp->not_acceptable(eResponseCode::DDA_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $damndeDocAdmin=DemandeDocAdmin::find($request->id);

        if(!$damndeDocAdmin){
            return $this->resp->not_found(eResponseCode::DDA_NOT_FOUND_404_00);
        }
        else {
            $damndeDocAdmin->statut="Refusée";
            $damndeDocAdmin->feedback_msg=$request->feedback_msg;
            $damndeDocAdmin->dateValidation=Carbon::now();
            $damndeDocAdmin->save();
            $damndeDocAdmin->documentType=$damndeDocAdmin->categorie->libelle;
            $damndeDocAdmin->fullName=$damndeDocAdmin->collaborateur->nom." ".$damndeDocAdmin->collaborateur->prenom;
            return $this->resp->ok(eResponseCode::DDA_REJECTED_208_00,$damndeDocAdmin);
        }

    }
    public function feedMSgEdit(Request $request){

        $validator=Validator::make($request->all(),[
            "id"=>"required",
            "feedback_msg" => "required|string|max:255",
        ]);
        if ($validator->fails()) {
            return $this->resp->not_acceptable(eResponseCode::DDA_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $damndeDocAdmin=DemandeDocAdmin::find($request->id);

        if(!$damndeDocAdmin){
            return $this->resp->not_found(eResponseCode::DDA_NOT_FOUND_404_00);
        }
        else {

            $damndeDocAdmin->feedback_msg=$request->feedback_msg;
            $damndeDocAdmin->save();
            return $this->resp->ok(eResponseCode::DDA_REJECTED_209_00,$damndeDocAdmin);
        }

    }
    public function demandeDocAdminsCategories(){
        return $this->resp->ok(eResponseCode::TCGCAT_LISTED_200_00,Categorie::where("type","=",CategorieTypes::DOC_ADMIN)->get());
    }
    public function downloadDocumentFile(Request $request){
        $validator=Validator::make($request->all(),[
            "id"=>"required",
            "categorie_id" => "required",
            "collaborateur_id" => "required",
        ]);
        if ($validator->fails()) {
            return $this->resp->not_acceptable(eResponseCode::DDA_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $categorie=Categorie::find($request->categorie_id);
        if(!$categorie){
            return $this->resp->not_found(eResponseCode::DDACAT_NOT_FOUND_404_01);
        }
        $collaborateur=Collaborateur::find($request->collaborateur_id);
        if(!$collaborateur){
            return $this->resp->not_found(eResponseCode::DDACOLL_NOT_FOUND_404_02);
        }
        $damndeDocAdmin=DemandeDocAdmin::find($request->id);

        if(!$damndeDocAdmin){
            return $this->resp->not_found(eResponseCode::DDA_NOT_FOUND_404_00);
        }
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0,
            'margin_header' => 0,
            'margin_footer' => 0,

        ]);
        $view="";
        switch ($categorie->libelle){
            case DOC_ADMIN_CATEGORIES::ATTESTATION_TRAVAIL:
                $view="Attestation_de_travail";break;
            case DOC_ADMIN_CATEGORIES::ATTESTATION_SALAIRE:
                $view="Attestation_de_salaire";break;
            case DOC_ADMIN_CATEGORIES::ATTESTATION_STAGE:
                $view="Attestation_de_stage";break;
            case DOC_ADMIN_CATEGORIES::CERTIFICAT_TRAVAIL:
                $view="Certificat_de_travail";break;
            default :
                $view="";
        }
        $data = [
            'collaborateur'  => $collaborateur,
            'post'   => $collaborateur->fonction->departement." - ".$collaborateur->fonction,
            'demande' => $damndeDocAdmin
        ];
        $html = View::make($view)->with("data",$data);

        $mpdf->writeHtml($html);
        $mpdf->defaultheaderline = 0;
        $mpdf->defaultfooterline = 0;
        $mpdf->SetFooter("<footer class='footer' style='font-weight: bold;width: 82%;font-size: 13px;margin: 0 auto;text-align: center;font-style: italic;    font-weight: 100;'>
        Devcorp / www.devcorp.ma / contact@devcorp.fr / Tel: 06.19.80.06.97 / RC n° 313069 / Patente n° 35875769 / CNSS n° 4217726 / IF n°15196694 / ICE : 001698672000075
        </footer>");
        $output = [
            "fileToDownload" => $mpdf->Output("attestation_de_travail.pdf", Destination::DOWNLOAD),
            "fileName"=>$categorie->libelle
        ];

        return $this->resp->ok(eResponseCode::DDA_FILE_DOWNLOADED_210_00,$output);
        //return response()->download($output);
    }
}
