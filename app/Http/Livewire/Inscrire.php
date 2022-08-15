<?php

namespace App\Http\Livewire;

use App\Mail\VerificationMail;
use App\Models\Abonnement;
use App\Models\Administrator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Braintree\Gateway as BT;
use Carbon\Carbon;

class Inscrire extends Component
{
    use WithFileUploads;

    public $LastName;
    public $FirstName;

    public $username;
    public $password;
    public $cPassword;

    public $birth;
    public $pays;

    public $phone;
    public $email;

    public $occupation;
    public $autre_nom = null;
    public $specialities = [];
    public $biography;

    public $avatar;
    public $coverture_photo;

    public $autre = false;

    public $randomString;

    public $pourcentage = 0;
    public $currentPage = 1;
    public $pages = [
        1 => [
            'title' => 'Information d\'authentification',
            'description' => 'Veuillez remplir ce formulaire, Tout les champs sont obligatoires'
        ],
        2 => [
            'title' => 'Information personnel et professionnel',
            'description' => 'Veuillez remplir ce formulaire, Tout les champs sont obligatoires'
        ],
        3 => [
            'title' => 'Image de profile et couverture',
            'description' => 'Cette phrase n\'est pas obligatoires vous pouvez la dépassez'
        ],
        4 => [
            'title' => 'Paiement de l\'inscription',
            'description' => 'Veuillez Choisir la méthode de paiement pour finaliser votre demande'
        ],
    ];

    public $amountToPay = 0;
    public $payment_method_nonce;
    public $clientToken;
    public $paymentMethod;
    public $plan;
    public $paymentProcess = 'begin';
    public $success;

    protected $listeners = [ 'continuePayment' => 'testTransaction'];

    private $validationRules = [
        1 => [
            'LastName' => ['required','min:5'],
            'FirstName' => ['required','min:5'],
            'username' => ['required','min:5','unique:admin_users,username'],
            'password' => ['required','required_with:cPassword','min:6'],
            'cPassword' => ['required','same:password','min:6'],
        ],
        2 => [
            'birth' => ['required'],
            'pays' => ['required','min:3'],
            'phone' => ['required','regex:/^((06))[0-9]{8}$/'],
            'email' => ['required','email'],
            'occupation' => ['required'],
            'autre_nom' => ['required_if:occupation,entreprise,autre,gallerie','nullable','min:3'],
            'specialities' => ['required'],
            'biography' => ['required','max:255','min:10'],
        ],
        3 => [
            'avatar' => ['nullable','image','mimes:jpeg,jpg,png,gif'],
            'coverture_photo' => ['nullable','image','mimes:jpeg,jpg,png,gif'],
        ],
        4 => [
            'amountToPay' => ['required','in:10,25,20','gt:0'],  
            'paymentMethod' => ['required','in:face a face,Paypal ou Card'],
        ],
    ];

    protected $queryString = ['amountToPay'];

    protected $messages = [
        'required' => 'Ce champ est obligatoire',
        'required_if' => 'Ce champ est obligatoire',
        'email' => 'Email non valide',
        'unique' => 'Ce alias déjà existé',
        'min' => 'Trop court',
        'max' => 'Trop long',
        'image' => 'Image non valide',
        'mimes' => 'Format non acceptable',
        'regex' => 'Format de numéro non acceptable',
        'same' => 'Mot de passe non compatible'
    ];
    
    public function goNext(){
        $this->validate($this->validationRules[$this->currentPage]);
        $this->pourcentage += 25;
        $this->currentPage++;
    }

    public function goBack(){
        
        $this->pourcentage -= 25;
        $this->currentPage--;
    }

    public function removeImage($image){
        if( $image == 1 ){
            $this->reset('avatar');
        }
        if( $image == 2 ){
            $this->reset('coverture_photo');
        }
    }

