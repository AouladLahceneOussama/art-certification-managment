<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(config('admin.database.users_table'), function (Blueprint $table) {
            $table->renameColumn('name', 'LastName');
            $table->string("FirstName")->nullable();
            $table->date('birth')->nullable();
            $table->text("biography")->nullable();
            $table->string("email")->nullable();
            $table->string("phone")->nullable();
            $table->string("pays")->nullable();
            $table->string("occupation")->nullable();
            $table->string("autre_nom")->nullable();
            $table->text('specialities')->nullable();
            $table->string("coverture_photo")->nullable();
            $table->string("email_token")->nullable();
            $table->string("email_verified")->default(false)->nullable();
            $table->boolean('isActif')->default(false)->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(config('admin.database.users_table'), function (Blueprint $table) {
            $table->dropColumn('naissance');
            $table->renameColumn('LastName', 'name');
            $table->dropColumn("FirstName");
            $table->dropColumn('birth');
            $table->dropColumn("biography");
            $table->dropColumn("email");
            $table->dropColumn("phone");
            $table->dropColumn("pays");
            $table->dropColumn("occupation");
            $table->dropColumn("autre_nom");
            $table->dropColumn("specialities");
            $table->dropColumn("Coverture_photo");
            $table->dropColumn("email_token");
            $table->dropColumn("email_verified");
            $table->dropColumn('isActif');
        });
    }
}
