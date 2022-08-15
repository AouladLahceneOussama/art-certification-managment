<?php

use App\Http\Controllers\CertificatController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ProfileController;
use App\Models\Abonnement;
use App\Models\Certificat;
use App\Models\Lito;
use App\Models\Sculpture;
use App\Models\Tableau;
use App\Models\Administrator;
use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //dd(config('admin.default_avatar'));
    return view('welcome');
});

Route::get('/signup', function () {
    return view('sign');
});

Route::get('/profile/{name}',[ProfileController::class,'show']);

Route::get('/mail/verify/{alias}',[MailController::class,'show']);
Route::get('/mail/verify/{alias}/resend',[MailController::class,'resendEmail']);
Route::get('/mail/verified/{alias}/{token}',[MailController::class,'verifiedEmail'])->name('mail.verified');

Route::get('/certificat/{artistId}/{code}',[CertificatController::class,'show']);

Route::get('/inscription',function(){
    return view('sign');
});

Route::get('/admin/pdf/{oeuvreInfo}/{certificat}', function ($oeuvreInfo,$certificat) {
    $oeuvre = explode("-",$oeuvreInfo);
    $oeuvreType = $oeuvre[0];
    $oeuvreId = $oeuvre[1];
    

    if($oeuvreType == 'tableau')
        $data = Tableau::findOrFail($oeuvreId);
     
    if($oeuvreType == 'lito')
        $data = Lito::findOrFail($oeuvreId);

    if($oeuvreType == 'sculpture')
        $data = Sculpture::findOrFail($oeuvreId);
    
    $certificat = Certificat::findOrFail($certificat);

    //dd($certificat);  
    $pdf = PDF::loadView('pdf.document', ["oeuvre" => $data ,'codeCertificat' => $certificat->code_certificat]);
    $pdf->setOptions(['defaultFont' => 'Times New Roman','isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

    // download PDF file with download method
    return $pdf->stream('certificat_'.$data->titre.'_'.$data->id.'.pdf');  
    
    return $pdf->download('document.pdf');
 
});

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

Route::get('/paypal', function () {
    $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);

    $token = $gateway->ClientToken()->generate();

    return view('drop-in', [
        'token' => $token
    ]);
});

Route::post('/checkout', function (Request $request) {
    $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);

    $amount = $request->amount;
    $nonce = $request->payment_method_nonce;

    $result = $gateway->transaction()->sale([
        'amount' => $amount,
        'paymentMethodNonce' => $nonce,
        'customer' => [
            'firstName' => 'Tony',
            'lastName' => 'Stark',
            'email' => 'tony@avengers.com',
        ],
        'options' => [
            'submitForSettlement' => true
        ]
    ]);

    if ($result->success) {
        $transaction = $result->transaction;
        // header("Location: transaction.php?id=" . $transaction->id);

        return back()->with('success_message', 'Transaction successful. The ID is:'. $transaction->id);
    } else {
        $errorString = "";

        foreach ($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        }

        // $_SESSION["errors"] = $errorString;
        // header("Location: index.php");
        return back()->withErrors('An error occurred with the message: '.$result->message);
    }

});

// Route::get('/{artist}/abonnement',function($artist){
//     $artist = Administrator::where('username','=',$artist)->first();
//     return view('paiement',['artist' => $artist]);
// });