    public function updated($propertyName){
        if($this->occupation == 'entreprise' || $this->occupation == 'autre' || $this->occupation == 'gallerie')
            $this->autre = true;
        else
            $this->autre = false;

        if($this->amountToPay == 10)
            $this->plan = 'mois';

        if($this->amountToPay == 20)
            $this->plan = 'annee';
        
        if($this->amountToPay == 25)
            $this->plan = 'inditermine';
        
        $this->validateOnly($propertyName,$this->validationRules[$this->currentPage]);
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
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
                'firstName' => $this->FirstName,
                'lastName' => $this->LastName,
                'email' => $this->email,
            ],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            $transaction = $result->transaction; 
            $this->paymentProcess = 'seccessful';   
            $this->success =    'Votre paiement est passee avec succee avec <b class="uppercase">'.$transaction->paymentInstrumentType.'</b> son identifiant est <b class="uppercase">'. $transaction->id .'</b><br>
                                    Votre abonnement est <b class="uppercase">'.$this->plan .'</b><br>
                                    Frais d\'abonnement est <b class="uppercase">'.$this->amountToPay.'$</b>';
       
        } else {
            $errorString = "";    
            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
            $this->paymentProcess = 'unseccessful';   
            session()->flash('error_message', 'Une erreur est occeru lors de paiment </br>'.$errorString);
        }
    }

    public function save(){        

        $this->randomString = $this->generateRandomString();
        $rules = collect($this->validationRules)->collapse()->toArray();
        $this->validate($rules);
        
        if($this->avatar != null && $this->coverture_photo != null){
            Image::make($this->avatar->getRealPath())->crop(500,500)->save(public_path('storage/profiles/profile/'.$this->avatar->hashName()));
            $this->coverture_photo->store('profiles/background','public');
        }

        $artist = Administrator::create([
            'LastName' => $this->LastName,
            'FirstName' => $this->FirstName,

            'username' => $this->username,
            'password' => Hash::make($this->password),

            'birth' => $this->birth,
            'pays' => $this->pays,

            'phone' => $this->phone,
            'email' => $this->email,
            
            'occupation' => $this->occupation,
            'specialities' => $this->specialities,
            'autre_nom' => $this->autre_nom,
            'biography' => $this->biography,

            'avatar' => $this->avatar != null ? "/profiles/profile/".$this->avatar->hashName() : "/images/userProfile.png",
            'coverture_photo' => $this->coverture_photo != null ? "/profiles/background/".$this->coverture_photo->hashName() : "/images/userBackground.jpg",

            'email_token' => $this->randomString,
            'email_verified' => false,
        ]);

        DB::table('admin_role_users')->insertOrIgnore([
            [
                'role_id' => 2, 
                'user_id' => $artist->id,
            ],
            
        ]);
        
        $debut = null;
        $fin = null;

        if($this->paymentMethod === 'Paypal ou Card' && $this->paymentProcess === 'seccessful'){
            Administrator::where('id',$artist->id)->update(['isActif' => 1]);
            
            $debut = Carbon::now();
            if($this->plan == 'mois')
                $fin = $debut->copy()->addMonth();
            
            if($this->plan == 'annee')
                $fin = $debut->copy()->addYear();
            
            if($this->plan == 'inditermine')
                $fin = $debut->copy()->addYearsWithOverflow(100);  
        }

        Abonnement::create([
            'admin_user_id' => $artist->id,
            'plan' => $this->plan,
            'method_paiement' => $this->paymentMethod,
            'frais_plan' => $this->amountToPay,
            'debut_abonnement' => $debut,
            'fin_abonnement' => $fin,
        ]);

        Mail::to($this->email)->send(new VerificationMail($this->username,$this->randomString,$this->paymentMethod,$this->amountToPay,$this->plan));
        return redirect()->to('/mail/verify/'.$this->username);
        $this->reset();
    }

    public function mount(){
        $gateway = new BT([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
        
        $this->clientToken = $gateway->ClientToken()->generate();
    }

    public function render()
    {
        return view('livewire.inscrire',[ 'token' =>  $this->clientToken ]);
    }
}
