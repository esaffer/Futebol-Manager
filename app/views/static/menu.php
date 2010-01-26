<?php 
	$user = new User;
?>
<ul class='menu'>
	<li><a href="?act=home">Home</a></li>
	
	<li><a href="#" title="Usuário">Usuário</a>
		<ul>
			<li><a href='?act=user-profile'>Ver Perfil</a></li>
			<li><a href='?act=user-edit'>Editar Perfil</a></li>	
			<li><a href='?act=user-all'>Listar Usuários</a></li>
		</ul>
	</li>
	
	<li><a href="#" title="Equipe">Equipe</a>
		<ul>
			<li><a href='?act=team-add'>Criar novo grupo</a></li>
			<li><a href='?act=team-all'>Listar grupos</a></li>
		</ul>
	</li>

	<li><a href='?act=team-user'>Seus Grupos</a>
	<?
		$list_owner_team = new Team;
		$owner = $list_owner_team->getListTeamOwner($idUserFacebook);
		$list_team = new UserTeam;
		$member= $list_team->getListUser($idUserFacebook);
		if ($owner == True || $member == True){
	?>
			<ul>
		<?
			if ($owner == True){
				foreach($owner as $id_team){
					echo "<li><a href='?act=team-view-profile&view=$id_team->id'> $id_team->name </a></li>";
				}
			}
			if ($member == True){
				foreach($member as $id_team2){
					$teamaux = new Team;
					$teamaux->getTeam($id_team2->idTeam);
					echo "<li><a href='?act=team-view-profile&view=".$teamaux->getID()."'>".$teamaux->getName()."</a></li>";
				}
			}
		}
		?>
			</ul>
	</li>

	<li><a href="?act=invite-friends-app">Convide seus amigos!</a></li>
	<li><a href="?act=help">Ajuda</a></li>
</ul>
	

