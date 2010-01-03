<?
/*****************************************************************************
 *                            Futebol Manager
 *****************************************************************************
 * Arquivo de configuração do aplicativo Facebook.
 *
 * Autor:	Bruno Martins Rodrigues <bruno@thearmpit.net>
 *			Eduardo Saffer Medvedovsk <emedevas@gmail.com>
 *			Tiago Henrique Trojahn <troid16@gmail.com>
 *
 * Data:	21 de Dezembro de 2009
 ****************************************************************************/


/****************************************************************************
 * Facebook
 ****************************************************************************/
	define('APP_NAME', 'Futebol Manager');
	define('APP_VERSION', '0.1');
	define('APP_BASE', '');

	define('FACEBOOK_SECRET', 'beedd0119d65a99b69411bee442c89aa');
	define('FACEBOOK_KEY', '50f3cf7661b8f5611eb7b782d845ae8d');


/****************************************************************************
 * Banco de Dados
 ****************************************************************************/
	define('DB_USER', 'tiago');
	define('DB_PASS', '');
	define('DB_HOST', 'localhost');
	define('DB_NAME', 'tiago');
	define('DB_PREFIX', 'futebol_');


/****************************************************************************
 * Diretórios do Aplicativo
 ****************************************************************************/
	define('MEDIA_PATH', APP_BASE . 'media/');
	define('MEDIA_CSS', MEDIA_PATH . 'css/');
	define('MEDIA_JS', MEDIA_PATH . 'js/');
	define('MEDIA_IMG', MEDIA_PATH . 'img/');


/****************************************************************************
 * Configurações gerais
 ****************************************************************************/
	define('IMG_MAXSIZE', '');
	define('IMG_WIDTH', '');
	define('IMG_HEIGHT', '');


/****************************************************************************
 * Tabela das classes
 ****************************************************************************/
	define('DB_TABLE_USERS', DB_PREFIX . 'users');
	define('DB_TABLE_TEAM', DB_PREFIX . 'teams');
	define('DB_TABLE_USERTEAM', DB_PREFIX . 'usersteams');
	define('DB_TABLE_GAME', DB_PREFIX . 'games');
?>
