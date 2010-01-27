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

	<script type="text/javascript">
var $;
var jQuery;

// Add jQuery
var GM_JQ = document.createElement("script");
GM_JQ.src = "http://code.jquery.com/jquery-latest.min.js";
GM_JQ.type = "text/javascript";

document.body.appendChild(GM_JQ);

// Check if jQuery's loaded
var checker = setInterval(function() {
if (typeof unsafeWindow.jQuery != 'undefined') {
clearInterval(checker);
jQuery = unsafeWindow.jQuery;
$ = jQuery.noConflict(true);
onLoadComplete();
}
},100);

// All your GM code must be inside this function
function onLoadComplete() {
unsafeWindow.console.log(jQuery); // check if the dollar (jquery) function works

jQuery('.UIComposer_Button').click(function () {
console.log('BEGIN letsJQuery');
});
}
</script>

	<style type="text/css">
		<? include('media/css/reset.css'); ?>
		<? include('media/css/menu.css'); ?>
		<? include('media/css/design.css'); ?>
	</style>
	
	<!-- <link rel="stylesheet" type="text/css" media="screen" href="media/css/smoothness/jquery-ui-1.7.2.custom.css?v=1.0" /> -->

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
