<?php

namespace App\Modules\Collaborateur\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentPersonnel extends Model
{
    use HasFactory;
    public function collaborateur()
    {
        return $this->belongsTo(Collaborateur::class);
    }
}
