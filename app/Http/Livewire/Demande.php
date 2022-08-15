<?php

namespace App\Http\Livewire;

use App\Mail\DemandeMail;
use Livewire\Component;
use App\Models\Demande as Dem;
use Illuminate\Support\Facades\Mail;
use Braintree\Gateway as BT;
use Livewire\WithFileUploads;

class Demande extends Component
{
    use WithFileUploads;
    //variables to show forms and inputs
    public $tableau = false;
    public $lito = false;
    public $sculpture = false;
    public $images = [];

    //personal information of client
    public $nom;
    public $prenom;
    public $email;
    public $telephone;

    //information about the artist and the work to certificate
    public $type_oeuvre;
    public $titre_oeuvre;
    public $nom_artist;

    //informations shared between different types
    public $largeur;
    public $longueur;
    public $technique_materiaux;
    public $annee_creation;

    //information to add table
    public $support;
    public $Emplacement_signature;

    //inforamtion to add sculpture
    public $hauteur;
    public $numero_serie;
    //
    public $imagesForm = [];

    private $validationRules = [
        1 => [
            'nom' => ['required','min:3'],
            'prenom' => ['required','min:3'],
            'telephone' => ['required','regex:/^(06)[0-9]{8}$/'],
            'email' => ['required','email'],
        ],
        2 => [
            'type_oeuvre' => ['required'],
            'titre_oeuvre' => ['required'],
            'nom_artist' => ['required'],
            "longueur"  => ['required'],
            "largeur"  => ['required'],
            "hauteur"  => ['required_if:type_oeuvre,sculpture'],
            "technique_materiaux"  => ['required'],
            "support"  => ['required'],
            "annee_creation" => ['required','min:4','max:4','gt:1500'],
            "Emplacement_signature" => ['required'],
        ],
        3 => [
            "imagesForm.*.src" => ['required','image'],
            "imagesForm.*.intitule" => ['required'],
            "imagesForm.*.tag" => ['required'],
        ],
        4 =>[
            'paymentMethod' => ['required','in:face a face,Paypal ou Card'],
        ]
    ];

    protected $messages = [
        'required' => 'Ce champ est obligatoire',
        'required_if' => 'Ce champ est obligatoire',
        'email' => 'Email non valide',
        'unique' => 'Ce alias déjà existé',
        'min' => 'Trop court',
        'max' => 'Trop long',
        'image' => 'Image non valide',
        'mimes' => 'Format non acceptable',
        'regex' => 'Format de numero non acceptable',
        'gt' => 'Année très ancienne',
    ];

    public $pourcentage = 0;
    public $currentPage = 1;
    public $pages = [
        1 => [
            'title' => 'Information personnelles',
            'description' => 'Veuillez remplir ce formulaire, Tout les champs sont obligatoires'
        ],
        2 => [
            'title' => 'Information a propos de l\'oeuvre',
            'description' => 'Veuillez remplir ce formulaire, Tout les champs sont obligatoires
                            </br> Choisir le type de l\'oeuvre pour continuer'
        ],
        3 => [
            'title' => 'Images de l\'oeuvre',
            'description' => 'Veuillez entrer tout les images de l\'oeuvres disponibles <br>
                            NOTE : plus d\'image plus votre demande sera verifiee'
        ],
        4 => [
            'title' => 'Paiement du demande',
            'description' => 'Veuillez Choisir la méthode de paiement pour finaliser votre demande'
        ],
    ];

    public $amountToPay = 10;
    public $payment_method_nonce;
    public $clientToken;
    public $paymentMethod;
    public $paymentProcess = 'begin';
    public $success;

    protected $listeners = [ 'continuePayment' => 'testTransaction' ];

    public function goNext(){
        $this->validate($this->validationRules[$this->currentPage]);
        $this->pourcentage += 25;
        $this->currentPage++;
    }

    public function goBack(){   
        $this->pourcentage -= 25;
        $this->currentPage--;
    }

    public function mount()
    {
        $this->imagesForm = [
            ['src' => '', 'intitule' => __('Face'), 'tag' => ''],
            ['src' => '', 'intitule' => __('Arriere'), 'tag' => ''],
            ['src' => '', 'intitule' => __('Signature'), 'tag' => ''],
        ];

        $gateway = new BT([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
        
        $this->clientToken = $gateway->ClientToken()->generate();
    }

    public function addImage()
    {
        $this->imagesForm[] = ['src' => '', 'intitule' => '', 'tag' => ''];
    }

    public function resetImage($index)
    {
        $this->imagesForm[$index]['src'] = '';
    }

    public function removeImage($index)
    {
        //unset the image value
        unset($this->imagesForm[$index]);
        $this->imagesForm = array_values($this->imagesForm);
    }

    public function updated($propertyName)
    {
        if ($this->type_oeuvre == 'tableau')
            $this->tableau = true;
        else
            $this->tableau = false;

        if ($this->type_oeuvre == 'lito')
            $this->lito = true;
        else
            $this->lito = false;

        if ($this->type_oeuvre == 'sculpture')
            $this->sculpture = true;
        else
            $this->sculpture = false;

        
        $this->validateOnly($propertyName,$this->validationRules[$this->currentPage]);
    }

    public function testTransaction(){
        $gateway = new BT([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $amount = $this->amountToPay;
        $nonce = $this->payment_method_nonce;


        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'customer' => [
                'firstName' => $this->prenom,
                'lastName' => $this->nom,
                'email' => $this->email,
            ],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            $transaction = $result->transaction; 
            $this->paymentProcess = 'seccessful';   
            $this->success =    'Votre paiement est passee avec succee avec <b class="uppercase">'.$transaction->paymentInstrumentType.'
                                </b> son identifiant est <b class="uppercase">'. $transaction->id .'</b><br>
                                Frais de certification est <b class="uppercase">'.$this->amountToPay.'$</b>';
       
        } else {
            $errorString = "";    
            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
            $this->paymentProcess = 'unseccessful';   
            session()->flash('error_message', 'Une erreur est occeru lors de paiment </br>'.$errorString);
        }
    }

    public function save()
    {

        $rules = collect($this->validationRules)->collapse()->toArray();
        $this->validate($rules);

        $demande =  Dem::create([
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'telephone' => $this->telephone,
            'email' => $this->email,
            'type_oeuvre' => $this->type_oeuvre,
            'titre_oeuvre' => $this->titre_oeuvre,
            'nom_artist' => $this->nom_artist,
            "longueur"  => $this->longueur,
            "largeur"  => $this->largeur,
            "hauteur"  => $this->hauteur,
            "technique_materiaux"  => $this->technique_materiaux,
            "support"  => $this->support,
            "annee_creation" => $this->annee_creation,
            "Emplacement_signature" => $this->Emplacement_signature,  
            "method_paiement" => $this->paymentMethod,
            "frais_demande" => $this->amountToPay,
        ]);

        foreach ($this->imagesForm as $img) {
            $img['src']->store('oeuvres/', 'public');
            $demande->media()->create([
                'image' => 'oeuvres/' . $img['src']->hashName(),
                'intitule' => $img['intitule'],
                'tag' => $img['tag'],
            ]);
        }

        if($this->paymentMethod === 'Paypal ou Card' && $this->paymentProcess === 'seccessful')
            Dem::where('id',$demande->id)->update(['payee' => 1]);
        
        //send email to user about the art he wonts to get certificate
        Mail::to($this->email)->send(new DemandeMail($demande,$this->paymentMethod,$this->amountToPay));

        session()->flash('message', 'Votre demande est bien enregistré');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.demande',[ 'token' =>  $this->clientToken ]);
    }
}
