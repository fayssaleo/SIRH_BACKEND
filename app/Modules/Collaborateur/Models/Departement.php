<?php

namespace App\Modules\Collaborateur\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;
    protected $guarded=["id"];
    public function fonctions(){
        return $this->hasMany(Fonction::class);
    }
}
