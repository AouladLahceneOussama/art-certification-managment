<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "sculture_id",
        "tableau_id",
        "lito_id",
        "image",
        "tag",
        "intitule",
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
    public function demande(){
        return $this->belongsTo(Demande::class);
    }

    public function getImageAttribute($image){
        return '/storage/'.$image;
    }
}
