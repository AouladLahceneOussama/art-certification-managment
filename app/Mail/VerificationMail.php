<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationMail extends Mailable
{
    use Queueable, SerializesModels;
    private $name;
    private $randomString;
    private $paymentMethod;
    private $amountToPay;
    private $plan;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$randomString,$paymentMethod,$amountToPay,$plan)
    {
        $this->name = $name;
        $this->randomString = $randomString;
        $this->paymentMethod = $paymentMethod;
        $this->amountToPay = $amountToPay;
        $this->plan = $plan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.verificationEmail',['plan' => $this->plan,'amountToPay' => $this->amountToPay,'paymentMethod' => $this->paymentMethod,'name' => $this->name,'url'=>route('mail.verified',['alias' => $this->name,'token'=> $this->randomString])]);   
    }
}
