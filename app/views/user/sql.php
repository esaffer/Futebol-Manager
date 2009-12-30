<?
	$db = new Database(DB_USER, DB_PASS, DB_NAME, DB_HOST);
	$sql = "select * from futebol_data_user;";
	$db->query($sql);
	$sql = $db->get_results();
	
	print_r($sql);
?>
