<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$type_user = 'Commercial|commercial|Production|production|Comptabilite|comptabilite|Stock|
stock|Surplus|surplus|Recyclage|recyclage|Planning|planning|Gaines|gaines|Controlleur|controlleur
|Control_qualite|control_qualite|Responsables_magasin|responsables_magasin|Transit|transit|Finance|finance
Wip|wip|Suivi_commerciale|suivi_commerciale';

//__________________________________________________________________________________
//___________________________________________________________________________accueil

$route["($type_user)"] = 'Accueil/index';

//__________________________________________________________________________________
//________________________________________________________________________commercial

$route["($type_user)/Bon_de_commande/sachets"] = "Commercial/bon_sachets";
$route["($type_user)/Accueil"] = "Commercial/index";
$route["($type_user)/Bon_de_commande/Cintres"]= "Commercial/bon_cintre";
$route["($type_user)/Bon_de_commande/Liste_commande_sachets"]= "Commercial/Liste_commande_sachets";
$route["($type_user)/Bon_de_commande/Liste_commande_cintre"]= "Commercial/Liste_commande_cintre";
$route["($type_user)/Calendrier_de_livraison"]= "Commercial/Calendrier_de_livraison";
$route["($type_user)/Stock/Stock_Produit_fini"]= "Commercial/Stock_Produit_fini";
$route["($type_user)/Stock/Stock_surplus"]= "Commercial/Stock_surplus";
$route["($type_user)/Stock/Stock_matiere_premiere"]= "Commercial/Stock_matiere_premiere";

//__________________________________________________________________________________
//________________________________________________________________________Production

$route["($type_user)/Sachet/Extrusion"]= "Production/sachet_Extrusion";
$route["($type_user)/Sachet/Impression"]= "Production/sachet_impression";
$route["($type_user)/Sachet/Coupe"]= "Production/sachet_coupe";
$route["($type_user)/Sachet/Supprimer_matiere"]= "Production/update_sachet_matiere_impression";
$route["($type_user)/Cintre/Injection"]= "Production/Cintre_Injection";
$route["($type_user)/Cintre/Impression"]= "Production/Cintre_impression";
$route["($type_user)/Cintre/Hook"]= "Production/Cintre_Hook";
$route["($type_user)/Stock_Produit_finis/:(any)"]= "Production/Stock_Produit_finis/$1";
$route["($type_user)/Verification_matieres"]="Production/Verification_matieres";
//__________________________________________________________________________________
//_____________________________________________________________________________Stock
$route["($type_user)/Matiere_premiere/Liste_des_matieres_premieres"]= "Stock/Liste_des_matieres_premieres";
$route["($type_user)/Matiere_premiere/Liste_des_sorties_matieres"]= "Stock/Liste_des_sorties_matieres";
$route["($type_user)/Matiere_premiere/Liste_des_entrees_matieres"]= "Stock/Liste_des_entrees_matieres";
$route["($type_user)/Matiere_premiere/Entree_matiere"]= "Stock/Entree_matiere";
$route["($type_user)/Matiere_premiere/Sortie_matiere"]= "Stock/Sortie_matiere";
$route["($type_user)/Livraison/Entree_livraison"]= "Stock/Entree_livraison";
$route["($type_user)/Livraison/Historique_de_livraison"]= "Stock/Historique_de_livraison";
$route["($type_user)/Produit_fini/Liste_des_produits_finis"]= "Stock/Liste_des_produits_finis";
$route["($type_user)/Produit_fini/Liste_des_entree"]= "Stock/Liste_des_entree";
$route["($type_user)/Produit_fini/Liste_des_sortie"]= "Stock/Liste_des_sortie";
$route["($type_user)/Produit_fini/Entree"]= "Controlleur/entree_produit_fini";
$route["($type_user)/Produit_fini/Entree_gaines"]= "Gaines/Entree";

//__________________________________________________________________________________
//______________________________________________________________________Comptabilite
$route["($type_user)/Matieres_premieres/Stock"]= "Comptabilite/Stock_matieres_premieres";
$route["($type_user)/Matieres_premieres/Entree"]= "Comptabilite/get_entree_stock_matieres";
$route["($type_user)/Matieres_premieres/Echange"]= "Comptabilite/echange_matiere";
$route["($type_user)/Matieres_premieres/Liste_des_entrees"]= "Comptabilite/get_liste_des_entrees";
$route["($type_user)/Matieres_premieres/Liste_des_sortiee"]= "Comptabilite/get_liste_des_sortiee";
$route["($type_user)/Costing"]= "Comptabilite/Costing";

//__________________________________________________________________________________
//___________________________________________________________________________Surplus
$route["($type_user)/Stock/Stock_surplus"]= "Surplus/Stock";
$route["($type_user)/Stock/Entree"]= "Surplus/Entree";
$route["($type_user)/Stock/Liste_des_entrees"]= "Surplus/Liste_des_entrees";
$route["($type_user)/Stock/Sortie"]= "Surplus/Sortie";
$route["($type_user)/Stock/Liste_des_sorties"]= "Surplus/Liste_des_sorties";
$route["($type_user)/Quality_controls/entree"]= "Surplus/entree_control_quality";
$route["($type_user)/Quality_controls/Liste_des_entrees"]= "Surplus/liste_entree_control_quality";
$route["($type_user)/Stock/Sortie_gaines"]= "Surplus/Sortie_gaine";


