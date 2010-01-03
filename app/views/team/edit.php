<h1>Editar Equipe</h1>

<?
	$team = new Team;
	
	if (is_null($_GET['id'])) {
		$team->messageFail('É necessário informar o ID de uma equipe para editar!');
	}
	else {
	if ($_GET['do'] == 'edit') {
		

		$team->setName($_POST['name']);
		$team->setPlace($_POST['place']);
		$team->setRules($_POST['rules']);

		if ($_POST['privative'] == "true")
			$team->setPrivative(TRUE);
		else
			$team->setPrivative(FALSE);
			
		$team->setDescription($_POST['description']);
		$team->setDateCreated($_POST['date_created']);
		$team->setIDOwner($idUserFacebook);
		$team->setImage($_POST['image']);
		$team->Edit($_POST['id']);
	}
	
	else {
		$team->getTeam($_GET['id']);
?>
			<form action='?act=team-edit&do=edit' method='POST'>
			<br />
			<label for='name'>Nome:</label>
			<input type='text' id='name' name='name' value='<?= $team->getName() ?>' />
			<br />
			<label for='local'>Local:</label>
			<input type='text' id='place' name='place' value='<?= $team->getPlace() ?>' />
			<br />
			<label for='image'>Link da imagem:</label>
			<input type='text' id='image' name='image' value='<?= $team->getImageSrc() ?>' />
			<br />
			<label for='description'>Descrição:</label>
			<textarea id='description' name='description' ><?= $team->getDescription() ?></textarea>
			<br />
			<label for='rules'>Regras:</label>
			<textarea id='rules' name='rules' ><?= $team->getRules() ?></textarea>
			<br />
				<input type='radio' name='privative' value='false' <?= ($team->getPrivative() == False) ? 'checked' : '' ?>>Público</br>
				<input type='radio' name='privative' value='true' <?= ($team->getPrivative() == True) ? 'checked' : '' ?>>Privado</br>
			<br />
		     	<input type='hidden' id='date_created' name='data_created' value='<?=$team->getDateCreated()?>' />
			<input type='hidden' id='id' name='id' value='<?= $team->getID() ?>' />
			<input type='submit' value='Salvar Modificações' />
			</form>
	<? }} ?>
