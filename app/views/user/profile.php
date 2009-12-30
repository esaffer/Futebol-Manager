<?
			$sql	= "CREATE TABLE " . $this->table_name . " (
					id			mediumint(9) NOT NULL AUTO_INCREMENT,
					fid			varchar(64),
					points		mediumint(9),
					position	mediumint(9),
					
					UNIQUE KEY id (id));";
	$db = new Database(DB_USER, DB_PASS, DB_NAME, DB_HOST);
	echo $db->query($sql);
	echo $db->query('show tables;')
?>

