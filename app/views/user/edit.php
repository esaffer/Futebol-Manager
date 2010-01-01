<h1>Editar perfil</h1>
<?
	if ($_GET['do'] == 'edit') {
		$user = new User;
		$user->setID($idUserFacebook);
		$user->setApelido($_POST['apelido']);		
		$user->setPoints($_POST['pontos']);
		$user->setDescricao($_POST['descricao']);
		$user->setDataCadastro($_POST['datacadastro']);
		$user->Edit($idUserFacebook);
	}
	else {
		$profile = new User;
		$profile->getUser($idUserFacebook);
?>
		<form action='?act=user-edit&do=edit' method='POST'>
		<br />
		<label for='apelido'>Apelido:</label>
		<input type='text' id='apelido' name='apelido' value='<?= $profile->getApelido() ?>' />
		<br />
		<label for='descricao'>Descrição:</label>
		<textarea cols=20 rows=5 id='descricao' name='descricao' ><?= $profile->getDescricao() ?></textarea>
		<br />
		<input type='hidden' id='datacadastro' name='datacadastro' value='<?= $profile->getDataCadastro() ?>' />
		<input type='hidden' id='pontos' name='pontos' value='<?= $profile->getPoints() ?>' />
		<input type='submit' value='Salvar' />
		</form>
<? } ?>
