<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSculpturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sculptures', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("admin_user_id")->nullable();
            // $table->foreign("admin_user_id")->references("id")->on(config('admin.database.users_table'))->onDelete('cascade')->onUpdate('cascade');
            $table->string('titre');
            $table->string("longueur");
            $table->string("largeur");
            $table->string("hauteur");
            $table->string("technique_materiaux");
            $table->string("numero_serie");
            $table->year("annee_creation");
            $table->string("origine_oeuvre");
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sculptures');
    }
}
