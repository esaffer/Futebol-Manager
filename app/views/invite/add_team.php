<?php
	$team = new Team;
	$team->getTeam($_POST['idTeam']);

?>

<h1>Convidar um amigo para participar do grupo "<?= $team->getName() ?>"</h1>

<? echo "Escolha um amigo que já utilize o Futebol Manager";

	echo "<br><br><br> Implementar....<br><br><br>";
	
?>





<?php


// PARTE DE BAIXO, CONVIDAR ALGUEM QUE AINDA NÃO TEM CONTA NO FUTEBOL MANAGER

 echo "Escolha um amigo que ainda nao utilize o Futebol Manager para este grupo"; 


?>


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
<fb:name uid="$idUserFacebook" firstnameonly = "false" shownetwork="false"/> quer que voce para conheça o Futebol Manager e entre no grupo '{$team->getName()}'
<fb:req-choice url="{$facebook->get_add_url()}" label="Adicione o Futebol Manager ao ser perfil!"/>  
FBML;
?>

<fb:request-form method="POST" action="?act=invite-friends-team-not-user.php&id=<?= $team->getID()?>" content="<?=htmlentities($invfbml)?>" type="<?= $team->getName()?>" invite="true">
   	<fb:multi-friend-selector condensed="true" style="width: 200px;" exclude_ids="<?=$arFriends?>" />  
   	<fb:request-form-submit />  
</fb:request-form>
