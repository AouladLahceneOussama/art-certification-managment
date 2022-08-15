<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_user_id',
        'plan',
        'frais_plan',
        'method_paiement',
        'debut_abonnement',
        'fin_abonnement'
    ];

    public function administrator(){
        return $this->hasOne(Administrator::class);
    } 
}
