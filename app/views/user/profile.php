<?
	$profile = new User;
	$profile->getUser($idUserFacebook);
?>

<h1>Perfil</h1>

<?= $profile->getImage(); ?>
<br />
Apelido: <?= $profile->getNick() ?>
<br/>
Data de Cadastro: <?= $profile->getDateCreated() ?>
<br />
Descrição: <?= $profile->getDescription() ?>

