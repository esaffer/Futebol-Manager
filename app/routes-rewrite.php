<?
	/*************************************************************************
	 * Este arquivo organiza e seta o roteamento das urls do site. Para criar
	 * um novo roteamento, basta adicionar a dupla endereço e arquivo.
	 *************************************************************************/
	
	$urls = array (
		'profile/'	=> 'user/profile.php',
		'help/'		=> 'static/help.php',
	);
	
	
	/*****************************************************
	 * Verifica se o endereço está no array, senão,
	 * linka para a página inicial.
	 * TODO: Linkar para uma página de erro 404.
	 *****************************************************/
	if ((isset($_GET['route'])) and (array_key_exists($_GET['route'], $urls)))
		$link = $urls[$_GET['route']];
	else
		$link = 'home.php';
	
	include("app/views/" . $link);
?>
