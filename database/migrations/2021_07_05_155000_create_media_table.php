<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger("lito_id")->nullable();
            $table->foreign("lito_id")->references("id")->on("litos");
            $table->unsignedBigInteger("tableau_id")->nullable();
            $table->foreign("tableau_id")->references("id")->on("tableaus");
            $table->unsignedBigInteger("sculpture_id")->nullable();
            $table->foreign("sculpture_id")->references("id")->on("sculptures");
            $table->unsignedBigInteger("demande_id")->nullable();
            $table->foreign("demande_id")->references("id")->on("demandes");
            $table->string("image");
            $table->string("tag");
            $table->string("intitule");
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
        Schema::dropIfExists('media');
    }
}
