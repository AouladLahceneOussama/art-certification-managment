<?php

namespace App\Http\Livewire;

use App\Models\Certificat;
use App\Models\Lito;
use App\Models\RechercheParCode;
use App\Models\Sculpture;
use App\Models\Tableau;
use Livewire\Component;

class Recherche extends Component
{
    public $code_certificat;
    public $nom;
    public $prenom;
    public $email;
    public $telephone;
    public $id_artist;

    public $oeuvreCertificat;

    protected $rules = [
        'id_artist' => 'required',
        'nom' => 'required',
        'prenom' => 'required',
        'telephone' => ['required','regex:/^(06)[0-9]{8}$/'],
        'email' => 'required|email',
        'code_certificat' => 'required',
    ];

    protected $messages = [
        'required' => 'ce champ est obligatoire',
    ];
    
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $validateSearch = $this->validate();
        RechercheParCode::create($validateSearch);

        $certificat = Certificat::where([
                ['code_certificat' ,'=', $this->code_certificat],
                ['admin_user_id' ,'=', $this->id_artist]
            ])->first();

        if($certificat != null){
            $this->emit('showCertificat',$certificat,$this->code_certificat);
        }
        else{
            session()->flash('noCertificat', 'Ce code de certificat n\'existe pas');
        }

        $this->reset('nom');
        $this->reset('prenom');
        $this->reset('telephone');
        $this->reset('email');
        $this->reset('code_certificat');
    }

    public function render()    
    {
        return view('livewire.recherche');
    }
}