//__________________________________________________________________________________
//__________________________________________________________________________Planning
$route["($type_user)/Commande/Non_planifiee"]= "Planning/commande_non_planifier";
$route["($type_user)/Commande/Suivie"]= "Planning/commande_suivie";
$route["($type_user)/Commande/Calendrier"]= "Planning/Calendrier_commande";
$route["($type_user)/Job_card/Sachet_extrusion"]= "Planning/Sachet_extrusion";
$route["($type_user)/Job_card/Sachet_impression"]= "Planning/Sachet_impression";
$route["($type_user)/Job_card/Sachet_coupe"]= "Planning/Sachet_coupe";
$route["($type_user)/Commande/Cintre"]= "Commercial/Liste_commande_cintre";
$route["($type_user)/Commande/Sachet"]= "Commercial/Liste_commande_sachets";
$route["($type_user)/Reconciliation/Recap_machine"]= "Planning/Recap_machine";
$route["($type_user)/Reconciliation/Calendrier_de_livraison"]= "Planning/Calendrier_de_livraison";
$route["($type_user)/Reconciliation/Historique_de_livraison"]= "Planning/Historique_de_livraison";
$route["($type_user)/Reconciliation/Suivi_progression"]= "Planning/Suivi_progression";
$route["($type_user)/Stock/Stock_dexieme_choix"]= "Control_qualite/Stock_deuxieme_choix";
$route["($type_user)/Non_planifier"]= "Planning/liste_commande";

//__________________________________________________________________________________
//_______________________________________________________________________Controlleur
$route["($type_user)/Utilisateur/Nouvelle_utilisateur"]="controlleur/createUser";
$route["($type_user)/Utilisateur/Liste_des_utilisateurs"]="controlleur/listUsers";
$route["($type_user)/Suivi_machine/Extrusion"]="controlleur/suivie_machine_extrusion";
$route["($type_user)/Suivi_machine/Impression"]="controlleur/suivie_machine_impression";
$route["($type_user)/Suivi_machine/Coupe"]="controlleur/suivie_machine_coupe";
$route["($type_user)/Suivi_machine/Nouvelle_machine"]="controlleur/Nouvelle_machine";
$route["($type_user)/Suivi_machine/Liste_des_machines"]="controlleur/Liste_des_machines";

$route["($type_user)/Suivi_matiere/Valider_sortie_matiere"]= "controlleur/Valider_sortie_matiere";
$route["($type_user)/Suivi_matiere/Liste_des_matieres_premieres"]= "Stock/Liste_des_matieres_premieres";
$route["($type_user)/Suivi_matiere/Liste_des_sorties_matieres"]= "Stock/Liste_des_sorties_matieres";
$route["($type_user)/Suivi_matiere/Liste_des_entrees_matieres"]= "Stock/Liste_des_entrees_matieres";
$route["($type_user)/Suivi_matiere/Recap_matiere"]= "Controlleur/Recap_matiere";
$route["($type_user)/Suivi_matiere/Recap_sortie_matiere"]= "Controlleur/Recap_sortie_matiere";
$route["($type_user)/Suivi_matiere/Supprimer_entree_matiere"]= "Controlleur/Supprimer_entree_matiere";
$route["($type_user)/Suivi_matiere/Supprimer_sortie_matiere"]= "Controlleur/Supprimer_sortie_matiere";
$route["($type_user)/Suivi_matiere/Init_stock_matieres_premieres"]= "Controlleur/Liste_des_matieres_premieres";
$route["($type_user)/Suivi_matiere/Entree_matiere"]= "Comptabilite/get_entree_stock_matieres";
$route["($type_user)/Suivi_matiere/Echange"]= "Comptabilite/echange_matiere";

$route["($type_user)/Suivi_produit_fini/Liste_des_produits_finis"]= "Stock/Liste_des_produits_finis";
$route["($type_user)/Suivi_produit_fini/Liste_des_entree"]= "Stock/Liste_des_entree";
$route["($type_user)/Suivi_produit_fini/Liste_des_sortie"]= "Stock/Liste_des_sortie";
$route["($type_user)/Suivi_produit_fini/Supprimer_transaction"]= "Controlleur/Supprimer_transaction";

$route["($type_user)/Suivi_produit_fini/Entree"]= "Controlleur/entree_produit_fini";
$route["($type_user)/Suivi_produit_fini/Init_stock_produit_fini"]= "Controlleur/Init_stock_produit_fini";

$route["($type_user)/Suivi_production/Donnee_de_production"]="controlleur/Donnee_de_production";
$route["($type_user)/Suivi_production/Statu_commande"]="controlleur/Statut_commande";
$route["($type_user)/Suivi_production/Encres_et_solvants"]="controlleur/Encres_et_solvants";
$route["($type_user)/Suivi_production/Daily_production_follow_up"]="controlleur/Daily_production_follow_up";

