<?
	/*************************************************************************
	 * Este arquivo organiza e seta o roteamento das urls do site. Para criar
	 * um novo roteamento, basta adicionar a dupla endereço e arquivo.
	 *************************************************************************/
	
	$urls = array (
		// STATIC PAGES --------------------------------
		'help'			=> 'static/help.php',

		// USER ----------------------------------------
		'user-profile'	=> 'user/profile.php',
		'user-add'		=> 'user/add.php',
		'user-edit'		=> 'user/edit.php',

		// TEAM -----------------------------------------
		'team-add'		=> 'team/add.php',
		'team-all'		=> 'team/all.php',
		'team-view' 	=> 'team/index.php',
		'team-edit'		=> 'team/edit.php',
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
