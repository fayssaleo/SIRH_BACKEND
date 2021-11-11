<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFonctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fonctions', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("libelle",50);
            $table->text("fichePoste");
            $table->string("createdBy",40);
            $table->string("updatedBy",40)->nullable();
            $table->bigInteger('departement_id')->unsigned();
            $table->foreign('departement_id')->references('id')->on('departements')
            ->onDelete('cascade');
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
        Schema::dropIfExists('fonctions');
    }
}
