<h1>Convide um usuário para conhecer o Futebol Manager!</h1>
<hr />
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
<fb:name uid="$idUserFacebook" firstnameonly = "true" shownetwork="false"/> quer convidar voce para conhecer Futebol Manager
<fb:req-choice url="{$facebook->get_add_url()}" label="Adicione o Futebol Manager ao ser perfil!"/>  
FBML;
?>

<fb:request-form type="FutebolManager" action="?act=invite-friend" content="<?=htmlentities($invfbml)?>" invite="true" method="POST" >
	<fb:multi-friend-selector max="20" actiontext="Aqui estao seus amigos" showborder="true" rows="5" exclude_ids="<?=$arFriends?>">
</fb:request-form>

