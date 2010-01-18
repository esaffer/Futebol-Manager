<h1>Lista de Usuários</h1>

<?
	$user = new User;
	$users = $user->getAllUsers();
	
	if ($users == False) {
		echo $user->messageFail('Não há nenhum usuário cadastrado!');
	}
	else {
	?>
		<table>
			<thead>
			<tr>
				<td>Foto</td>
				<td>Nome</td>
				<td>Pontos</td>
			</tr>
			</thead>
			
			<tbody>
	<?
		foreach ($users as $u) {
				echo "<tr>";
				echo "	<td>" . $u->getImage() . "</td>"
				echo "	<td><a href='?act=user-view-profile&view=" . $u->id . ">". $u->nick . "</a></td>";
				echo "	<td>" . $u->points ."</td>";
				echo "</tr>"
		}
	?>
			</tbody>
		</table>
	<?
	}
	?>
