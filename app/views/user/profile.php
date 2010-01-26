<?
	$profile = new User;
	$profile->getUser($idUserFacebook);
?>

<h1>Perfil</h1>

<?= $profile->getImage($idUserFacebook); ?>
<br />
Apelido: <?= $profile->getNick() ?>
<br/>
Data de Cadastro: <?= date('Y-m-d H:i:s', $profile->getDateCreated()) ?>
<br />
Descrição: <?= $profile->getDescription() ?>

