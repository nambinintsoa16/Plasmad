<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| AUTO-LOADER
| -------------------------------------------------------------------
| This file specifies which systems should be loaded by default.
|
| In order to keep the framework as light-weight as possible only the
| absolute minimal resources are loaded by default. For example,
| the database is not connected to automatically since no assumption
| is made regarding whether you intend to use it.  This file lets
| you globally define which systems you would like loaded with every
| request.
|
| -------------------------------------------------------------------
| Instructions
| -------------------------------------------------------------------
|
| These are the things you can load automatically:
|
| 1. Packages
| 2. Libraries
| 3. Drivers
| 4. Helper files
| 5. Custom config files
| 6. Language files
| 7. Models
|
*/

/*
| -------------------------------------------------------------------
|  Auto-load Packages
| -------------------------------------------------------------------
| Prototype:
|
|  $autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');
|
*/
$autoload['packages'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Libraries
| -------------------------------------------------------------------
| These are the classes located in system/libraries/ or your
| application/libraries/ directory, with the addition of the
| 'database' library, which is somewhat of a special case.
|
| Prototype:
|
|	$autoload['libraries'] = array('database', 'email', 'session');
|
| You can also supply an alternative library name to be assigned
| in the controller:
|
|	$autoload['libraries'] = array('user_agent' => 'ua');
*/
$autoload['libraries'] = array('session','database', 'form_validation', 'email');

/*
| -------------------------------------------------------------------
|  Auto-load Drivers
| -------------------------------------------------------------------
| These classes are located in system/libraries/ or in your
| application/libraries/ directory, but are also placed inside their
| own subdirectory and they extend the CI_Driver_Library class. They
| offer multiple interchangeable driver options.
|
| Prototype:
|
|	$autoload['drivers'] = array('cache');
|
| You can also supply an alternative property name to be assigned in
| the controller:
|
|	$autoload['drivers'] = array('cache' => 'cch');
|
*/
$autoload['drivers'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Helper Files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['helper'] = array('url', 'file');
*/
$autoload['helper'] = array('GestProd','url', 'file', 'html', 'string', 'date');

/*
| -------------------------------------------------------------------
|  Auto-load Config files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['config'] = array('config1', 'config2');
|
| NOTE: This item is intended for use ONLY if you have created custom
| config files.  Otherwise, leave it blank.
|
*/
$autoload['config'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Language files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['language'] = array('lang1', 'lang2');
|
| NOTE: Do not include the "_lang" part of your file.  For example
| "codeigniter_lang.php" would be referenced as array('codeigniter');
|
*/
$autoload['language'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Models
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['model'] = array('first_model', 'second_model');
|
| You can also supply an alternative model name to be assigned
| in the controller:
|
|	$autoload['model'] = array('first_model' => 'first');
*/
$autoload['model'] = [
            'stock_matier_premier_madakem_model'=>'stock_matier_premier_madakem',
            'stock_produit_finis_model'=>'stock_produit_finis',
            'stock_surplus_produit_finis_model'=>'stock_surplus_produit_finis',
            'sachet_coupe_model'=>'sachet_coupe',
            'stock_matier_premier_model'=>'stock_matier_premier',
            'entree_produits_finis_model'=>'entree_produits_finis',
            'sortie_produits_finis_model'=>'sortie_produits_finis',
            'sortie_surplus_finis_model'=>'sortie_surplus_finis',
            'entree_surplus_finis_model'=>'entree_surplus_finis',
            'operateur_model'=>'operateur',
            'machine_model'=>'machine',
            'sachet_extrusion_model'=>'sachet_extrusion',
            'rapport_model'=>'rapport',
            'livraison_model'=>'livraison',
            'controle_qualite_model'=>'controle_qualite',
            'users_model'=>'users',
            'user_fonction_model'=>'user_fonction',
            'global_model'=>'global',
            'logs_model'=>'logs',
            'date_de_livraison_model'=>'date_de_livraison',
            'prixappliquer_model'=>'prix_appiquer',
            'prix_commande_model'=>'prix_commande',
            'stock_dechet_model'=>'stock_dechet',
            'mouvement_recyclage_model'=>"mouvement_recyclage",
            'commande_model'=>'commande',
            'cintre_injection_model'=>'cintre_injection',
            'cintre_hook_model'=>'cintre_hook',
            'stock_gaines_plasmad_model'=>'stock_gaines_plasmad',
            'entree_gaines_model'=>'entree_gaines',
            'dechet_model'=>'dechet',
            'sortie_control_qualite_model'=>'sortie_control_qualite',
            'cintre_impression_model'=>'cintre_impression',
            'sortie_gaines_model'=>'sortie_gaines',
            'verification_matiere_model'=>'verification_matiere',
            'validation_matiere_model'=>'validation_matiere',
            'planning_matiere_utiliser_model'=>'planning_matiere_utiliser',
            'sachet_impression_model'=>'sachet_impression',
            'entree_matiere_premiere_model'=>'entree_matiere_premiere',
            'sortie_matiere_premiere_model'=>'sortie_matiere_premiere',
            'entree_matiere_premiere_madakem_model'=>'entree_matiere_premiere_madakem',
            'sortie_matiere_premiere_madakem_model'=>'sortie_matiere_premiere_madakem',
            'jobcart_sachet_coupe_model'=> 'jobcart_sachet_coupe',
            'matiere_detail_attent_validation_model'=>'matiere_detail_attent_validation',
            'jobcart_sachet_extrusion_model'=> 'jobcart_sachet_extrusion',
            'jobcart_sachet_impression_model'=>'jobcart_sachet_impression',
            'stock_produit_finis_madakem_model'=>"stock_produit_finis_madakem",
            'matiere_impression_use_model'=>'matiere_impression_use',
            'reextrusion_model'=>'reextrusion',
			'wip_entree_gaines_model'=>'wip_entree_gaines',
			'wip_sortie_gaines_model'=>'wip_sortie_gaines',
			'wip_stock_gaines_plasmad_model'=>'wip_stock_gaines_plasmad',

            'wip_entree_gaines_imprimer_model'=>'wip_entree_gaines_imprimer',
			'wip_sortie_gaines_imprimer_model'=>'wip_sortie_gaines_imprimer',
			'wip_stock_gaines_imprimer_plasmad_model'=>'wip_stock_gaines_plasmad_imprimer',

            'stock_deuxieme_choix_plasmad_model'=>'stock_deuxieme_choix_plasmad',
            'livraison_compta_model'=>'livraison_compta'
            ];
