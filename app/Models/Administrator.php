<?php

namespace App\Models;

use Encore\Admin\Auth\Database\Administrator as AdminUse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Administrator extends AdminUse
{

    protected $fillable = [

        'id',
        'LastName',
        'FirstName',
        'username',
        'avatar',
        'password',
        'phone',
        'email',
        'birth',
        'pays',
        'occupation',
        'autre_nom',
        'specialities',
        'biography',
        'coverture_photo',
        'email_token' ,
        'email_verified',
        'isActif'
        
    ];

    /*  public function getSpecialitiesAttribute($value)
    {
        return explode(',', $value);   
    }

    public function setSpecialitiesAttribute($value)
    {
        $this->attributes['specialities'] = implode(',', $value);
    }
*/
    protected $casts = [
        'specialities' => 'array',
        'isActif' => 'boolean',
    ];

    public function lito(){
        return $this->hasMany(Lito::class);
    }
    public function sculpture(){
        return $this->hasMany(Sculpture::class);
    }
    public function tableau(){
        return $this->hasMany(Tableau::class,"admin_user_id");
    }

    public function certificat(){
        return $this->hasMany(Certificat::class,'admin_user_id');
    }

    public function abonnement(){
        return $this->hasOne(Abonnement::class,'admin_user_id');
    }

    public function getAvatarAttribute($avatar){
        if($avatar != null){
            $place = explode('/',$avatar);
            
            if($place[1] == 'images')
                return $avatar;
            else
                return $avatar ? '/storage/'.$avatar : '/images/userProfile.png';
        }
    }

    public function getCoverturePhotoAttribute($coverture){
        if($coverture != null){
            $place = explode('/',$coverture);
            if($place[1] == 'images')
                return $coverture;
            else
                return '/storage/'.$coverture;
        }
    }

    public function setIsActifAttribute($value){

        $this->attributes['isActif'] = $value;

        if($this->attributes['isActif']){
            $plan = Abonnement::where('admin_user_id','=',$this->attributes['id'])->first()->plan; 
            $debut = Carbon::now();
 
            if($plan == 'mois')
                $fin = $debut->copy()->addMonth();
            
            if($plan == 'annee')
                $fin = $debut->copy()->addYear();
            
            if($plan == 'inditermine')
                $fin = $debut->copy()->addYearsWithOverflow(100);  

            Abonnement::where('admin_user_id','=',$this->attributes['id'])
            ->update([
                'debut_abonnement' => $debut,
                'fin_abonnement' => $fin,
            ]);
        }
    }

}
