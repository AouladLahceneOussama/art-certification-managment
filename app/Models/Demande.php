<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Facades\Admin;

class Demande extends Model
{
    use HasFactory;
    protected $fillable = [
        "id",
        "nom",
        "prenom",
        "email",
        "telephone",
        "nom_artist",
        "titre_oeuvre",
        "type_oeuvre",
        "longueur",
        "largeur",
        "hauteur",
        "technique_materiaux",
        "support",
        "added",
        "statut",
        "annee_creation",
        "Emplacement_signature",
        "numero_serie",
        "method_paiement",
        "frais_demande",
        "payee"
    ];

    public function setStatutAttribute($value)
    {
        if ($value == "Acceptée" && $this->attributes['added'] == '0') {


            //cas lithograohie :
            if ($this->attributes['type_oeuvre'] == "lito") {

                $lito = Lito::where([
                    ['admin_user_id', '=', Admin::user()->id],
                    ['numero_serie', '=', $this->attributes['numero_serie']],
                ])->first();


                if (empty($lito)) {
                    $this->attributes['added'] = 2;
                    $lito = Lito::create([
                        "admin_user_id" => Admin::user()->id,
                        "titre" => $this->attributes['titre_oeuvre'],
                        "annee_creation" => $this->attributes['annee_creation'],
                        "longueur" => $this->attributes['longueur'],
                        "largeur" => $this->attributes['largeur'],
                        "technique_materiaux" => $this->attributes['technique_materiaux'],
                        "support" => $this->attributes['support'],
                        "numero_serie" => $this->attributes['numero_serie'],
                        "Emplacement_signature" => $this->attributes['Emplacement_signature'],
                        "origine_oeuvre" => $this->attributes['nom'] . ' ' . $this->attributes['prenom']
                    ]);
                    Media::where('demande_id','=',$this->attributes['id'])->update(['lito_id' => $lito->id]);
                    $createCertificat = true;
                } else {
                    $this->attributes['added'] = 1;
                    $certificat = Certificat::where('lito_id', '=', $lito->id)->first();
                    if (empty($certificat))
                        $createCertificat = true;
                }

                //certificate : 
                if ($createCertificat) {
                    Certificat::create([
                        "admin_user_id" => Admin::user()->id,
                        "lito_id" => $lito->id,
                        "code_certificat" => uniqid()
                    ]);
                }
            }
            
            //Cas sculpture :
            if ($this->attributes['type_oeuvre'] == "sculpture") {
                $sculpture = Sculpture::where([
                    ['admin_user_id', '=', Admin::user()->id],
                    ['numero_serie', '=', $this->attributes['numero_serie']],
                ])->first();


                if (empty($sculpture)) {
                    $this->attributes['added'] = 2;
                    $sculpture = Sculpture::create([
                        "admin_user_id" => Admin::user()->id,
                        "titre" => $this->attributes['titre_oeuvre'],
                        "annee_creation" => $this->attributes['annee_creation'],
                        "longueur" => $this->attributes['longueur'],
                        "largeur" => $this->attributes['largeur'],
                        "hauteur" => $this->attributes['hauteur'],
                        "technique_materiaux" => $this->attributes['technique_materiaux'],
                        "support" => $this->attributes['support'],
                        "numero_serie" => $this->attributes['numero_serie'],
                        "origine_oeuvre" => $this->attributes['nom'] . ' ' . $this->attributes['prenom']
                    ]);
                    Media::where('demande_id','=',$this->attributes['id'])->update(['sculpture_id' => $sculpture->id]);

                    $createCertificat = true;
                } else {
                    $this->attributes['added'] = 1;
                    $certificat = Certificat::where('sculpture_id', '=', $sculpture->id)->first();
                    if (empty($certificat))
                        $createCertificat = true;
                }

                //certificate : 
                if ($createCertificat) {
                    $certificat = Certificat::create([
                        "admin_user_id" => Admin::user()->id,
                        "sculpture_id" => $sculpture->id,
                        "code_certificat" => uniqid()
                    ]);
                }
                $tab = $sculpture;
            }
            //cas tableau
            if ($this->attributes['type_oeuvre'] == "tableau") {
                $tableau = Tableau::where([
                    ['admin_user_id', '=', Admin::user()->id],
                    ['titre', '=', $this->attributes['titre_oeuvre']],
                ])->first();


                if (empty($tableau)) {
                    $this->attributes['added'] = 2;
                    $tableau = Tableau::create([
                        "admin_user_id" => Admin::user()->id,
                        "titre" => $this->attributes['titre_oeuvre'],
                        "annee_creation" => $this->attributes['annee_creation'],
                        "longueur" => $this->attributes['longueur'],
                        "largeur" => $this->attributes['largeur'],
                        "technique_materiaux" => $this->attributes['technique_materiaux'],
                        "support" => $this->attributes['support'],
                        "Emplacement_signature" => $this->attributes['Emplacement_signature'],
                        "origine_oeuvre" => $this->attributes['nom'] . ' ' . $this->attributes['prenom']
                    ]);
                    $createCertificat = true;
                    Media::where('demande_id','=',$this->attributes['id'])->update(['tableau_id' => $tableau->id]);
                } else {
                    $this->attributes['added'] = 1;
                    $certificat = Certificat::where(
                        'tableau_id', '=', $tableau->id
                    )->first();

                    if (empty($certificat))
                        $createCertificat = true;
                }

                //certificate : 
                if (true) {
                    $certificat = Certificat::create([
                        "admin_user_id" => Admin::user()->id,
                        "tableau_id" => $tableau->id,
                        "code_certificat" => uniqid()
                    ]);
                }
                $tab = $tableau;
            }
                
             
        }
        if (($value == "Refusée" || $value == "En attente") && $this->attributes['added'] == '2') {
            if ($this->attributes['type_oeuvre'] == "lito") {
                Lito::where([
                    ['admin_user_id', '=', Admin::user()->id],
                    ['numero_serie', '=', $this->attributes['numero_serie']],
                ])->delete();
            }
            if ($this->attributes['type_oeuvre'] == "sculpture") {
                Sculpture::where([
                    ['admin_user_id', '=', Admin::user()->id],
                    ['numero_serie', '=', $this->attributes['numero_serie']],
                ])->delete();
            }
            if ($this->attributes['type_oeuvre'] == "tableau") {
                Tableau::where([
                    ['admin_user_id', '=', Admin::user()->id],
                    ['titre', '=', $this->attributes['titre_oeuvre']],
                ])->delete();
            }

            $this->attributes['added'] = 0;
        }

        $this->attributes['statut'] = $value;
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }
}
