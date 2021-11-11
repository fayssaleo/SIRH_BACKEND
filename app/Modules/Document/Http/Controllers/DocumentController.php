<?php

namespace App\Modules\Document\Http\Controllers;

use App\Enums\eResponseCode;
use App\Http\Controllers\Controller;
use App\Libs\UploadTrait;
use App\Modules\Categorie\Models\Categorie;
use App\Modules\Document\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
{
    use UploadTrait;
    public function index(){
        return $this->resp->ok(eResponseCode::DOC_LISTED_200_00,Document::select("documents.*")->with("categories")->get());
    }
    public function create(Request $request){
        $validator=Validator::make($request->all(),[
            "libelle" => "required|string|max:50",
            "file" => "mimes:pdf"
        ]);
        if ($validator->fails()) {
            return $this->resp->not_acceptable(eResponseCode::DOC_NOT_ACCEPTED_406_00,$validator->errors());
        }
        $document = Document::make($request->all());
        $document->libelle=$request->libelle;
        $document->createdBy="fayssal";
        $filename=time().'_'.$request->file('file')->getClientOriginalName();
        $this->uploadOne($request->file, config('cdn.document.path'),$filename);
        $document->filename=$filename;
        $document->save();
        return $this->resp->ok(eResponseCode::DOC_STORED_200_02,$document);

    }
    public function destroy(Request $request){
        $document=Document::find($request->id);
        if(!$document){
            return $this->resp->not_found(eResponseCode::DOC_NOT_FOUND_404_00);
        }
        else {
            $document->categories()->detach();
            $document->delete();
            return $this->resp->ok(eResponseCode::DOC_DELETED_200_04);
        }
    }
    public function sendDocumentFilesStoragePath(){
        return $this->resp->ok(eResponseCode::DOC_FOLDER_LINK_407_00,asset("/storage/cdn/document/"));
    }
}
