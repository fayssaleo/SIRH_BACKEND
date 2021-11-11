<?php

namespace App\Modules\Utilisateur\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriviligesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('privileges')->insert([
            [
            'id' => 1,
            'name' => 'evenements_consulter',
        ],
        [
            'id' => 2,
            'name' => 'evenements_ajouter',
        ],
        [
            'id' => 3,
            'name' => 'evenements_modifier',
        ],
        [
            'id' => 4,
            'name' => 'evenements_supprimer',
        ],
        [
            'id' => 5,
            'name' => 'actualites_consulter',
        ],
        [
            'id' => 6,
            'name' => 'actualites_ajouter',
        ],
        [
            'id' => 7,
            'name' => 'actualites_modifier',
        ],
        [
            'id' => 8,
            'name' => 'actualites_supprimer',
        ],
        [
            'id' => 9,
            'name' => 'actualites_desactiver',
        ],
        [
            'id' => 10,
            'name' => 'collaborateurs_ajouter',
        ],
        [
            'id' => 11,
            'name' => 'collaborateurs_modifier',
        ],
        [
            'id' => 12,
            'name' => 'collaborateurs_archiver',
        ],
        [
            'id' => 13,
            'name' => 'collaborateurs_consulter_tous',
        ],
        [
            'id' => 14,
            'name' => 'collaborateurs_consulter_presque_tous',
        ],
        [
            'id' => 15,
            'name' => 'collaborateurs_consulter_les_profils',
        ],
        [
            'id' => 16,
            'name' => 'collaborateurs_gerer_ses_documents',
        ],
        [
            'id' => 17,
            'name' => 'collaborateurs_gerer_documents_des_autres',
        ],
        [
            'id' => 18,
            'name' => 'collaborateurs_gerer_departements_fonctions',
        ],
        [
            'id' => 19,
            'name' => 'conges_deposer_demande',
        ],
        [
            'id' => 20,
            'name' => 'conges_accepter_refuser_demande',
        ],
        [
            'id' => 21,
            'name' => 'documents_deposer_demande',
        ],
        [
            'id' => 22,
            'name' => 'documents_accepter_refuser_demande',
        ],
        [
            'id' => 23,
            'name' => 'bibliotheque_consulter',
        ],
        [
            'id' => 24,
            'name' => 'bibliotheque_ajouter',
        ],
        [
            'id' => 25,
            'name' => 'bibliotheque_telecharger',
        ],
        [
            'id' => 26,
            'name' => 'bibliotheque_supprimer',
        ],
        [
            'id' => 27,
            'name' => 'habilitation_consulter',
        ],
        [
            'id' => 28,
            'name' => 'habilitation_ajouter',
        ],
        [
            'id' => 29,
            'name' => 'habilitation_modifier',
        ],
        [
            'id' => 30,
            'name' => 'habilitation_supprimer',
        ]
        ]);
    }
}