$route["($type_user)/Suivi_production/Sachet_extrusion"]="Production/Sachet_extrusion";
$route["($type_user)/Suivi_production/Sachet_impression"]="Production/Sachet_impression";
$route["($type_user)/Suivi_production/Sachet_coupe"]="Production/Sachet_coupe";

$route["($type_user)/Suivi_surplus/Stock_surplus"]="Surplus/Stock";
$route["($type_user)/Suivi_surplus/Liste_des_entrees_surplus"]="Surplus/Liste_des_entrees";
$route["($type_user)/Suivi_surplus/Liste_des_sorties_surplus"]="Surplus/Liste_des_sorties";

$route["($type_user)/Production/Sachet_extrusion"]="Finance/Sachet_extrusion";
$route["($type_user)/Production/Sachet_impression"]="Finance/Sachet_impression";
$route["($type_user)/Production/Sachet_coupe"]="Finance/Sachet_coupe";


 $route["($type_user)/Recycle/Stock"]="Accueil/recyclage";
 $route["($type_user)/Recycle/Entree"]="Recyclage/Entree";
 $route["($type_user)/Recycle/Liste_des_entrees"]="Recyclage/Liste_des_entrees";
 $route["($type_user)/Recycle/Sortie"]="Recyclage/Sortie";
 $route["($type_user)/Recycle/Liste_des_sorties"]="Recyclage/Liste_des_sorties";

 $route["($type_user)/Planning/Sachet/Extrusion"]="Production/Planning_extrusion";
 $route["($type_user)/Planning/Sachet/Impression"]="Production/Planning_impression";
 $route["($type_user)/Planning/Sachet/Coupe"]="Production/Planning_coupe";

 $route["($type_user)/Operateur/Nouvelle_operateur"]="controlleur/Nouvelle_operateur";
 $route["($type_user)/Operateur/Liste_des_operateurs"]="controlleur/Liste_des_operateurs";

 $route["($type_user)/Prix_appliquer/Nouveau"]="controlleur/Nouveau_Prix_appliquer";
 $route["($type_user)/Prix_appliquer/Liste_des_prix"]="controlleur/Liste_des_prix";
 
//__________________________________________________________________________________
//_______________________________________________________________________________Wip

$route["($type_user)/gaine_plaine/Liste_des_entrees"] ="wip/Liste_des_entrees_gaine_plaine";
$route["($type_user)/gaine_plaine/Liste_des_sorties"] ="wip/Liste_des_sorties_gaine_plaine";
$route["($type_user)/gaine_plaine/Entree"] ="wip/entree_gaine";
$route["($type_user)/gaine_plaine/Sortie"] ="wip/sortie_gaine";
$route["($type_user)/gaine_plaine/Stock"] ="wip/stock_gaine_plaine";


$route["($type_user)/gaine_imprimer/GI_liste_des_entrees"] ="wip/gaine_imprimer_liste_des_entrees_gaine_plaine";
$route["($type_user)/gaine_imprimer/GI_liste_des_sorties"] ="wip/gaine_imprimer_liste_des_sorties_gaine_plaine";
$route["($type_user)/gaine_imprimer/GI_entree"] ="wip/entree_gaine_imprimer";
$route["($type_user)/gaine_imprimer/GI_sortie"] ="wip/sortie_gaine_imprimer";
$route["($type_user)/gaine_imprimer/GI_stock"] ="wip/stock_gaine_imprimer";


//__________________________________________________________________________________
//_________________________________________________________________________Recyclage

//__________________________________________________________________________________
//___________________________________________________________________control_qualite
$route["($type_user)/Quality_controls/Liste_des_entrees"]= "Surplus/liste_entree_control_quality";
$route["($type_user)/Quality_controls/entree"]= "Surplus/entree_control_quality";

$route["($type_user)/Control_qualite/Stock_deuxieme_choix"]="Control_qualite/Stock_deuxieme_choix";
$route["($type_user)/Control_qualite/Entree"]="Control_qualite/Entree";
$route["($type_user)/Control_qualite/Liste_des_entrees"]="Control_qualite/Liste_des_entrees";
$route["($type_user)/Control_qualite/Sortie"]="Control_qualite/Sortie";
$route["($type_user)/Control_qualite/Liste_des_sorties"]="Control_qualite/Liste_des_sorties";
//__________________________________________________________________________________
//_____________________________________________________________________________Route
$route["($type_user)/export_stock_matiere"]= "Stock/export_stock_matiere";
$route["($type_user)/export_entree_stock_matiere"]= "Stock/export_entree_stock_matiere";

//__________________________________________________________________________________
//_____________________________________________________________________________Login




//__________________________________________________________________________________
//___________________________________________________________________________Default

$route['default_controller'] = 'Authentification';
$route['404_override'] = 'Errors/notfound';
$route['translate_uri_dashes'] = FALSE;
