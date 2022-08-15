<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Administrator;
use App\Models\Tableau;
use App\Models\Lito;
use App\Models\Sculpture;
class Certificat extends Component
{

    protected $listeners = ['showCertificat' => 'openCertificat'];
    public $showCertificatContainer = false;
    public $oeuvre;
    public $artist;
    public $codeCertificat;

    public function openCertificat($certificat,$code){
        $this->showCertificatContainer = true;
        $this->codeCertificat = $code;

        $this->artist = Administrator::findOrFail($certificat['admin_user_id']);

        if ($certificat != null) {
            if ($certificat['lito_id'] != null) {
                $this->oeuvre = Lito::find($certificat['lito_id']);
            }

            if ($certificat['tableau_id'] != null) {
                $this->oeuvre = Tableau::find($certificat['tableau_id']);
            }

            if ($certificat['sculpture_id'] != null) {
                $this->oeuvre = Sculpture::find($certificat['sculpture_id']);
            }
        }
    }

    public function closeCertificat(){
        $this->showCertificatContainer = false;
    }
    
    public function render()
    {
        return view('livewire.certificat',['oeuvreCertificat' => $this->oeuvre ,'artist' => $this->artist,'codeCertificat'=> $this->codeCertificat]);
    }
}
