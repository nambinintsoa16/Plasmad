<!DOCTYPE html>
<html lang="fr">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta charset="UTF-8">
	<title>GEST-PROD</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="<?=base_url("assets/images/icon.png")?>" type="image/x-icon"/>
	<link rel="stylesheet" href="<?=base_url("assets/font-awesome/css/font-awesome.css")?>">
	<link rel="stylesheet" href="<?=base_url("assets/css/style.css")?>">
	<script src="<?=base_url("assets/js/plugin/webfont/webfont.min.js")?>"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ["<?=base_url('assets/css/fonts.min.css')?>"]},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	<link rel="stylesheet" href="<?=base_url("assets/css/bootstrap.min.css")?>">
	<?php if (isset($uri[1]) && ( $uri[1]== 'authentification' || $uri[1]== 'Authentification') ):?>
		<link href="<?=base_url("assets/css/login.css")?>" rel="stylesheet" type="text/css" />
	<?php else:?>
		<link rel="stylesheet" href="<?=base_url("assets/css/atlantis.min.css")?>">
		<link rel="stylesheet" href="<?=base_url("assets/css/jquery-ui.css")?>">
		<link rel="stylesheet" href="<?=base_url("assets/css/jquery-confirm.min.css")?>">
		<link rel='stylesheet' href="<?=base_url("assets/css/main.css")?>">
		<link rel='stylesheet' href="<?=base_url("assets/css/jquery-ui.structure.css")?>">
		<link rel="stylesheet" href="<?=base_url("assets/css/fullcalendar.css")?>">
		<link rel="stylesheet" href="<?=base_url("assets/css/fullcalendar.print.css")?>">
		<link rel="stylesheet" href="<?=base_url("assets/css/rowReorder.dataTables.min.css")?>">
		<link rel="stylesheet" href="<?=base_url("assets/css/buttons.dataTables.min.css")?>">
		<link rel="stylesheet" href="<?=base_url("assets/js/plugin/lightbox2/dist/css/lightbox.min.css")?>">
	<?php endif ?>
</head>

<!-- <body data-background-color="dark"> -->
<body>
