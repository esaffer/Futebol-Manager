<h1>Adicionar Usuário</h1>
<?
	if ($_GET['do'] == 'add') {
		$user = new User;
		$user->setName($_POST['apelido']);
		$user->setFacebook($_POST['fid']);
		$user->setStatus($_POST['status']);
		$user->setPoints($_POST['points']);
		$user->Add();
	}
	else {
?>

<form action="?act=user-add&do=add" method="POST">
	<label for='name'>Apelido:</label>
	<input type="text" id='apelido' name='name' />
	<br />
	<label for='fid'>Facebook ID:</label>
	<input type="text" id='id' name='fid' />
	<br />
	<label for='fid'>Points:</label>
	<input type="text" id='points' name='points' />
	<br />
	<label for='fid'>Status:</label>
	<select name='status' id='status'>
		<option value='1'>Ativo</option>
		<option value='0'>Desativado</option>
	</select>
	<br />
	<input type='submit' value='Salvar' />
</form>
<? } ?>
