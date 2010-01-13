<?php 
	$user = new User;
?>
<ul id="navigation-1">
	<li><a href="?act=home">Home</a></li>
	<li><a href="#" title="Usuário">Usuário</a>
		<ul class="navigation-2">
			<?
				echo "<li><a href='?act=user-profile'>Ver Perfil</a></li>";
				echo "<li><a href='?act=user-edit'>Editar Perfil</a></li>";			
				echo "<li><a href='?act=user-all'>Listar Usuários</a></li>";
			?>
		</ul>
	</li>
	<li><a href="#" title="Equipe">Equipe</a>
		<ul class="navigation-2">
			<?
				if($user->getUser($idUserFacebook)) {
					echo "<li><a href='?act=team-add'>Criar novo grupo</a></li>";
					echo "<li><a href='?act=team-user'>Seus Grupos</a></li>";				
				}
			?>			
			<li><a href='?act=team-all'>Listar grupos</a></li>
		</ul>
	</li>
	<li><a href="?act=invite-friends-app">Convide seus amigos!</a></li>
	<li><a href="?act=help">Ajuda</a></li>
</ul>
	

