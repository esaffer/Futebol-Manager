<?
	$db		= new Database(DB_USER, DB_PASS, DB_NAME, DB_HOST);
	$user	= new User ();
	$team	= new Team ();
	$userteam = new UserTeam ();
?>

<h1>Criando Tabelas</h1>
<p>Esta página permite criar as tabelas das classes no Banco de Dados.</p>

<ul>
	<li>
		<? $db->query($user->SQL()); ?>
		Tabela User: Criada com sucesso!
	</li>
	
	<li>
		<? $db->query($team->SQL()); ?>
		Tabela Team: Criada com sucesso!
	</li>
	
	<li>
		<? $db->query($userteam->SQL()); ?>
		Tabela UserTeam: Criada com sucesso!
	</li>
	
</ul>
