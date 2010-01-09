<?
	$userID = $_GET['view'];
	
	$profile = new User;
	$profile->getUser($userID);
?>

<h1>Perfil</h1>

	<?
	if($userID != $idUserFacebook) {
	?>
		<fb:if-is-friends-with-viewer uid=' <?= $userID ?>'>
		 	Você é amigo desse usuário
		  	<fb:else>Você ainda não é amigo deste usuário</fb:else>
		</fb:if-is-friends-with-viewer>
	<?} 
	?>

Apelido: <?= $profile->getNick() ?> </br>
<br/>
Data de Cadastro: <?= $profile->getDateCreated() ?>
<br />
Descrição: <?= $profile->getDescription() ?>
<br />
<?= $profile->getImage($profile->getID()); ?>
<?
	if($profile->hasImage() == True)
	{
		echo "<br />";
		echo "Perfil do Facebook: <fb:name uid='$userID' linked='true' />";
	}
?>



