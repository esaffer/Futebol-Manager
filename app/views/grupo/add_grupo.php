<h1>Adicionar Grupo</h1>
<?
	if ($_GET['do'] == 'add') {
		$grupo = new Team;
		$grupo->setNome($_POST['nome']);		
		$grupo->setLocal($_POST['local']);
		$grupo->setRegras($_POST['regras']);
		if($_POST['priv'] == 'privado')
			$grupo->setPrivado(TRUE);
		else
			$grupo->setPrivado(FALSE);
		$grupo->setDescricao($_POST['descricao']);
		$grupo->setDataCadastro();
		$grupo->setIDOwner($idUserFacebook);
		$grupo->Add();
	}
	else {
?>

<form action="?act=create-grupo&do=add" method="POST">
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
		<input type='radio' name='priv' value='publico' checked>Publico</br>
		<input type='radio' name='priv' value='privado'>Privado</br>		
	<br />
	<input type='submit' value='Salvar' />
</form>
<? } ?>
