<h1>Adicionar Usuário</h1>

<?
	if ($_GET['do'] == 'add') {
		$user = new User;
		$user->setID($idUserFacebook);
		$user->setNick($_POST['nick']);		
		$user->setPoints(0);
		$user->setDescription($_POST['description']);
		$user->setImage($_POST['image']);
		$user->setDateCreated();
		$user->Add();
	}
	else {
?>

<form action="?act=user-add&do=add" method="POST">
	<label for='nick'>Apelido:</label>
	<input type="text" id='nick' name='nick' />
	<br />
	<label for='image'>Link da imagem:</label>
	<input type="text" id='image' name='image' />
	<br />
	<label for='description'>Descricao:</label>
		<textarea cols=20 rows=5 id='description' name='description' /></textarea>
	<br />
	<input type='submit' value='Salvar' />
</form>
<? } ?>
