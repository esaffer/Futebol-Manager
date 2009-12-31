<h1>Editar perfil</h1>
<?
	if ($_GET['do'] == 'edit') {
		$user = new User;
		$user->getUser($idUserFacebook);
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
		
		echo "<form action='?act=edit-user-profile&do=edit' method='POST'>";
		echo "<br />";
		echo "<label for='apelido'>Apelido:</label>";
		echo "<input type='text' id='apelido' name='apelido' value='{$profile->getApelido()}' />";
		echo "<br />";
		echo "<label for='descricao'>Descricao:</label>";
	echo "<textarea cols=20 rows=5 id='descricao' name='descricao' >{$profile->getDescricao()}</textarea>";
		echo "<br />";
		echo "<input type='hidden' id='datacadastro' name='datacadastro' value='{$profile->getDataCadastro()}' />";
		echo "<input type='hidden' id='pontos' name='pontos' value='{$profile->getPoints()}' />";
		echo "<input type='submit' value='Salvar' />";
		echo "</form>";
} 
?>
