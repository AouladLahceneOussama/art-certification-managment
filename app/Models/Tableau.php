<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tableau extends Model
{
    use HasFactory;

    protected $fillable = [
        "admin_user_id",
        "titre",
        "longueur",
        "largeur",
        "technique_materiaux",
        "support",
        "annee_creation",
        "Emplacement_signature",
        "origine_oeuvre"
    ];

    public function media()
    {
        return $this->hasMany(Media::class);
    }
    public function certificat()
    {
        return $this->hasMany(Certificat::class);
    }
    public function artist()
    {
        return $this->belongsTo(Administrator::class,'admin_user_id');
    }
}
