<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sculpture extends Model
{
    use HasFactory;

    protected $fillable = [
        "admin_user_id",
        "titre",
        "longueur",
        "largeur",
        "hauteur",
        "technique_materiaux",
        "numero_serie",
        "annee_creation",
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
        return $this->belongsTo(ModelsAdministrator::class);
    }
}
