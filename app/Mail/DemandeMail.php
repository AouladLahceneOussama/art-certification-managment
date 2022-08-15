<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DemandeMail extends Mailable
{
    use Queueable, SerializesModels;
    private $demande;
    private $paymentMethod;
    private $amountToPay;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($demande,$paymentMethod,$amountToPay)
    {
        $this->demande = $demande;
        $this->paymentMethod = $paymentMethod;
        $this->amountToPay = $amountToPay;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.demandeEmail',['demande'=>$this->demande,'paymentMethod'=>$this->paymentMethod,'amountToPay'=>$this->amountToPay]);
    }
}
