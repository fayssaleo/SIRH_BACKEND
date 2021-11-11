<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentJustificatifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_justificatifs', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("filename",50);
            $table->string("libelle",50);
            $table->bigInteger('demande_conge_id')->unsigned();
            $table->foreign('demande_conge_id')->references('id')->on('demande_conges')
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
        Schema::dropIfExists('document_justificatifs');
    }
}
