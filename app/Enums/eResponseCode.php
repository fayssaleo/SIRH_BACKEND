<?php

namespace App\Enums;

use DevcorpIt\ResponseCode\Http\Enum\eBaseResponseCode;

abstract class eResponseCode extends eBaseResponseCode
{

    /*
     * examples :
     * de 00 à 04 sont réservés pour les actions suivants, tout autre action nécessite un code supérieur à 04
     * const S_LISTED_200_00 = ['S200_00' => 'Sheets succèsfully listed']; 00 -> pour lister
     * const S_GET_200_01 = ['S200_01' => 'Sheet returned succèssfully'];  01 -> retourner un element
     * const S_GET_200_01x1 = ['S200_01x1' => 'Sheet returned succèssfully']; 01xN -> attention à utiliser uniquement si pour le même code on a des variantes, le même example peut être appliquer sur les autres codes
     * const S_CREATED_200_02 = ['S200_02' => 'Sheet succèsfully created'];02 -> créer element
     * const S_UPDATED_200_03 = ['S200_03' => 'Sheet succèsfully updated'];03 -> mettre à jour
     * const S_DELETED_200_04 = ['S200_04' => 'Sheet succèsfully deleted'];04 -> supprimer un element
     *
     */

    // Utilisateur
    const USER_PROFILE_INFO_200_01 = ['USER200_01' => 'Logged in Informations'];
    const USER_LOGGED_IN_200_02 = ['USER200_02' => 'Connexion réussie'];
    const USER_LOGGED_OUT_200_03 = ['USER200_03' => 'Déconnexion réussie'];
    const USER_LOGGED_VALIDATE_EMAIL_200_04 = ['USER200_04' => 'Veuillez valider votre email'];
    const USER_LOGGED_401_01 = ['USER401_01' => 'Email ou Mot de passe incorrect'];
    const USER_LOGGED_401_02 = ['USER401_02' => 'Token Invalid'];
    const USER_LOGGED_INFOS_NOT_ACCEPTED_406_00=["USER406_00"=>"Login informatios non acceptable"];
    const USER_LOGGED_REGISTERED_200_05=["USER406_05"=>"L'utilisateur a été enregistrer avec succés"];


    // Departelent
    const DEP_LISTED_200_00=["DEP200_00"=>"Departements listées avec succés"];
    const DEP_GET_200_01=["DEP200_01"=>"Departement renvoyé avec succés"];
    const DEP_STORED_200_02=["DEP200_02"=>"Departement enregistré avec succés"];
    const DEP_UPDATED_200_03=["DEP200_03"=>"Departement modifié avec succés"];
    const DEP_DELETED_200_04=["DEP200_04"=>"Departement supprimé avec succés"];
    const DEP_FONCTS_LIST_200_05=["DEP200_05"=>"Departement fonctions listées avec succés"];
    const DEP_NOT_FOUND_404_00=["DEP404_00"=>"Departement introuvable"];
    const DEP_NOT_ACCEPTED_406_00=["DEP406_00"=>"Departement informatios non acceptable"];

    // Fonction
    const FONCT_LISTED_200_00=["FONCT200_00"=>"Fonctions listées avec succés"];
    const FONCT_GET_200_01=["FONCT200_01"=>"Fonctions renvoyé avec succés"];
    const FONCT_STORED_200_02=["FONCT200_02"=>"Fonctions enregistré avec succés"];
    const FONCT_UPDATED_200_03=["FONCT200_03"=>"Fonctions modifié avec succés"];
    const FONCT_DELETED_200_04=["FONCT200_04"=>"Fonctions supprimé avec succés"];
    const FONCT_DEPS_LIST_200_05=["FONCT200_05"=>"Fonctions departement listées avec succés"];
    const FONCT_NOT_FOUND_404_00=["FONCT404_00"=>"Fonctions introuvable"];
    const FONCT_NOT_ACCEPTED_406_00=["FONCT406_00"=>"Fonctions informatios non acceptable"];
    const FONCT_HAVE_COLL_406_01=["FONCT406_01"=>"cette fonction est liée à un ou plusieurs collaborateurs"];

