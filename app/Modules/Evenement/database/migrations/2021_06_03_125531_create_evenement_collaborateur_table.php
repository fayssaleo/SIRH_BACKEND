<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvenementCollaborateurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evenement_collaborateur', function (Blueprint $table) {
            $table->foreignId("evenement_id")->constrained();
            $table->foreignId("collaborateur_id")->constrained();
            $table->string("statut",20)->default("En attente");
            $table->datetime("date")->nullable();
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
        Schema::dropIfExists('evenement_collaborateur');
    }
}
