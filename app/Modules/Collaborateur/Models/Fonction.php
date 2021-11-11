<?php

namespace App\Modules\Collaborateur\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fonction extends Model
{
    use HasFactory;
    protected $fillable=["libelle","fichePoste","createdBy"];
    public function departement(){
        return $this->belongsTo(Departement::class);
    }
    public function collaborateurs(){
        return $this->hasMany(Collaborateur::class);
    }
}