    // Collaborateur
    const COLL_LISTED_200_00=["COLL200_00"=>"Collaborateurs listées avec succés"];
    const COLL_GET_200_01=["COLL200_01"=>"Collaborateur renvoyé avec succés"];
    const COLL_STORED_200_02=["COLL200_02"=>"Collaborateur enregistré avec succés"];
    const COLL_UPDATED_200_03=["COLL200_03"=>"Collaborateur modifié avec succés"];
    const COLL_DELETED_200_04=["COLL200_04"=>"Collaborateur supprimé avec succés"];
    const COLL_DISABLED_200_05=["COLL200_05"=>"Collaborateur désactivé avec succés"];
    const COLL_ENABLED_200_06=["COLL200_06"=>"Collaborateur activé avec succés"];
    const COLL_NOT_FOUND_404_00=["COLL404_00"=>"Collaborateurs introuvable"];
    const COLL_NOT_ACCEPTED_406_00=["COLL406_00"=>"Collaborateurs informatios non acceptable"];
    const COLL_FOLDER_LINK_407_00=["COLL407_00"=>"lien du Dossier Photos est bien envoyé"];

    // Type_Conges
    const TCONG_LISTED_200_00=["TCONG200_00"=>"Type congés listées avec succés"];
    const TCONG_GET_200_01=["TCONG200_01"=>"Type congés renvoyé avec succés"];
    const TCONG_STORED_200_02=["TCONG200_02"=>"Type congés enregistré avec succés"];
    const TCONG_UPDATED_200_03=["TCONG200_03"=>"Type congés modifié avec succés"];
    const TCONG_DISABLED_200_04=["TCONG200_04"=>"Type congés désactivé avec succés"];
    const TCONG_ENABLED_200_04=["TCONG200_04"=>"Type congés activé avec succés"];
    const TCONG_DISABLED_200_05=["TCONG200_05"=>"Type congés désactivé avec succés"];
    const TCONG_NOT_FOUND_404_00=["TCONG404_00"=>"Type congés introuvable"];
    const TCONG_NOT_ACCEPTED_406_00=["TCONG406_00"=>"Type congés informatios non acceptable"];

    // DemandeConge
    const DCONG_LISTED_200_00=["DCONG200_00"=>"Demande de congé listées avec succés"];
    const DCONG_GET_200_01=["DCONG200_01"=>"Demande de congé renvoyé avec succés"];
    const DCONG_STORED_200_02=["DCONG200_02"=>"Demande de congé enregistré avec succés"];
    const DCONG_UPDATED_200_03=["DCONG200_03"=>"Demande de congé modifié avec succés"];
    const DCONG_DISABLED_200_05=["DCONG200_05"=>"Demande de congé désactivé avec succés"];
    const DCONG_NOT_FOUND_404_00=["DCONG404_00"=>"Demande de congé introuvable"];
    const DCONG_NOT_ACCEPTED_406_00=["DCONG06_00"=>"Demande de congé informatios non acceptable"];
    const DCONG_DELETED_200_04=["DCONG200_04"=>"Demande de congé supprimé avec succés"];
    const DCONG_ACCEPTED_207_00=["DCONG207_00"=>"Demande de congé acceptée avec succés"];
    const DCONG_REJECTED_208_00=["DCONG207_00"=>"Demande de congé refusée avec succés"];
    const DCONG_REJECTED_209_00=["DCONG207_00"=>"Demande de congé feed msg modifé avec succés"];

    // TypeCongeCategories
    const TCGCAT_LISTED_200_00=["CAT200_00"=>"type congé categories listées avec succés"];
    const TCGCAT_GET_200_01=["CAT200_01"=>"Type congé categorie renvoyé avec succés"];
    const TCGCAT_STORED_200_02=["CAT200_02"=>"Type congé categorie enregistré avec succés"];
    const TCGCAT_UPDATED_200_03=["CAT200_03"=>"Type congé categorie modifié avec succés"];
    const TCGCAT_ENABLED_200_06=["TCGCAT200_04"=>"Type congé categorie activé avec succés"];
    const TCGCAT_DISABLED_200_05=["CAT200_05"=>"Type congé categorie désactivé avec succés"];
    const TCGCAT_TYPES_LISTED_200_07=["CAT200_07"=>"Conge type de categorie listées avec succés"];
    const TCGCAT_NOT_ACCEPTED_406_00=["TCGCAT406_00"=>"Type congé categorie informatios non acceptable"];
    const TCGCAT_NOT_FOUND_404_00=["TCGCAT404_00"=>"Type congé categorie introuvable"];

