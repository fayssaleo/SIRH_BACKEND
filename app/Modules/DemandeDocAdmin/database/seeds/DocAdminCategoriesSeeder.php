<?php

namespace App\Modules\DemandeDocAdmin\Database\Seeds;

use App\Enums\CategorieTypes;
use App\Enums\DOC_ADMIN_CATEGORIES;
use App\Modules\Categorie\Models\Categorie;
use Illuminate\Database\Seeder;

class DocAdminCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorie = new Categorie();
        $categorie->libelle=DOC_ADMIN_CATEGORIES::ATTESTATION_TRAVAIL;
        $categorie->actif=true;
        $categorie->createdBy="Fayssal ourezzouq";
        $categorie->type=CategorieTypes::DOC_ADMIN;
        $categorie->save();

        //-----------------------------------------------------------------

        $categorie = new Categorie();
        $categorie->libelle=DOC_ADMIN_CATEGORIES::CERTIFICAT_TRAVAIL;
        $categorie->actif=true;
        $categorie->createdBy="Fayssal ourezzouq";
        $categorie->type=CategorieTypes::DOC_ADMIN;
        $categorie->save();

        //-----------------------------------------------------------------

        $categorie = new Categorie();
        $categorie->libelle=DOC_ADMIN_CATEGORIES::ATTESTATION_STAGE;
        $categorie->actif=true;
        $categorie->createdBy="Fayssal ourezzouq";
        $categorie->type=CategorieTypes::DOC_ADMIN;
        $categorie->save();

        //-----------------------------------------------------------------

        $categorie = new Categorie();
        $categorie->libelle=DOC_ADMIN_CATEGORIES::ATTESTATION_SALAIRE;
        $categorie->actif=true;
        $categorie->createdBy="Fayssal ourezzouq";
        $categorie->type=CategorieTypes::DOC_ADMIN;
        $categorie->save();

        //-----------------------------------------------------------------

        $categorie = new Categorie();
        $categorie->libelle=DOC_ADMIN_CATEGORIES::AUTRE;
        $categorie->actif=true;
        $categorie->createdBy="Fayssal ourezzouq";
        $categorie->type=CategorieTypes::DOC_ADMIN;
        $categorie->save();

        //-----------------------------------------------------------------
    }
}

