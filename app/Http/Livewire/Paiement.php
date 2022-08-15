<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Braintree\Gateway as BT;
use Carbon\Carbon;
use App\Models\Abonnement;

class Paiement extends Component
{
    public $artist;

    public $clientToken;
    public $paymentMethod;
    public $plan;
    public $amountToPay = 0;
    public $payment_method_nonce;
    public $paymentProcess;
    public $success;

    protected $listeners = [ 'continuePayment' => 'testTransaction'];


    public function renewSubscription(){

        if($this->amountToPay == 10)
            $this->plan = 'mois';

        if($this->amountToPay == 20)
            $this->plan = 'annee';
        
        if($this->amountToPay == 25)
            $this->plan = 'inditermine';

        if($this->paymentMethod === 'Paypal ou Card' && $this->paymentProcess === 'seccessful'){
            
            $finDate = Abonnement::where('admin_user_id','=',$this->artist->id)->first()->fin_abonnement;
            $finAbonnement = Carbon::createFromFormat('Y-m-d', $finDate); 
            
            if($this->plan == 'mois')
                $fin = $finAbonnement->copy()->addMonth();
            
            if($this->plan == 'annee')
                $fin = $finAbonnement->copy()->addYear();
            
            if($this->plan == 'inditermine')
                $fin = $finAbonnement->copy()->addYearsWithOverflow(100); 
                
            Abonnement::where('admin_user_id','=',$this->artist->id)
                ->update([
                    'plan'=>$this->plan,
                    'method_paiement'=>$this->paymentMethod,
                    'frais_plan'=>$this->amountToPay,
                    'fin_abonnement'=>$fin
                ]);
        }

        Abonnement::where('admin_user_id','=',$this->artist->id)
                ->update([
                    'plan'=>$this->plan,
                    'method_paiement'=>$this->paymentMethod,
                    'frais_plan'=>$this->amountToPay,
                    'fin_abonnement'=>$fin
                ]);
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
                'firstName' => $this->artist->FirstName,
                'lastName' => $this->artist->LastName,
                'email' => $this->artist->email,
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
        return view('livewire.paiement',[ 'token' =>  $this->clientToken ]);
    }
}
