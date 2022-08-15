<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("admin_user_id")->nullable();
            $table->unsignedBigInteger("lito_id")->nullable();
            $table->foreign("lito_id")->references("id")->on("litos");
            $table->unsignedBigInteger("tableau_id")->nullable();
            $table->foreign("tableau_id")->references("id")->on("tableaus");
            $table->unsignedBigInteger("sculpture_id")->nullable();
            $table->foreign("sculpture_id")->references("id")->on("sculptures");
            $table->string('code_certificat');
            $table->date('date_egalisation');
            $table->string('lieu_egalisation');
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
        Schema::dropIfExists('certificats');
    }
}
