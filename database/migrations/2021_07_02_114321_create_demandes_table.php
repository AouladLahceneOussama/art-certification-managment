<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            //info perssonel
            $table->string('nom');
            $table->string('prenom');
            $table->string('telephone');
            $table->string('email');
            
            //info d'oeuvre
            $table->string('nom_artist');
            $table->string('titre_oeuvre');
            $table->string('type_oeuvre');

            $table->string("longueur")->nullable();
            $table->string("largeur")->nullable();
            $table->string("hauteur")->nullable();

            $table->string("technique_materiaux")->nullable();
            $table->string("support")->nullable();
            $table->year("annee_creation")->nullable();

            $table->string("Emplacement_signature")->nullable();
            $table->string("numero_serie")->nullable();
            $table->string("code_certificat")->nullable();//unique
            $table->string('statut')->default('En attente');
            $table->string('added')->default('0');

            $table->string('method_paiement');
            $table->integer('frais_demande');
            $table->string('payee')->default('0');
            
            $table->date('created_at');
            $table->date('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demandes');
    }
}
