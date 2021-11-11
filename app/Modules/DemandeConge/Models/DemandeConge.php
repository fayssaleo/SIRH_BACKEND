<?php

namespace App\Modules\DemandeConge\Models;

use App\Modules\Collaborateur\Models\Collaborateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeConge extends Model
{
    use HasFactory;
    public function typeConge(){
        return $this->belongsTo(TypeConge::class);
    }
    public function collaborateur()
    {
        return $this->belongsTo(Collaborateur::class);
    }
}
