<!DOCTYPE html>
<html lang="fr">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>PLASMAD</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="<?= base_url("assets/img/icon.png") ?>" type="image/x-icon" />
	<link rel="stylesheet" type='text/css' href="<?= base_url("assets/font-awesome/css/font-awesome.css") ?>">
	<link rel='stylesheet' type='text/css' href="<?= base_url("assets/css/main.min.css") ?>">
	<link rel='stylesheet' type='text/css' href="<?= base_url("assets/css/main.css") ?>">
	<link rel='stylesheet' type='text/css' href="<?= base_url("assets/css/jquery-ui.css") ?>">
	<link rel='stylesheet' type='text/css' href="<?= base_url("assets/css/jquery-ui.structure.css") ?>">
	<link rel='stylesheet' type='text/css' href="<?= base_url("assets/css/jquery-confirm.min.css") ?>">
	<link rel='stylesheet' type='text/css' href="<?= base_url("assets/css/style.css") ?>">
	<style>
		.fileUpload {
			position: relative;
			overflow: hidden;
			margin: 10px;
		}

		.fileUpload input.upload {
			position: absolute;
			top: 0;
			right: 0;
			margin: 0;
			padding: 0;
			font-size: 20px;
			cursor: pointer;
			opacity: 0;
			filter: alpha(opacity=0);
		}

	
	</style>
	<script src="<?= base_url("assets/js/plugin/webfont/webfont.min.js") ?>"></script>
	<script>
		var link_base = "<?php echo base_url() ?>";
		WebFont.load({
			google: {
				"families": ["Lato:300,400,700,900"]
			},
			custom: {
				"families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
				urls: [link_base + 'assets/css/fonts.min.css']
			},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	<link rel="stylesheet" href="<?= base_url("assets/css/bootstrap.min.css") ?>">
	<?php if (isset($uri[1]) && ($uri[1] != 'authentification' || $uri[1] != 'authentification')) : ?>
		<link rel="stylesheet" type='text/css' href="<?= base_url("assets/css/atlantis.min.css") ?>">
		<link rel="stylesheet" type='text/css' href="<?= base_url("assets/css/demo.css") ?>">
	<?php else : ?>
		<link href="<?= base_url("assets/css/login.css") ?>" rel="stylesheet" type="text/css" />
	<?php endif ?>
</head>
<!-- <body data-background-color="dark"> -->

<body>