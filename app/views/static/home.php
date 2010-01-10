<h1>Página Inicial<br><br><br><br><br><br><br><br><br><br></h1>

<?php
	$user = new User;
	
	if($user->getUser($idUserFacebook) == False)
	{
		echo "</br> Você ainda não possuí um perfil </br>";
		echo "</br><a href='?act=user-add'>Crie um agora mesmo!</a>";
		
	}
	else
	{
		
		echo "Parabéns campeão!";
	
	
	}
?>
