<?php

namespace App\Modules\Utilisateur\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public function privileges()
    {
        return $this->belongsToMany(Privilege::class,"role_privilege");
    }
    public function utilisateurs(){
        return $this->hasMany(Utilisateur::class);
    }
}
