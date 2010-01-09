<?
	/*************************************************************************
	 * Este arquivo organiza e seta o roteamento das urls do site. Para criar
	 * um novo roteamento, basta adicionar a dupla endereço e arquivo.
	 *************************************************************************/
	
	$urls = array (
		// STATIC PAGES --------------------------------
		'help'			=> 'static/help.php',
		'create-tables'	=> 'create_tables.php',

		// USER ----------------------------------------
		'user-profile'		=> 'user/profile.php',
		'user-add'		=> 'user/add.php',
		'user-edit'		=> 'user/edit.php',
		'user-view-profile'	=> 'user/view-profile.php',
		'user-all'		=> 'user/list-all.php',

		// TEAM -----------------------------------------
		'team-add'		=> 'team/add.php',
		'team-all'		=> 'team/list-team.php',
		'team-view-profile'	=> 'team/view-profile.php',
		'team-edit'		=> 'team/edit.php',
		'team-user'		=> 'team/list-user.php',
		
		//GAME
		'create-game'		=> 'game/add.php',
		'game-edit'		=> 'game/edit.php',
		
		//INVITE
		'invite-friends-app'		=> 'invite/add_app.php',
		'invite-friend'			=> 'invite/control_invite_app.php',
		//INVITE DE AMIGOS QUE JÁ USAM O APP
		'invite-friends-team'		=> 'invite/add_team.php',
		'invite-friends-team-user'	=> 'invite/control_invite_friend_team_user.php',
		
		//NAO POSSUEM O APP
		'invite-friends-team-not-user'	=> 'invite/control_invite_friend_team_not_user.php',
	
	);
	
	/*****************************************************
	 * Verifica se o endereço está no array, senão,
	 * linka para a página inicial.
	 * TODO: Linkar para uma página de erro 404.
	 *****************************************************/
	if (array_key_exists($_GET['act'], $urls))
		$link = $urls[$_GET['act']];
	else
		$link = 'static/home.php';
		
	include("app/views/" . $link);
?>
