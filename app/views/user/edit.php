<h1>Editar perfil</h1>
<hr />
<?
	if ($_GET['do'] == 'edit') {
		$user = new User;
		$user->setID($idUserFacebook);
		if($_POST['nick'] == "")
		{	
			$nick = $facebook->api_client->users_getInfo($idUserFacebook, 'name');
			$user->setNick($nick[0]['name']);	
		} 
		else
		{
			$user->setNick($_POST['nick']);	
		}	
		$user->setPoints($_POST['points']);
		$user->setDescription($_POST['description']);
		$user->setDateCreated($_POST['date_created']);
		$user->setImage($_POST['image']);
		$user->Edit($idUserFacebook);
		
		echo "<a href='?act=user-view-profile&view=$idUserFacebook'><br>Voltar ao perfil</a>";
	}
	else {
		$profile = new User;
		$profile->getUser($idUserFacebook);
?>
		<form action='?act=user-edit&do=edit' method='POST'>
			<br />
			<label for='nick'>Apelido:</label>
			<input type='text' id='nick' name='nick' value='<?= $profile->getNick() ?>' />
			<br />
			<label for='image'>Link da Imagem:</label>
			<input type='text' id='image' name='image' value='<?= $profile->getImageSrc() ?>' />
			<br />
			<label for='description'>Descrição:</label>
			<textarea cols=20 rows=5 id='description' name='description' ><?= $profile->getDescription() ?></textarea>
			<br />
			<input type='hidden' id='date_created' name='date_created' value='<?= $profile->getDateCreated() ?>' />
			<input type='hidden' id='points' name='points' value='<?= $profile->getPoints() ?>' />
			<input type='submit' value='Salvar' />
		</form>
<? } ?>
