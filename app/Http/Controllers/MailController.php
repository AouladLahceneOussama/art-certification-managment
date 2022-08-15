<?php

namespace App\Http\Controllers;

use App\Mail\VerificationMail;
use App\Models\Administrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    public function show($alias){
        $artist =  Administrator::where('username','=',$alias)->first();
        return view('emails.verificationPage',['alias'=>$alias,'emailVerified' => $artist->email_verified]);
    }

    public function resendEmail($alias){
        $user = Administrator::where('username','=',$alias)->first();

        if(!$user->email_verified){
            Mail::to($user->email)->send(new VerificationMail($user->username,$user->email_token,$user->abonnement->method_paiement,$user->abonnement->frais_plan,$user->abonnement->plan));
            return redirect()->to('/mail/verify/'.$user->username);
        }else{
            return redirect()->to('/admin');
        }
    }

    public function verifiedEmail($alias,$token){
        Administrator::where([
            ['username','=',$alias],
            ['email_token','=',$token]
        ])->update(['email_verified' => true]);

        return redirect()->to('/admin');
    }
}
