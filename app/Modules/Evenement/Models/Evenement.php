<?php

namespace App\Modules\Evenement\Models;

use App\Modules\Categorie\Models\Categorie;
use App\Modules\Collaborateur\Models\Collaborateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    protected $guarded=["id"];
    use HasFactory;
    public function categorie(){
        return $this->belongsTo(Evenements_Categorie::class,"evenements_categorie_id");
    }
    public function invites(){
        return $this->belongsToMany(Collaborateur::class,"evenement_collaborateur")
            ->select('collaborateur_id','statut');
    }
}
