<?php

namespace App\Modules\Utilisateur\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    use HasFactory;
    public function roles()
    {
        return $this->belongsToMany(Role::class,"role_privilege");
    }
}
