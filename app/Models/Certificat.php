<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificat extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "admin_user_id",
        "sculture_id",
        "tableau_id",
        "lito_id",
        "code_certificat",
    ];

    public function tableau(){
        return $this->belongsTo(Tableau::class);
    }
    public function sculpture(){
        return $this->belongsTo(Sculpture::class);
    }
    public function lito(){
        return $this->belongsTo(Lito::class);
    }

    public function administrator(){
        return $this->belongsTo(Administrator::class);
    }
}
