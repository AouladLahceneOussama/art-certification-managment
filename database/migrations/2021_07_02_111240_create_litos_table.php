<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLitosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('litos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("admin_user_id")->nullable();
            // $table->foreign("admin_user_id")->references("id")->on(config('admin.database.users_table'))->onDelete('cascade')->onUpdate('cascade');
            $table->string("titre");
            $table->year("annee_creation");
            $table->string("longueur");
            $table->string("largeur");
            $table->string("technique_materiaux");
            $table->string("support");
            $table->string("numero_serie");
            $table->string("Emplacement_signature");
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
        Schema::dropIfExists('litos');
    }
}
