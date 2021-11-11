<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentPersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_personnels', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("filename",50);
            $table->string("libelle",50);
            $table->bigInteger('collaborateur_id')->unsigned();
            $table->foreign('collaborateur_id')->references('id')->on('collaborateurs')
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
        Schema::dropIfExists('document_personnels');
    }
}
