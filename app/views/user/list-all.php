<h1>Lista de Usuários</h1>
<hr />
<?
	$user = new User;
	
	echo "</ br>Procurar usuários </ br> </ br>";
	?>
	<form action='?act=user-all&do=search' method="POST">
		<label for='name'>Digite o nome do usuário:</label>
		<input type='text' id='name' name='name' />
		<input type='submit' value='Procurar'>
	<br />
	<?
	
	if($_GET['do'] == 'search' && $_POST['name'] != "")
	{
		$users = $user->getListSearch($_POST['name']);
		if($users == False) {
			echo "<br><br> Nenhum usuário encontrado!<br>";
			return;
		}
		else {
			echo "<br> Encontrados os seguintes usuários:<br>";
			foreach ($users as $u) {					
					echo "<br><a href='?act=user-view-profile&view=" . $u->id . "'>". $u->nick . "</a>";
			}		
		}	
	}
	else {	
		$users = $user->getAllUsers();
		if($users == False) {
			echo "<br><br> Nenhum usuário encontrado!<br>";
			return;
		}
		else {
			foreach ($users as $u) {					
					echo "<br><a href='?act=user-view-profile&view=" . $u->id . "'>". $u->nick . "</a>";
			}		
		}	
	}


/*
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
				echo "	<td>" . $u->getImage() . "</td>";
				echo "	<td><a href='?act=user-view-profile&view=" . $u->id . ">". $u->nick . "</a></td>";
				echo "	<td>" . $u->points ."</td>";
				echo "</tr>";
		}
	?>
			</tbody>
		</table>

	}

	*/
?>

