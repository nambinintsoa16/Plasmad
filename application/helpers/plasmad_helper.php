<?php

function breadcrumb($uri){
	$breadcrumb = $uri;
	if (!isset($uri[2]) || !isset($_SESSION["matricule"])) {
		return "";
	}

	if ( $uri[2] != "Compte" ):
		?>

		<nav aria-label="breadcrumb" class="w-100">
			<ol class="breadcrumb">
				<!-- <li class="breadcrumb-item"><a href="<?= base_url("$uri[1]/") ?>">Accueil</a></li> -->
				<?php
				for($i = 2; $i <= count($breadcrumb); $i++){
					if ($i == (count($breadcrumb)) || $i < 3 ):
						?>
						<li class="breadcrumb-item active" aria-current="page"><?= tobreadcrumb($uri[$i]) ?></li>

						<?php

					else:

						$link = [];
						for ($j = $i; $j >= 1 ; $j--) {
							$link[] = $uri[$j];
						}
						$link = implode("/", array_reverse($link));

						?>

						<li class="breadcrumb-item"><a href="<?= base_url("$link") ?>"><?= tobreadcrumb($uri[$i]) ?></a></li>

						<?php
					endif;
				}
				?>
			</ol>
		</nav>
		<?php
	endif;

}

function tobreadcrumb($txt_){
	$txt_ = str_split($txt_);
	$txt = "";
	foreach ($txt_ as $char) {
		if (ord($char) <= 90)  {
			$txt .= " $char";
		}
		else{
			$txt .= "$char";
		}
	}

	$txt = str_replace(".php", "", $txt);
	$txt = str_replace("_", " ", $txt);

	return ucfirst(strtolower(trim($txt)));
}

function code_produit_img_link($code_produit){
	$cd =  str_replace("0", "00", $code_produit);

	$link = base_url("images/produit/poduit_default.jpeg");

	if (file_exists("images/produit/$code_produit.jpg")) {
		$link = base_url("images/produit/$code_produit.jpg");
	}elseif(file_exists("images/produit/$cd.jpg")){
		$link = base_url("images/produit/$cd.jpg");
	}
	return $link;
}

function user($matricule){
	$cd =  str_replace("0", "00", $matricule);

	$link = base_url("images/user/user-mobil.png");

	if (file_exists("images/user/$matricule.jpg")) {
		$link = base_url("images/user/$matricule.jpg");
	}elseif(file_exists("images/user/$cd.jpg")){
		$link = base_url("images/user/$cd.jpg");
	}
	return $link;
}

function type_utilisateur_for_uri($id_designation){
	if ( in_array($id_designation, [1,])) {
		return "Administrateur";
	}	
	if ( in_array($id_designation, [2])) {
		return "Planning";
	}
	if ( in_array($id_designation, [3])) {
		return "Commerciale";
	}
	if ( in_array($id_designation, [4])) {
		return "Production";
	}
	if ( in_array($id_designation, [5])) {
		return "Comptabilite";
	}
	if ( in_array($id_designation, [6])) {
		return "Stock";
	}
	if ( in_array($id_designation, [7])) {
		return "Magasiner";
	}
	if ( in_array($id_designation, [8])) {
		return "Controlleur";
	}
	if ( in_array($id_designation, [9])) {
		return "Suivi_Commerciale";
	}
	if ( in_array($id_designation, [10])) {
		return "Controle_Qualite";
	}
    if ( in_array($id_designation, [11])) {
		return "Suivi_Production";
	}
	if ( in_array($id_designation, [12])) {
		return "Suivi_Planning";
	}
	if ( in_array($id_designation, [13])) {
		return "Recyclage";
	}
}

function naveTitle($title){
		switch ($title) {
				case 'Suivi_Planning':
						$navTitle ="SUIVI PLANNING";
					break;

				case 'Suivi_Production':
						$navTitle ="SUIVI PRODUCTION";
					break;
				case 'Suivi_Commerciale':
						$navTitle ="SUIVI COMMERCIAL";
				break;
        		case 'Controle_Qualite':
						$navTitle ="CONTROLE QUALITE";
				break;  
				case 'Production':
				$navTitle ="PRODUCTION";
				break;
				case 'Planning':
				$navTitle ="PLANNIG";
				break;
				case 'Magasiner':
				$navTitle ="MAGASIN";
				break;
				case 'Comptabilite':
				$navTitle ="COMPTABILITE";
				break;
				case 'Commerciale':
				$navTitle ="COMMERCIALE";
				break;
				case 'Stock':
				$navTitle ="STOCK";
				break;
				case 'Recyclage':
				$navTitle ="RECYCLAGE";
				break;
				default:
				$navTitle = $title;
					break;
		}
  
   return $navTitle;
}

function false($var){
	return $var === FALSE || $var === "null" || $var === 0;
}

function to_autocomplete($array){
	$r = [];

	foreach ($array as $val){
		$r[] = implode(" | ", $val);
	}

	return json_encode($r);
}

function date_fr($date){
	return (new DateTime($date))->format('d/m/Y');
}

function pourcentage($max, $val){
	return ($val * 100) / $max;
}

function mois($num){
	return ["Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"][$num - 1];

}


function jour($num){
	return ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"][$num];
}

function listemois(){
	return ["Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"];

}


function listejour(){
	return ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];
}

