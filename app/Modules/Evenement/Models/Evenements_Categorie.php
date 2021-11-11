<?php

namespace App\Modules\Evenement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenements_Categorie extends Model
{
    protected $guarded=["id"];
    use HasFactory;
    protected $table = 'evenements_categories';
    public function evenements(){
        return $this->hasMany(Evenement::class,"evenements_categorie_id");
    }
}