    // Roles
    const ROL_LISTED_200_00=["ROL200_00"=>"Roles listées avec succés"];
    const ROL_GET_200_01=["ROL200_01"=>"Role renvoyé avec succés"];
    const ROL_STORED_200_02=["ROL200_02"=>"Role enregistré avec succés"];
    const ROL_UPDATED_200_03=["ROL200_03"=>"Role modifié avec succés"];
    const ROL_DELETED_200_04=["ROL200_04"=>"Role supprimé avec succés"];
    const ROL_SET_PRIVILEGES_200_05=["ROL200_05"=>"les privileges de ce role sont editer avec succés"];
    const ROL_NOT_ACCEPTED_406_00=["ROL406_00"=>"Role informatios non acceptable"];
    const ROL_NOT_FOUND_404_00=["ROL404_00"=>"Role introuvable"];


    //Demande documents Admins
    const DDA_LISTED_200_00=["DDA200_00"=>"Demande des documents listées avec succés"];
    const DDA_GET_200_01=["DDA200_01"=>"demande de document renvoyé avec succés"];
    const DDA_STORED_200_02=["DDA200_02"=>"demande de document enregistré avec succés"];
    const DDA_UPDATED_200_03=["DDA200_03"=>"demande de document modifié avec succés"];
    const DDA_DELETED_200_04=["DDA200_04"=>"demande de document supprimé avec succés"];
    const DDA_NOT_FOUND_404_00=["DDA404_00"=>"demande de document introuvable"];
    const DDACAT_NOT_FOUND_404_01=["DDACAT404_00"=>"type de document introuvable"];
    const DDACOLL_NOT_FOUND_404_02=["DDACATCOLL404_00"=>"collaborateur introuvable"];
    const DDA_NOT_ACCEPTED_406_00=["DDA406_00"=>"demande de document informatios non acceptable"];
    const DDA_ACCEPTED_207_00=["DDA207_00"=>"Demande de document acceptée avec succés"];
    const DDA_REJECTED_208_00=["DDA207_00"=>"Demande de document refusée avec succés"];
    const DDA_REJECTED_209_00=["DDA207_00"=>"Demande de document feed msg modifé avec succés"];
    const DDA_FILE_DOWNLOADED_210_00=["DDA207_00"=>"Demande de document feed msg modifé avec succés"];

    // Evenement
    const EVNT_LISTED_200_00=["EVNT200_00"=>"Evenements listés avec succés"];
    const EVNT_GET_200_01=["EVNT200_01"=>"Evenement  renvoyé avec succés"];
    const EVNT_STORED_200_02=["EVNT200_02"=>"Evenement  enregistré avec succés"];
    const EVNT_UPDATED_200_03=["EVNT200_03"=>"Evenement modifié avec succés"];
    const EVNT_DELETED_200_04=["EVNT200_04"=>"Evenement  supprimé avec succés"];
    const EVNT_CAT_LIST_200_05=["EVNT200_05"=>"Evenement categorie listée avec succés"];
    const EVNT_NOT_FOUND_404_00=["EVNT404_00"=>"Evenement  introuvable"];
    const EVNT_NOT_ACCEPTED_406_00=["EVNT406_00"=>"Evenement  informatios non acceptable"];
    const EVNT_DISABLED_200_06=["EVNT200_06"=>"Evenement désactivé avec succés"];
    const EVNT_ENABLED_200_07=["EVNT200_07"=>"Evenement activé avec succés"];

    // Evenement categories
    const ECAT_LISTED_200_00=["ECAT200_00"=>"Evenement categories listés avec succés"];
    const ECAT_GET_200_01=["ECAT200_01"=>"Evenement categorie renvoyé avec succés"];
    const ECAT_STORED_200_02=["ECAT200_02"=>"Evenement categorie enregistré avec succés"];
    const ECAT_UPDATED_200_03=["ECAT200_03"=>"Evenement categories modifié avec succés"];
    const ECAT_DELETED_200_04=["ECAT200_04"=>"Evenement categorie supprimé avec succés"];
    const ECAT_EVNT_LIST_200_05=["ECAT200_05"=>"Evenement categories evenements listées avec succés"];
    const ECAT_NOT_FOUND_404_00=["ECAT404_00"=>"Evenement categorie introuvable"];
    const ECAT_NOT_ACCEPTED_406_00=["ECAT406_00"=>"Evenement categorie informatios non acceptable"];
    const ECAT_FOLDER_LINK_407_00=["ECAT407_00"=>"lien du Dossier evenet images est bien envoyé"];

