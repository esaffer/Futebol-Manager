<?
	/*************************************************************************
	 * Este arquivo organiza e seta o roteamento das urls do site. Para criar
	 * um novo roteamento, basta adicionar a dupla endereço e arquivo.
	 *************************************************************************/
	
	$urls = array (
		'profile'	=> 'user/profile.php',
		'help'		=> 'static/help.php',
		'user-add'	=> 'user/add_user.php',
		'sql'		=> 'user/sql.php',
	);
	
	
	/*****************************************************
	 * Verifica se o endereço está no array, senão,
	 * linka para a página inicial.
	 * TODO: Linkar para uma página de erro 404.
	 *****************************************************/
	if (array_key_exists($_GET['act'], $urls))
		$link = $urls[$_GET['act']];
	else
		$link = 'home.php';
		
	include("app/views/" . $link);
?>
