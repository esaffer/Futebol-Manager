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
	include('app/classes/User.php');
	include('app/classes/Team.php');
	include('app/classes/UserTeam.php');
	include('app/classes/Game.php');
	include('app/classes/Invite.php');
	include('app/classes/UserGame.php');
	include('app/classes/Warning.php');
 
 // Inicializa o Facebook -----------------------------------------------------
	$facebook = new Facebook(FACEBOOK_KEY, FACEBOOK_SECRET);
	$facebook->require_frame();
	$idUserFacebook = $facebook->require_login();
		
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br">
<head>
	<title><?= APP_NAME ?></title>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	
	<!--
	<base href="<?= APP_BASE ?>" /> 
		Facebook não aceita <base> e nem <body>....
	-->

	<style type="text/css">
		<? include('media/css/reset.css'); ?>
		<? include('media/css/menu.css'); ?>
		<? include('media/css/design.css'); ?>
		<? include('media/css/timepicker_plug/css/style.css'); ?>
		<? include('media/css/smothness/jquery_ui_datepicker.css'); ?>
	</style>

	<script type="text/javascript">
		<? include('media/js/jquery.js'); ?>
		<? include('media/js/jquery_ui_datepicker.js'); ?>
		<? include('media/js/i18n/ui.datepicker-pt-BR.js'); ?>
		<? include('media/js/timepicker_plug/timepicker.js'); ?>
	</script>


</head>
	<? $user = new User;
		if(!($user->getUser($idUserFacebook))) {
		 include('app/views/user/add.php');  // Cria uma conta automaticamente no BD
	}?>
	
	<div id="site">
		<div id="header">
			<? include('app/views/static/header.php'); ?>
		</div>
		
		<div id="container">
			<? include('app/views/static/menu.php'); ?>
		</div>
		
		<div id="content">
			<? include('app/routes.php'); ?>
		</div>
		
		<div id="ads">
			<? include('app/views/static/ads.php'); ?>
		</div>
		
		<div id="footer">
			<? include('app/views/static/footer.php'); ?>
		</div>
	</div>

<? include('app/views/static/analytics.php'); ?>

</html>
