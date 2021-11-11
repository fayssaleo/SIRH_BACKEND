<?php

namespace App\Modules\DemandeConge\Models;

use App\Modules\Categorie\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeConge extends Model
{
    use HasFactory;
    protected $guarded=["id"];
    public function demandeConges(){
        return $this->hasMany(DemandeConge::class);
    }
    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }
}
