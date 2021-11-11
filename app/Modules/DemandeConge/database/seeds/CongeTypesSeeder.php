<?php

namespace App\Modules\DemandeConge\Database\Seeds;

use App\Enums\CategorieTypes;
use App\Modules\Categorie\Models\Categorie;
use App\Modules\DemandeConge\Models\TypeConge;
use Illuminate\Database\Seeder;

class CongeTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorie = new Categorie();
        $categorie->libelle="Mariage";
        $categorie->actif=true;
        $categorie->createdBy="Fayssal ourezzouq";
        $categorie->type=CategorieTypes::CONGE;
        $categorie->save();

        $typeConge =new TypeConge;
        $typeConge->name="Du collaborateur";
        $typeConge->nombreDeJours=4;
        $typeConge->actif=1;
        $categorie->typeConges()->save($typeConge);

        $typeConge =new TypeConge;
        $typeConge->name="D'enfant du collaborateur";
        $typeConge->nombreDeJours=2;
        $typeConge->actif=1;
        $categorie->typeConges()->save($typeConge);

        //------------------------------------------------------

        $categorie = new Categorie();
        $categorie->libelle="Maternité";
        $categorie->actif=true;
        $categorie->createdBy="Fayssal ourezzouq";
        $categorie->type=CategorieTypes::CONGE;
        $categorie->save();

        $typeConge =new TypeConge;
        $typeConge->name="Maternité";
        $typeConge->nombreDeJours=98;
        $typeConge->actif=1;
        $categorie->typeConges()->save($typeConge);



        //------------------------------------------------------
    }
}

