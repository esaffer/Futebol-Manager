<h1>Convide um usuário para conhecer o Futebol Manager!</h1>

<?
$rs = $facebook->api_client->fql_query("SELECT uid FROM user WHERE has_added_app=1 and uid IN (SELECT uid2 FROM friend WHERE uid1 = $idUserFacebook)");

$arFriends = "";
if($rs)
{
	$arFriends .= $rs[0]["uid"];
	for ($i = 1; $i < count($rs); $i++)
	{
		if($arFriends != "")
			$arFriends .= ",";
		$arFriends .= $rs[$i]["uid"];
	}
}
$sNextUrl = urlencode("&refuid=".$idUserFacebook);

$invfbml = <<<FBML
<fb:name uid="$idUserFacebook" firstnameonly = "true" shownetwork="false"/> quer convidar voce para o Futebol Manager
FBML;
?>

<fb:request-form type="FutebolManager" action="besta.php" content="<?=htmlentities($invfbml)?>" invite="true">
<fb:multi-friend-selector max="15" actiontext="Aqui estao seus amigos" showborder="true" rows="2" exclude_ids="<?=$arFriends?>">
</fb:request-form>