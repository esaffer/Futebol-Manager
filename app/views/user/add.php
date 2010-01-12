
<?
	$user = new User;
	$user->setID($idUserFacebook);
	$nick = $facebook->api_client->users_getInfo($idUserFacebook, 'name');
	$user->setNick($nick[0]['name']);
	$user->setPoints(0);
	$user->setDescription('');
	$user->setImage('');
	$user->setDateCreated();
	$user->Add();
?>