    // Actualités
    const ACT_LISTED_200_00=["ACT200_00"=>"Actualité listés avec succés"];
    const ACT_GET_200_01=["ACT200_01"=>"Actualité  renvoyé avec succés"];
    const ACT_STORED_200_02=["ACT200_02"=>"Actualité  enregistré avec succés"];
    const ACT_UPDATED_200_03=["ACT200_03"=>"Actualité modifié avec succés"];
    const ACT_DELETED_200_04=["ACT200_04"=>"Actualité  supprimé avec succés"];
    const ACT_CAT_LIST_200_05=["ACT200_05"=>"Actualité categories listée avec succés"];
    const ACT_NOT_FOUND_404_00=["ACT404_00"=>"Actualité  introuvable"];
    const ACT_NOT_ACCEPTED_406_00=["ACT406_00"=>"Actualité  informatios non acceptable"];
    const ACT_DISABLED_200_06=["ACT200_06"=>"Actualité désactivé avec succés"];
    const ACT_ENABLED_200_07=["ACT200_07"=>"Actualité activé avec succés"];
    const ACT_FOLDER_LINK_407_00=["ACT407_00"=>"lien du Dossier event images est bien envoyé"];


    // Evenement categories
    const ACAT_LISTED_200_00=["ACAT200_00"=>"actualité categories listés avec succés"];
    const ACAT_GET_200_01=["ACAT200_01"=>"actualité categorie renvoyé avec succés"];
    const ACAT_STORED_200_02=["ACAT200_02"=>"actualité categorie enregistré avec succés"];
    const ACAT_UPDATED_200_03=["ACAT200_03"=>"actualité categories modifié avec succés"];
    const ACAT_DELETED_200_04=["ACAT200_04"=>"actualité categorie supprimé avec succés"];
    const ACAT_ACT_LIST_200_05=["ACAT200_05"=>"actualité categories actualites listées avec succés"];
    const ACAT_NOT_FOUND_404_00=["ACAT404_00"=>"actualité categorie introuvable"];
    const ACAT_NOT_ACCEPTED_406_00=["ACAT406_00"=>"actualité categorie informatios non acceptable"];

    // Documents categories
    const DCAT_LISTED_200_00=["DCAT200_00"=>"document categories listés avec succés"];
    const DCAT_GET_200_01=["DCAT200_01"=>"document categorie renvoyé avec succés"];
    const DCAT_STORED_200_02=["DCAT200_02"=>"document categorie enregistré avec succés"];
    const DCAT_UPDATED_200_03=["DCAT200_03"=>"document categories modifié avec succés"];
    const DCAT_DELETED_200_04=["DCAT200_04"=>"document categorie supprimé avec succés"];
    const DCAT_DOC_LIST_200_05=["DCAT200_05"=>"document categories actualites listées avec succés"];
    const DCAT_NOT_FOUND_404_00=["DCAT404_00"=>"document categorie introuvable"];
    const DCAT_NOT_ACCEPTED_406_00=["DCAT406_00"=>"document categorie informatios non acceptable"];

    // Actualités
    const DOC_LISTED_200_00=["DOC200_00"=>"Documents listés avec succés"];
    const DOC_GET_200_01=["DOC200_01"=>"Document renvoyé avec succés"];
    const DOC_STORED_200_02=["DOC200_02"=>"Document enregistré avec succés"];
    const DOC_DELETED_200_04=["DOC200_04"=>"Document supprimé avec succés"];
    const DOC_NOT_FOUND_404_00=["DOC404_00"=>"Document introuvable"];
    const DOC_NOT_ACCEPTED_406_00=["DOC406_00"=>"Document informatios non acceptable"];
    const DOC_FOLDER_LINK_407_00=["DOC407_00"=>"lien du Dossier event images est bien envoyé"];
}
