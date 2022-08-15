<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbonnementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abonnements', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("admin_user_id");
            $table->foreign("admin_user_id")->references("id")->on('admin_users');
            $table->string('plan');
            $table->string('method_paiement');
            $table->integer('frais_plan');
            $table->date('debut_abonnement')->nullable();
            $table->date('fin_abonnement')->nullable();
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
        Schema::dropIfExists('abonnements');
    }
}
