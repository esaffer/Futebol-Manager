<h1>Adicionar Usuário</h1>
<?
	if ($_GET['do'] == 'add') {
		$user = new User;
		$user->setID($_POST['id']);
		$user->setApelido($_POST['apelido']);		
		$user->setPoints($_POST['points']);
		$user->setDescricao($_POST['descricao']);
		$user->setDataCadastro();
		$user->Add();
	}
	else {
?>

<form action="?act=user-add&do=add" method="POST">
	<label for='id'>Facebook ID:</label>
	<input type="text" id='id' name='id' />
	<br />
	<label for='apelido'>Apelido:</label>
	<input type="text" id='apelido' name='apelido' />
	<br />
	<label for='points'>Points:</label>
	<input type="text" id='points' name='points' />
	<br />
	<label for='descricao'>Descricao:</label>
		<textarea cols=20 rows=5 id='descricao' name='descricao' /></textarea>
	<br />
	<input type='submit' value='Salvar' />
</form>
<? } ?>
