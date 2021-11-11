<?php

namespace App\Modules\Utilisateur\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    public function utilisateurs(){
        return $this->belongsToMany(Utilisateur::class,"notification_utilisateur")
            ->withTimestamps();
    }
}
