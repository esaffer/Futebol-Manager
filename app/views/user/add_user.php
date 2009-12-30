<h1>Adicionar Usuário</h1>
<?
	if ($_GET['do'] == 'add') {
		echo "Nome: " . $_POST['name'];
		echo "<br/>Facebook: " . $_POST['fid'];
		echo "<br />Points: " . $_POST['points'];
		echo  "<br />Status: " . $_POST['status'];
	}
	else {
?>

<form action="?act=user-add&do=add" method="POST">
	<label for='name'>Nome:</label>
	<input type="text" id='name' name='name' />
	<br />
	<label for='fid'>Facebook ID:</label>
	<input type="text" id='fid' name='fid' />
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
