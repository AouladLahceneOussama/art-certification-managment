<?php

namespace App\Models;

use App\Models\Administrator as ModelsAdministrator;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Facades\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lito extends Model
{
    use HasFactory;
    protected $fillable = [
        "admin_user_id",
        "titre",
        "annee_creation",
        "longueur",
        "largeur",
        "technique_materiaux",
        "support",
        "numero_serie",
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
        return $this->belongsTo(ModelsAdministrator::class);
    }
}
