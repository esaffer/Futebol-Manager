<?php 
	$user = new User;
?>

<ul>
	<li><a href="?act=home">Home</a></li>
	<li>Usuário
		<ul>
		<?
			if($user->getUser($idUserFacebook)) {
				echo "<li><a href='?act=user-profile'>Ver Perfil</a></li>";
				echo "<li><a href='?act=user-edit'>Editar Perfil</a></li>";			
			}
			else {
				echo "<li><a href='?act=user-add'>Criar Perfil</a></li>";
			}
		?>
			<li><a href='?act=user-all'>Listar usuários</a></li>
		</ul>
	</li>

	<li>Equipe
		<ul>
		<?
			if($user->getUser($idUserFacebook)) {
				echo "<li><a href='?act=team-add'>Criar novo grupo</a></li>";
				echo "<li><a href='?act=team-edit'>Editar um grupo</a></li>";	
				echo "<li><a href='?act=team-user'>Seus Grupos</a></li>";				
			}
		?>			
			<li><a href='?act=team-all'>Listar grupos</a></li>
		</ul>
	</li>

	<li><a href="?act=past-games">Jogos Passados</a></li>
	<li><a href="?act=invite-friends-app">Convide seus amigos!</a></li>
	<li><a href="?act=ranking">Ranking</a></li>
	<li><a href="?act=help">Ajuda</a></li>
</ul>

