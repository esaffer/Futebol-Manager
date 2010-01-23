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
	<?
		echo "<br><br>";	
	} 
	?>

Apelido: <?= $profile->getNick() ?>
<br/>
Data de Cadastro: <?= date('Y-m-d H:i:s',$profile->getDateCreated()) ?>
<br />
Descrição: <?= ($profile->getDescription() == "") ? " <b> Nenhuma descrição! </b>" : $profile->getDescription() ?>
<br />
<br />
<?= $profile->getImage($profile->getID()); ?>
<?
	if($profile->hasImage() == True)
	{
		echo "<br />";
		echo "Perfil do Facebook: <fb:name uid='$userID' linked='true' />";
	}
?>



