<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$type_user = "Suivi_Production|suivi_production|Suivi_Planning|suivi_planning|Controle_Qualite|controle_qualite|Suivi_Commerciale|suivi_Commerciale|Controlleur|controlleur|stock|Stock|Comptabilite|comptabilite|Administrateur|administrateur|commercial|Commercial|Planning|planning|Magasiner|magasiner|Production|production";
/*******************      Administrateur           *******************/
$route["($type_user)/Utilisateur/nouveau"]="Utilisateur/nouveau";
$route["($type_user)/Utilisateur/liste"]="Utilisateur/liste";
$route["($type_user)/Utilisateur/mettre_a_jour/(:any)"]="Utilisateur/detail/$2";
$route["($type_user)/Machine/nouveau"]="Administrateur/nouveauMachine";
$route["($type_user)/Machine/liste"]="Administrateur/listeMachine";
$route["($type_user)/operateur/nouveau"]="Administrateur/nouveauOperateur";
$route["($type_user)/operateur/liste"]="Administrateur/listeOperateur";

$route["($type_user)/Templet/nouveau"]="Administrateur/nouveauOperateur";
$route["($type_user)/Templet/liste"]="Administrateur/listePrixH";
$route["($type_user)/Templet/liste"]="Administrateur/ListePrix";
$route["($type_user)/Templet/Valeur_Matiers"]="Administrateur/Valeur_Matiers";
$route["($type_user)/Templet/Parametre"]="Administrateur/parametrePrixs";
/*******************      Commercial               *******************/
$route["($type_user)/commandeType/(:any)"]="Commerciale/commandeSpecifique/$2";
$route["($type_user)/suivieType/(:any)"]="Suivi_Commerciale/commandeSpecifique/$2";
/*******************      Magasin                 *********************/

$route["($type_user)/deleteMovemenetStock/(:any)/(:any)"]="magasiner/deleteFiniTransac/$2/$3";
/*******************      Utilisateur             ********************/

/******************        All user              *********************/


//$route["($type_user)"] = 'accueil';
$route['default_controller'] = 'Authentification';
$route['404_override'] = '';
$route['Authentification']='authentification';
$route['translate_uri_dashes'] = FALSE;

