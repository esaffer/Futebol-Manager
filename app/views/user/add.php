<h1>Adicionar Usuário</h1>
<?
	if ($_GET['do'] == 'add') {
		$user = new User;
		$user->setID($idUserFacebook);
		$user->setApelido($_POST['apelido']);		
		$user->setPoints(0);
		$user->setDescricao($_POST['descricao']);
		$user->setDataCadastro();
		$user->Add();
	}
	else {
?>

<form action="?act=user-add&do=add" method="POST">
	<br />
	<label for='apelido'>Apelido:</label>
	<input type="text" id='apelido' name='apelido' />
	<br />
	<label for='descricao'>Descricao:</label>
		<textarea cols=20 rows=5 id='descricao' name='descricao' /></textarea>
	<br />
	<input type='submit' value='Salvar' />
</form>
<? } ?>
