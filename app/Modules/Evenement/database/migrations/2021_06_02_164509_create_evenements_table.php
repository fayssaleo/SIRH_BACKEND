<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvenementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evenements', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("titre",50);
            $table->text("text");
            $table->date("date");
            $table->string("time");
            $table->string("lieu",20);
            $table->string("image",100)->nullable();
            $table->boolean("actif")->default(true);
            $table->string("createdBy",40);
            $table->string("updateddBy",40)->nullable();
            $table->bigInteger('evenements_categorie_id')->unsigned();
            $table->foreign('evenements_categorie_id')->references('id')->on('evenements_categories')
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
        Schema::dropIfExists('evenements');
    }
}
