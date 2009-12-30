<?
/*****************************************************************************
 * Arquivo: index.php
 * Neste arquivo são feitas as chamadas internas do site, mantendo apenas um
 * template. Permitindo assim um desenvolvimento mais rápido e organizado.
 *****************************************************************************/
 
 // Includes necessários ------------------------------------------------------
	include('app/config.php');
	include('app/lib/Utilities.php');
	include('app/lib/Facebook/facebook.php');
	include('app/classes/Database.php');
	include('app/classes/Model.php');
	include('app/classes/User.php')
	//include('app/classes/Team.php');
 
 // Inicializa o Facebook -----------------------------------------------------
	$facebook = new Facebook(FACEBOOK_KEY, FACEBOOK_SECRET);
	$facebook->require_frame();
	$iduser = $facebook->require_login();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br">
<head>
	<title><?= APP_NAME ?></title>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	
	<base href="<?= APP_BASE ?>" />

	<link rel="stylesheet" type="text/css" href="media/css/reset.css" media="all" />
	<link rel="stylesheet" type="text/css" href="media/css/design.css" media="all" />

	<script type="text/javascript" src="media/js/jquery.js"></script>
</head>

<body>
	<div id="site">
		<div id="header">
			<? include('app/views/header.php'); ?>
		</div>
		
		<div id="menu">
			<? include('app/views/menu.php'); ?>
		</div>
		
		<div id="content">
			<? include('app/routes.php'); ?>
		</div>
		
		<div id="ads">
			<? include('app/views/ads.php'); ?>
		</div>
		
		<div id="footer">
			<? include('app/views/footer.php'); ?>
		</div>
	</div>
</body>
</html>
