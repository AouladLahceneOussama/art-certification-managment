<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RechercheParCode extends Model
{
    use HasFactory;
    protected $fillable = [
        "id_artist",
        "nom",
        "prenom",
        "email",
        "telephone",
        "code_certificat",
    ];
}
