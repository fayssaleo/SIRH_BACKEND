<?php

namespace App\Modules\Evenement\Database\Seeds;

use App\Modules\Evenement\Models\Evenements_Categorie;
use Illuminate\Database\Seeder;

class EvenementCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorie =new Evenements_Categorie;
        $categorie->nom="Séminaire";
        $categorie->couleur="blue";
        $categorie->createdBy="Fayssal";
        $categorie->save();
        //--------------------------------
        $categorie =new Evenements_Categorie;
        $categorie->nom="Conférence";
        $categorie->couleur="red";
        $categorie->createdBy="Fayssal";
        $categorie->save();
        //--------------------------------
        $categorie =new Evenements_Categorie;
        $categorie->nom="Lancement de produit";
        $categorie->couleur="orange";
        $categorie->createdBy="Fayssal";
        $categorie->save();
        //--------------------------------
        $categorie =new Evenements_Categorie;
        $categorie->nom="Team building";
        $categorie->couleur="gray";
        $categorie->createdBy="Fayssal";
        $categorie->save();
        //--------------------------------
        $categorie =new Evenements_Categorie;
        $categorie->nom="Festival";
        $categorie->couleur="green";
        $categorie->createdBy="Fayssal";
        $categorie->save();
        //--------------------------------
        $categorie =new Evenements_Categorie;
        $categorie->nom="Salons ou expositions";
        $categorie->couleur="purple";
        $categorie->createdBy="Fayssal";
        $categorie->save();
        //--------------------------------
        $categorie =new Evenements_Categorie;
        $categorie->nom="Sportifs";
        $categorie->couleur="teal";
        $categorie->createdBy="Fayssal";
        $categorie->save();
        //--------------------------------

    }
}

