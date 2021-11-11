<?php

namespace App\Modules\Collaborateur\Database\Seeds;

use App\Modules\Collaborateur\Models\Departement;
use App\Modules\Collaborateur\Models\Fonction;
use Illuminate\Database\Seeder;

class DepartementsAndFonctionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departement =new Departement;
        $departement->libelle="Administration";
        $departement->createdBy="Fayssal";
        $departement->save();

        $fonction =new Fonction;
        $fonction->libelle="DGA";
        $fonction->fichePoste="directeur(rice) générale adjointe";
        $fonction->createdBy="fayssal";
        $departement->fonctions()->save($fonction);

        $fonction =new Fonction;
        $fonction->libelle="DGA";
        $fonction->fichePoste="directeur(rice) générale";
        $fonction->createdBy="fayssal";
        $departement->fonctions()->save($fonction);
        //-------------------------------------------------------------

        $departement =new Departement;
        $departement->libelle="Commerciaux";
        $departement->createdBy="Fayssal";
        $departement->save();

        $fonction =new Fonction;
        $fonction->libelle="Marketer";
        $fonction->fichePoste="Chargé(e) du cote de marketing";
        $fonction->createdBy="fayssal";
        $departement->fonctions()->save($fonction);

        $fonction =new Fonction;
        $fonction->libelle="DGA";
        $fonction->fichePoste="directeur(rice)";
        $fonction->createdBy="fayssal";
        $departement->fonctions()->save($fonction);
        //-------------------------------------------------------------

        $departement =new Departement;
        $departement->libelle="Développement";
        $departement->createdBy="Fayssal";
        $departement->save();

        $fonction =new Fonction;
        $fonction->libelle="Backend Developper";
        $fonction->fichePoste="(Laravel - Spring boot)";
        $fonction->createdBy="fayssal";
        $departement->fonctions()->save($fonction);

        $fonction =new Fonction;
        $fonction->libelle="Frontend";
        $fonction->fichePoste="(Vuejs - React js - Angular js)";
        $fonction->createdBy="fayssal";
        $departement->fonctions()->save($fonction);

        $fonction =new Fonction;
        $fonction->libelle="Fullstack";
        $fonction->fichePoste="fontend : Laravel - Spring boot \nbackend : Vuejs - React js - Angular js";
        $fonction->createdBy="fayssal";
        $departement->fonctions()->save($fonction);

        $fonction =new Fonction;
        $fonction->libelle="Mobile";
        $fonction->fichePoste="(Flutter - Android - Swift )";
        $fonction->createdBy="fayssal";
        $departement->fonctions()->save($fonction);
        //-------------------------------------------------------------

        $departement =new Departement;
        $departement->libelle="Qualité";
        $departement->createdBy="Fayssal";
        $departement->save();

        $fonction =new Fonction;
        $fonction->libelle="Testeur(euse)";
        $fonction->fichePoste="(Selenium js)";
        $fonction->createdBy="fayssal";
        $departement->fonctions()->save($fonction);

        //-------------------------------------------------------------

        $departement =new Departement;
        $departement->libelle="Recrutement";
        $departement->createdBy="Fayssal";
        $departement->save();

        $fonction =new Fonction;
        $fonction->libelle="Chargé(e) de communication";
        $fonction->fichePoste="Chargé(e) de communication";
        $fonction->createdBy="fayssal";
        $departement->fonctions()->save($fonction);

        $fonction =new Fonction;
        $fonction->libelle="Chargé(e) de recrutement";
        $fonction->fichePoste="Chargé(e) de recrutement";
        $fonction->createdBy="fayssal";
        $departement->fonctions()->save($fonction);

        //-------------------------------------------------------------

        $departement =new Departement;
        $departement->libelle="Help desk";
        $departement->createdBy="Fayssal";
        $departement->save();

        $fonction =new Fonction;
        $fonction->libelle="Help desk";
        $fonction->fichePoste="Help desk";
        $fonction->createdBy="fayssal";
        $departement->fonctions()->save($fonction);



        //-------------------------------------------------------------
    }
}

