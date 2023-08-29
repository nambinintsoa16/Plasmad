<?php

function breadcrumb($uri)
{
	$breadcrumb = $uri;
	if (!isset($uri[2]) || !isset($_SESSION["matricule"])) {
		if (strtolower(trim($uri[1])) == 'authentification') {

			return '';
		} else {
			return '<div class=p-0 m-0 w-100">
					<ol class="breadcrumb"  style=" box-shadow: 0px 2px #ddd;">
						<li><i class="fa fa-home"></i><a href="index.html">' . ucwords($uri[1]) . '</a></li>
					</ol></div>';
		}
	}

?>
	<div class="p-0 m-0 w-100 shadow">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><?= ucwords($uri[1]) ?></li>
			<?php
			for ($i = 2; $i <= count($breadcrumb); $i++) {
				if ($i == count($breadcrumb)) :
			?>
					<li class="breadcrumb-item"><a href="#"><?= tobreadcrumb($uri[$i]) ?></a></li>
				<?php
				elseif ($i < 3) :
				?>
					<li class="breadcrumb-item"><?= tobreadcrumb($uri[$i]) ?></li>
				<?php
				else :

					$link = [];
					for ($j = $i; $j >= 1; $j--) {
						$link[] = $uri[$j];
					}
					$link = implode("/", array_reverse($link));

				?>
					<li class="breadcrumb-item"><a href="#"><?= tobreadcrumb($uri[$i]) ?></a></li>
			<?php
				endif;
			}
			?>
		</ol>
	</div>
<?php

}

function tobreadcrumb($txt_)
{
	$txt_ = str_split($txt_);
	$txt = "";
	foreach ($txt_ as $char) {
		if (ord($char) <= 90) {
			$txt .= " $char";
		} else {
			$txt .= "$char";
		}
	}

	$txt = str_replace(".php", "", $txt);
	$txt = str_replace("_", " ", $txt);

	return ucfirst(strtolower(trim($txt)));
}


function js_link($type_user, $uri)
{

	if (file_exists("assets/js/" . ucwords($type_user) . "/" . $uri . ".js")) {
		$link = base_url("assets/js/" . ucwords($type_user) . "/" . $uri . ".js");
	} else {
		$link = "";
	}
	return $link;
}

function user_img_link($user)
{
	$cd =  str_replace("0", "00", $user);
	$link = base_url("/images/default_user.png");
	if (file_exists("images/users/$user.jpg")) {
		$link = base_url("images/users/$user.jpg");
	} elseif (file_exists("images/users/$cd.jpg")) {
		$link = base_url("images/users/$cd.jpg");
	}
	return $link;
}


function dateDuJour()
{
	return "&nbsp;" . jour(date('N')) . " " . date('d') . " " . mois(date('m')) . " " . date('Y');
}

function service($parametre)
{

	switch ($parametre) {
		case 'COMMERCIAL':
			$designation = "PLASMAD &nbsp; SERVICE COMMERCIAL";
			break;
		case 'COMPTABILITE':
			$designation = "PLASMAD &nbsp; SERVICE COMPTABILITE";
			break;
		case 'PRODUCTION':
			$designation = "PLASMAD &nbsp; SERVICE PRODUCTION";
			break;
		case 'STOCK':
			$designation = "PLASMAD &nbsp; SERVICE STOCK";
			break;
		case 'SURPLUS':
			$designation = "PLASMAD &nbsp; SERVICE SURPLUS";
			break;
		case 'PLANNING':
			$designation = "PLASMAD &nbsp; SERVICE PLANNING";
			break;
		case 'GAINES':
			$designation = "PLASMAD &nbsp; STOCK GAINES";
			break;
		case 'RECYCLAGE':
			$designation = "PLASMAD &nbsp; SERVICE RECYCLAGE";
			break;
		case 'CONTROLLEUR':
			$designation = "PLASMAD &nbsp; CONTROLLEUR";
			break;
		case 'CONTROL_QUALITE':
			$designation = "PLASMAD &nbsp; CONTROL QUALITE";
			break;
		case 'RESPONSABLES_MAGASIN':
			$designation = "PLASMAD &nbsp; RESPONSABLES MAGASIN";
			break;
		case 'TRANSIT':
			$designation = "PLASMAD &nbsp; APPUREMENT";
			break;
		case 'FINANCE':
				$designation = "PLASMAD &nbsp; FINANCE";
			break;	
		case 'SUIVI_COMMERCIALE':
				$designation = "PLASMAD &nbsp; SUIVI COMMERCIAL";
		break;
		case 'WIP':
				$designation = "PLASMAD &nbsp; WIP";
		break;
		default:
			$designation = "";
			break;
	}

	return $designation;
}
function type_utilisateur_for_uri($requette)
{

	switch ($requette) {
		case 1:
			$designation = "Commercial";
			break;
		case 2:
			$designation = "Production";
			break;
		case 3:
			$designation = "Comptabilite";
			break;
		case 4:
			$designation = "Stock";
			break;
		case 5:
			$designation = "Surplus";
			break;
		case 6:
			$designation = "Planning";
			break;
		case 7:
			$designation = "Recyclage";
			break;
		case 8:
			$designation = "Gaines";
			break;
		case 9:
			$designation = "Controlleur";
			break;
		case 10:
			$designation = "Control_qualite";
			break;
		case 11:
			$designation = "Responsables_magasin";
			break;
		case 12:
			$designation = "Transit";
			break;
		case 13:
			$designation = "Finance";
			break;	
		case 14:
			$designation = "Suivi_commerciale";
			break;	
		case 15:
			$designation = "Wip";
			break;		
		default:
			# code...
			break;
	}
	return  $designation;
}


function false($var)
{
	return $var === FALSE || $var === "null" || $var === 0;
}

function to_autocomplete($array)
{
	$r = [];

	foreach ($array as $val) {
		$r[] = implode(" | ", $val);
	}

	return json_encode($r);
}

function date_fr($date)
{
	return (new DateTime($date))->format('d/m/Y');
}

function pourcentage($max, $val)
{
	return ($val * 100) / $max;
}
function get_moth_null_param()
{
	return ["Janvier", "Férvier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"];
}

function get_moth($num)
{
	return ["Janvier", "Férvier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"][$num - 1];
}
function mois()
{
	return ["Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"];
}
function jour($num)
{
	return ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"][$num];
}

function get_date_jour()
{
	$dt = new DateTime();
	$date = $dt->format('N');
	return  jour($date - 1) . " " . date('d') . " " . get_moth((int)date('m')) . " " . date("Y");
}
