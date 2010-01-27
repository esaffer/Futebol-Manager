<?php
	$team = new Team;
	$team->getTeam($_POST['idTeam']);

?>

<h1>Convidar um amigo para participar do grupo "<?= $team->getName() ?>"</h1>
<hr />

<? 
	echo "Escolha um amigo que já utilize o Futebol Manager";
	
	//Processa o sistema de forma a formar uma lista de ID's separados por vírgulas...
	$userTeam = new UserTeam;
	$sql = array();
	$sql = $userTeam->getListTeam($team->getID());
	
	$count = count($sql);
	$resultado = "";
	for ($i = 0; $i < $count; $i++)
	{   
		if($resultado != "")
			$resultado .= ",";
		$resultado .= $sql[$i]->idUser;	 
	}
	//Processa da mesma forma.
	$rs2 = $facebook->api_client->fql_query("SELECT uid FROM user WHERE is_app_user=0 and uid IN (SELECT uid2 FROM friend WHERE uid1 = $idUserFacebook)"); //Todos os meus amigos que não instalaram a aplicação

	$arFriends2 = "";
	if($rs2)
	{
		$arFriends2 .= $rs2[0]["uid"];
		for ($i = 1; $i < count($rs2); $i++)
		{
			if($arFriends2 != "")
				$arFriends2 .= ",";
			$arFriends2 .= $rs2[$i]["uid"];
		}
	}
	if($resultado != "")
	{
		//Junta os dois resultados
		$arFriends2 = $arFriends2 . ",". $resultado;
	}	
	$arFriends2 = $arFriends2 . ",". $team->getIDOwner(); //Remove o possível erro de tentar convidar o Owner...
	
$sNextUrl = urlencode("&refuid=".$idUserFacebook);

$invfbml2 = <<<FBML
Estou participando do grupo '{$team->getName()}', junte-se a mim! 
<fb:req-choice url="{$facebook->get_add_url()}" label="Entre e veja seu perfil!"/>  
FBML;
?>

<fb:request-form method="POST" action="?act=invite-friends-team-user&id=<?= $team->getID()?>" content="<?=htmlentities($invfbml2)?>" type="Futebol Manager" invite="false">
   	<fb:multi-friend-selector condensed="true" style="width: 200px;" exclude_ids="<?=$arFriends2?>" />  
   	<fb:request-form-submit />  
</fb:request-form>

<!-- 
// PARTE DE BAIXO, CONVIDAR ALGUEM QUE AINDA NÃO TEM CONTA NO FUTEBOL MANAGER

-->

<?php

echo "Escolha um amigo que ainda nao utilize o Futebol Manager para este grupo"; 

$rs = $facebook->api_client->fql_query("SELECT uid FROM user WHERE is_app_user=1 and uid IN (SELECT uid2 FROM friend WHERE uid1 = $idUserFacebook)");

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
Estou participando do grupo '{$team->getName()}', junte-se a mim!
<fb:req-choice url="{$facebook->get_add_url()}" label="Adicione o Futebol Manager ao ser perfil!"/>  
FBML;
?>

<fb:request-form method="POST" action="?act=invite-friends-team-not-user&id=<?= $team->getID()?>" content="<?=htmlentities($invfbml)?>" type="Futebol Manager" invite="true">
   	<fb:multi-friend-selector condensed="true" style="width: 200px;" exclude_ids="<?=$arFriends?>" />  
   	<fb:request-form-submit />  
</fb:request-form>
