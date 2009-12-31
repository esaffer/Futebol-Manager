<?
/*****************************************************************************
 *                            Futebol Manager                                *
 *****************************************************************************
 * Classe com helpers para gerar código HTML
 *
 * Autor:	Bruno Martins Rodrigues <bruno@thearmpit.net>
 *			Eduardo Saffer Medvedovsk <emedevas@gmail.com>
 *			Tiago Henrique Trojahn <troid16@gmail.com>
 *
 * Data:	21 de Dezembro de 2009
 *****************************************************************************/

class Helper {
	function Link ($text, $url, $target = '_blank') {
		echo "<a href='$url' target='$target'>$text</a>";
	}



	function Image ($image, $text) {
		echo "<img src='$image' alt='$text' />";
	}
}
?>
