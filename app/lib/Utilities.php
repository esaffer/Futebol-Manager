<?
	function isEmpty($s) {
		return ($s == "") ? TRUE : FALSE;
	}



	function notEmpty($s) {
		return ($s != "") ? TRUE : FALSE;
	}



	function onlyString($s) {
		return ((is_numeric($s) == FALSE) && (is_string($s) == TRUE)) ? TRUE : FALSE;
	}
?>
