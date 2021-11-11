<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandeDocAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demande_doc_admins', function (Blueprint $table) {
            $table->increments("id");
            $table->dateTime("dateDemande");
            $table->dateTime("dateValidation")->nullable();
            $table->string("statut",20)->default("En attente");
            $table->string("traiteePar",50)->nullable();
            $table->string("autre",50)->nullable();
            $table->text("msg")->nullable();
            $table->text("feedback_msg")->nullable();
            $table->bigInteger('collaborateur_id')->unsigned();
            $table->foreign('collaborateur_id')->references('id')->on('collaborateurs')
                ->onDelete('cascade');
            $table->bigInteger('categorie_id')->unsigned();
            $table->foreign('categorie_id')->references('id')->on('categories')
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
        Schema::dropIfExists('demande_doc_admins');
    }
}
