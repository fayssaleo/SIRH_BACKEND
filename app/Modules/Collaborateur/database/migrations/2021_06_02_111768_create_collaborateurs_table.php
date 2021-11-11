<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollaborateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collaborateurs', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("nom",50);
            $table->string("prenom",50);
            $table->string("sexe",6);
            $table->date("birthday");
            $table->string("lieuDeNaissance",50);
            $table->string("nationalite",50);
            $table->string("photo",100)->nullable();
            $table->string("email",50);
            $table->string("telephone",50);
            $table->string("telephoneUrgent",50);
            $table->string("adresse",255);
            $table->integer("enfants");
            $table->string("typeContrat",20);
            $table->string("situationMatrimoniale",50);
            $table->double("salaire");
            $table->string("cnss",100);
            $table->string("rib",30);
            $table->double("soldeConge")->default(0);
            $table->string("cin",20);
            $table->date("dateEmbauche");
            $table->boolean("actif");
            $table->bigInteger('fonction_id')->unsigned();
            $table->foreign('fonction_id')->references('id')->on('fonctions');
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
        Schema::dropIfExists('collaborateurs');
    }
}
