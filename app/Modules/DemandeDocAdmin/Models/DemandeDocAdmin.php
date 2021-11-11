<?php

namespace App\Modules\DemandeDocAdmin\Models;

use App\Modules\Categorie\Models\Categorie;
use App\Modules\Collaborateur\Models\Collaborateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeDocAdmin extends Model
{
    use HasFactory;
    public function collaborateur(){
        return $this->belongsTo(Collaborateur::class);
    }
    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }
}
