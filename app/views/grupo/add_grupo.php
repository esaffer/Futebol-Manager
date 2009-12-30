<h1>Adicionar Grupo</h1>
<?
	if ($_GET['do'] == 'add') {
		$user = new Team;
		$user->setNome($_POST['nome']);		
		$user->setLocal($_POST['local']);
		$user->setRegras($_POST['regras']);
		if($_POST['priv'] == 'privado')
			$user->setPrivado(TRUE);
		else
			$user->setPrivado(FALSE);
		$user->setDescricao($_POST['descricao']);
		$user->setDataCadastro();
		$user->Add();
	}
	else {
?>

<form action="?act=user-add&do=add" method="POST">
	<label for='nome'>Nome:</label>
	<input type="text" id='nome' name='nome' />
	<br />
	<label for='local'>Local:</label>
	<input type="text" id='local' name='local' />
	<br />
	<label for='descricao'>Descricao:</label>
		<textarea cols=20 rows=5 id='descricao' name='descricao' /></textarea>
	<br />
	<label for='regras'>Regras:</label>
		<textarea cols=20 rows=5 id='regras' name='regras' /></textarea>
	<br />
		<input type='radio' name='priv' value='privado'>Privado</br>
		<input type='radio' name='priv' value='publico' checked>Publico</br>
	<br />
	<input type='submit' value='Salvar' />
</form>
<? } ?>
