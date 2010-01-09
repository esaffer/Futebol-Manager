<h1>Lista de Usuários</h1>

<?php
	$user = new User;
	$sql = $user->getAllUsers();
	if($sql == False) {
		echo "Não há nenhum usuário cadastrado!";
	}
	else{
		echo "Usuários: </br>";
		foreach($sql as $id){
				echo "<a href='?act=user-view-profile&view=$id->id'> $id->nick </a> </br>";
		}
	}
?>
