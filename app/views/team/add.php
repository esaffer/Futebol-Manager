<h1>Adicionar Equipe</h1>

<?
	if ($_GET['do'] == 'add') {
		$team = new Team;
		$team->setName($_POST['name']);		
		$team->setPlace($_POST['place']);
		$team->setRules($_POST['rules']);
		
		if ($_POST['privative'] == 'true')
			$team->setPrivative(TRUE);
		else
			$team->setPrivative(FALSE);
		$team->setDescription($_POST['description']);
		$team->setDateCreated();
		$team->setImage($_POST['image']);
		$team->setIDOwner($idUserFacebook);
		$team->Add();
	}
	else {
?>

<form action="?act=team-add&do=add" method="POST">
	<label for='name'>Nome:</label>
		<input type="text" id='name' name='name' />
	<br />
	<label for='place'>Local:</label>
		<input type="text" id='place' name='place' />
	<br />
		<label for='image'>Link da imagem:</label>
		<input type="text" id='image' name='image' />
	<br />
	<label for='description'>Descricao:</label>
		<textarea cols=20 rows=5 id='description' name='description' /></textarea>
	<br />
	<label for='rules'>Regras:</label>
		<textarea id='rules' name='rules' /></textarea>
	<br />
		<input type='radio' name='privative' value='false' checked>Publico</br>
		<input type='radio' name='privative' value='true'>Privado</br>
	<br />
	<input type='submit' value='Salvar' />
</form>
<? } ?>
