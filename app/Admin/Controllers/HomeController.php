<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Abonnement;
use App\Models\Certificat;
use App\Models\Demande;
use App\Models\Message;
use App\Models\RechercheParCode;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

Admin::style('
            .notification{
                display:flex;
                flex-direction:row;
                justify-content:start;
                align-items:center;
                background-color:orange;
                padding:10px;
                border-radius:5px;
                margin:0 20px;
            }
            .notification span{
                font-size:50px;
                color:orange;
                width:50px;
                height:50px;
                background-color:white;
                line-height:50px;
                text-align:center;
                border-radius:50%;
                margin-right:20px;
            }
            .not-text{
                line-height:10px;
            }
            .not-text p{
                color:white;
                font-weight:bold;
            }
            .not-text a{
                color:black;
                font-weight:bold;
                margin-top:-100px;
                transition: .3s ease-in-out;
            }
            .not-text a:hover{
                color:gray;
            }


            form {
                display: flex;
            }
            input {
                color: var(--fg);
                font: 1em/1.5 Helvetica, sans-serif;
            }
            
            form, label {
                width: 100%;
            }
            form {
                margin: auto;
                max-width: 24em;
                padding: 0 1.5em;
            }
            label {
                margin-top: 50px;
                margin-bottom: 50px;
                display: block;
                text-align: center;
                -webkit-tap-highlight-color: transparent;
            }
            label:first-child input {
                border-radius: 0.5em 0 0 0.5em;
                box-shadow:
                    0.1em 0 0 #2726267f inset,
                    -0.1em 0 0 #27262600 inset,
                    0 0.1em 0 #afa490 inset,
                    0 -0.1em 0 #ffffff3f,
                    0 0.2em 0.5em #0000007f,
                    0 -0.1em 0 #926086 inset,
                    -0.1em -0.2em 0 #ffffff7f inset,
                    0.2em 0 0 #ffffff7f inset;
            }
            label:last-child input {
                border-radius: 0 0.5em 0.5em 0;
                box-shadow:
                    0 -0.1em 0 #926086 inset,
                    0.1em 0 0 #2726267f inset,
                    -0.1em 0 0 #2726267f inset,
                    0 0.1em 0 #afa490 inset,
                    -0.1em 0 0 #afa490 inset,
                    0 -0.1em 0 #ffffff3f,
                    0 0.2em 0.5em #0000007f,
                    -0.1em -0.1em 0 0.1em #ffffff7f inset;
            }
            label:first-child input:checked {
                box-shadow:
                    0.1em 0 0 #272626af inset,
                    -0.1em 0 0 #272626 inset,
                    0 0.1em 0 #847a62 inset,
                    0 -0.1em 0 #ffffff3f,
                    0 0.1em 0 #ffffff7f,
                    0 -0.1em 0 #722257 inset,
                    -0.1em -0.2em 0 #ffffff7f inset,
                    0.2em 0 0 #ffffff7f inset;
            }
            label:last-child input:checked {
                box-shadow:
                    0.1em 0 0 #272626af inset,
                    -0.1em 0 0 #272626 inset,
                    0 -0.1em 0 #722257 inset,
                    0 0.1em 0 #847a62 inset,
                    -0.1em 0 0 #847a62 inset,
                    0 -0.1em 0 #ffffff3f,
                    0 0.1em 0 #ffffff7f,
                    -0.1em -0.1em 0 0.1em #ffffff7f inset;
            }
            input {
                background-image: linear-gradient(#ffffff 15%,#605ca8 40%,#7c719b,#9ba0be,#c3adaa);
                border-radius: 0;
                box-shadow:
                    0.1em 0 0 #2726267f inset,
                    -0.1em 0 0 #27262600 inset,
                    0 0.1em 0 #afa490 inset,
                    0 -0.1em 0 #ffffff3f,
                    0 0.2em 0.5em #0000007f,
                    0 -0.1em 0 #926086 inset,
                    -0.1em -0.2em 0 #ffffff7f inset;
                cursor: pointer;
                display: block;
                margin-bottom: 0.5em;
                width: 100%;
                height: 1em;
                transition: box-shadow var(--transDur) ease-in-out;
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
            }
            input:checked {
                background-image: linear-gradient(#ffffff 15%,#605ca8 40%,#7c719b,#9ba0be,#c3adaa);
                box-shadow:
                    0.1em 0 0 #272626af inset,
                    -0.1em 0 0 #272626 inset,
                    0 0.1em 0 #847a62 inset,
                    0 -0.1em 0 #ffffff3f,
                    0 0.1em 0 #ffffff7f,
                    0 -0.1em 0 #722257 inset,
                    -0.1em -0.2em 0 #ffffff7f inset;
            }
            input:checked + span {
                opacity: 1;
            }
            input:focus {
                border-color : white;
                outline: transparent;
            }
            input + span {
                opacity: 0.65;
                transition: opacity var(--transDur) ease-in-out;
            }


            .icon{
                position :absolute;
                width : 60px;
                height :60px;
                border-radius: 100%;
                text-align: center;
                border: 3px solid  white;
                top : -25px;
                left : 20px;
                line-height: 56px;
                transition: .3s ease-in;


            }
            .title{
                font-size : 16px;
            }

            .bloc {  
                position :relative;
                text-align : center;
                color : white; 
                font-size : 24px; 
                border-radius: 10px; 
                padding: 40px 3px;  
                margin: 40px 20px;
                transition: .3s ease-in;

            }
            .c0{
               background-image: linear-gradient( #605ca8, #603c88);
            }
            .c0:hover {
                opacity : 90%;
            }

            .d6{
                background-image: linear-gradient( #ee3a3a, #ee1a1a);

             }
             .d6:hover {
                opacity : 90%;
                }
          
             .f7{
                background-image: linear-gradient( #00bbef, #009bcf);
             }
             .f7:hover {
                opacity : 90%;

             }

             .fc{
                background-image: linear-gradient( #00c632, #00a612);
             }
             .fc:hover {
                opacity : 90%;

             }
             .ff{
                background-image: linear-gradient( #FFA520, #FF8500);
             }
             .ff:hover {
                opacity : 90%;

             }
             
             .pp{
                background-image: linear-gradient( #9933EF, #9913CF);
             }
             .pp:hover {
                opacity : 90%;

             }
');


class HomeController extends Controller
{
    private $choice;
    public function index(Content $content)
    {


        if (!empty($_GET) && isset($_GET['choice']))
            $this->choice = $_GET['choice'];
        else
            $this->choice = "week";


        $content->title('Dashboard');
        $content->row('<h4 style ="color : #605ca8 ;"><center> Bienvenu ' . Admin::user()->FirstName . ' ' . Admin::user()->LastName . '</center></h4>');

        if (Admin::user()->id == 1) {
            $msg = Message::whereDate('created_at', '=', date('Y-m-d'))->get();

            if (count($msg) > 0) {
                $content->row(function (Row $row) {
                    $row->column(12, '
                    <div class="notification">
                        <span>!</span>
                        <div class="not-text">
                            <p>' . __('Vous avez des nouvelles messages') . '</p>
                            <a href="admin/messages?&created_at=' . date('Y-m-d') . '">' . __("Consulter les messages") . '</a>   
                        </div>
                    </div>');
                });
            }

            $content->row(function (Row $row) {
                $users =  DB::table('admin_users')
                    ->select(DB::raw('count(*) as total'))
                    ->where("id", '!=', "1")
                    ->first();


                $demandes = Demande::count();
                $certificat = Certificat::count();



                $row->column(4, '
                    <div class ="bloc c0" >
                        <div class ="icon c0" ><i class="fa fa-users" aria-hidden="true"></i>                    </div>
                        
                        <div class = "number"> ' . $users->total . ' </div>
                        <div class="title">' . __('Utilisateurs') . ' </div>
    
                    </div>');


                $row->column(4, '<div class ="bloc pp" >
                    <div class ="icon pp" ><i class="fa fa-list" aria-hidden="true"></i></div>
                    
                    <div class = "number"> ' . $demandes . ' </div>
                    <div class="title">' . __('Demandes de Certificat') . ' </div> 
                    </div>');

                $row->column(4, '<div class ="bloc fc" >
                 <div class ="icon fc" ><i class="fa fa-check-square-o" aria-hidden="true"></i></div>
                 
                 <div class = "number"> ' . $certificat . ' </div>
                 <div class="title">' . __('Certificats  generée') . ' </div> 
                    </div>');
            });

            $content->row(function (Row $row) {
                $nonActive = DB::table('admin_users')
                    ->select(DB::raw('count(*) as total'))
                    ->where("isActif", "=", "0")
                    ->first();

                $refuse = Demande::where([
                    ['statut', '=', 'Refusée']
                ])->count();

                $attente = Demande::where([
                    ['statut', '=', 'En attente']
                ])->count();

                $row->column(4, '
                    <div class ="bloc d6" >
                        <div class ="icon d6" ><i class="fa fa-exclamation-circle" aria-hidden="true"></i></div>
            
                        <div class = "number"> ' . $refuse . ' </div>
                        <div class="title">' . __('Faux œuvres') . ' </div> 
                    </div>');

                $row->column(4, '
                    <div class ="bloc ff" >
                    <div class ="icon ff" ><i class="fa fa-exclamation-circle" aria-hidden="true"></i></div>
        
                    <div class = "number"> ' . $nonActive->total . ' </div>
                    <div class="title">' . __('Comptes non actifs') . ' </div> 
                    </div>');


                $row->column(4, '
                        <div class ="bloc f7" >
                            <div class ="icon f7" ><i class="fa fa-pause" aria-hidden="true"></i></div>
                            
                            <div class = "number"> ' . $attente . ' </div>
                            <div class="title">' . __('Demandes En attente') . ' </div> 
                        </div>');
            });
        } 
        else {
            $fin_abonnement = Abonnement::where('admin_user_id', '=', Admin::user()->id)->first()->fin_abonnement;
            $finAbonnement = Carbon::createFromFormat('Y-m-d', $fin_abonnement);

            if (date('Y-m-d H:i:s') >= $finAbonnement->copy()->subDays(2)) {
                $content->row(function (Row $row) {
                    $row->column(12, '
                    <div class="notification">
                        <span>!</span>
                        <div class="not-text">
                            <p>' . __('Votre abonnement est sur le bout de terminer') . '</p>
                            <a href="/admin/' . Admin::user()->username . '/abonnement">' . __("Renouvlez votre abonnement") . '</a>   
                        </div>
                    </div>');
                });
            }

            $content->row(function (Row $row) {
                $search = RechercheParCode::where('id_artist', '=', Admin::user()->id)->count();

                $refuse = Demande::where([
                    ['nom_artist', '=', Admin::user()->username],
                    ['statut', '=', 'Refusée']
                ])->count();

                $accepte = Demande::where([
                    ['nom_artist', '=', Admin::user()->username],
                    ['statut', '=', 'Acceptée']
                ])->count();
                $attente = Demande::where([
                    ['nom_artist', '=', Admin::user()->username],
                    ['statut', '=', 'En attente']
                ])->count();

                $row->column(3, '
                <div class ="bloc c0" >
                    <div class ="icon c0" ><i class="fa fa-search" aria-hidden="true"></i>                    </div>
                    
                    <div class = "number"> ' . $search . ' </div>
                    <div class="title">' . __('Recherches par code') . ' </div>

                </div>');

                $row->column(3, '
                <div class ="bloc d6" >
                    <div class ="icon d6" ><i class="fa fa-exclamation-circle" aria-hidden="true"></i></div>
        
                    <div class = "number"> ' . $refuse . ' </div>
                    <div class="title">' . __('Faux œuvres') . ' </div> 
                </div>');

                $row->column(3, '
                <div class ="bloc f7" >
                    <div class ="icon f7" ><i class="fa fa-pause" aria-hidden="true"></i></div>
                    
                    <div class = "number"> ' . $attente . ' </div>
                    <div class="title">' . __('Demandes En attente') . ' </div> 
                 </div>');

                $row->column(3, '<div class ="bloc fc" >
                    <div class ="icon fc" ><i class="fa fa-check" aria-hidden="true"></i></div>
                    
                    <div class = "number"> ' . $accepte . ' </div>
                    <div class="title">' . __('Demandes acceptées') . ' </div> 
                 </div>');
            });



            
        }

        $content->row('<h4 style ="color : #605ca8 ;"><center>' . __('Statistiques') . '</center></h4>');
        $content->row('
            <form action="" method="GET">
                <label><input type="radio" name="choice" value="week" onclick="this.form.submit();">
                <span>' . __('Semaine') . ' </span></label>
                <label><input type="radio" name="choice" value="month" onclick="this.form.submit();">
                <span>' . __('Mois') . '</span> </label>
                <label> <input type="radio" name="choice" value="year" onclick="this.form.submit();">
                <span>' . __('Année') . '</span> </label>
            </form>');
            
        if (Admin::user()->id == 1) {
            $content->row(function (Row $row) {
                $row->column(4, new Box(__('Demandes de certificat par artist : TOP 10 '), view('admin.chartjs-demandesTop10', ["choice" => $this->choice])));
                $row->column(4, new Box(__('Certificats generées par artist : TOP 10 '), view('admin.chartjs-certificatTop10', ["choice" => $this->choice])));
                $row->column(4, new Box(__('Graphe des insciptions '), view('admin.chartjs-inscription', ["choice" => $this->choice])));
            });
            $content->row(function (Row $row) {
                $row->column(4, new Box(__('Recherches par code'), view('admin.chartjs-RechercheParcodeAdmin', ["choice" => $this->choice])));
                $row->column(4, new Box(__('Type d\'abonnement'), view('admin.chartjs-abbonnement', ["choice" => $this->choice])));
            });
        } else {

            $content->row(function (Row $row) {

                $row->column(4, new Box(__('Demandes de certificat '), view('admin.chartjs-demandes-certificat', ["choice" => $this->choice])));
                $row->column(4, new Box(__('Etats des demandes de certificat'), view('admin.chartjs-doughnut', ["choice" => $this->choice])));
                $row->column(4, new Box(__('Recherches par code'), view('admin.chartjs-RechercheParcode', ["choice" => $this->choice])));
            });
        }
        return $content;
    }
}

Admin::script('

    $(document).ready(function() {

    var counters = $(".number");
    var countersQuantity = counters.length;
    var counter = [];

    for (i = 0; i < countersQuantity; i++) {
    counter[i] = parseInt(counters[i].innerHTML);
    }

    var count = function(start, value, id) {
    var localStart = start;
    setInterval(function() {
    if (localStart < value) {
    localStart++;
    counters[id].innerHTML = localStart;
    }
    }, 40);
    }

    for (j = 0; j < countersQuantity; j++) {
    count(0, counter[j], j);
    }
    });');
