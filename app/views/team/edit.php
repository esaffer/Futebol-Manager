<h1>Editar Equipe</h1>

<?
	$grupo = new Team;
	
	if (is_null($_GET['id'])) {
		$grupo->messageFail('É necessário informar o ID de uma equipe para editar!');
	}
	else {
	if ($_GET['do'] == 'edit') {
		

		$grupo->setNome($_POST['nome']);
		$grupo->setLocal($_POST['local']);
		$grupo->setRegras($_POST['regras']);

		if ($_POST['priv'] == "privado")
			$grupo->setPrivado(True);
		else
			$grupo->setPrivado(False);
			
		$grupo->setDescricao($_POST['descricao']);
		$grupo->setDataCadastro($_POST['datacadastro']);
		$grupo->setIDOwner($idUserFacebook);
		$grupo->Edit($_POST['id']);
	}
	
	else {
		$grupo->getTeam(30);
?>
			<form action='?act=team-edit&do=edit' method='POST'>
			<br />
			<label for='nome'>Nome:</label>
			<input type='text' id='nome' name='nome' value='<?= $grupo->getNome() ?>' />
			<br />
			<label for='local'>Local:</label>
			<input type='text' id='local' name='local' value='<?= $grupo->getLocal() ?>' />
			<br />
			<label for='descricao'>Descrição:</label>
			<textarea cols=20 rows=5 id='descricao' name='descricao' ><?= $grupo->getDescricao() ?></textarea>
			<br />
			<label for='regras'>Regras:</label>
			<textarea cols=20 rows=5 id='regras' name='regras' ><?= $grupo->getRegras() ?></textarea>
			<br />
				<input type='radio' name='priv' value='publico' <?= ($grupo->getPrivado() == False) ? 'checked' : '' ?>>Publico</br>
				<input type='radio' name='priv' value='privado' <?= ($grupo->getPrivado() == True) ? 'checked' : '' ?>>Privado</br>
			<br />
		     	<input type='hidden' id='datacadastro' name='datacadastro' value='<?=$grupo->getDataCadastro()?>' />
			<input type='hidden' id='id' name='id' value='<?= $grupo->getID() ?>' />
			<input type='submit' value='Salvar' />
			</form>
	<? }} ?>
