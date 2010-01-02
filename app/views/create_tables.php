<?
	$db		= new Database ();
	$user	= new User ();
	$team	= new Team ();
?>

<h1>Criando Tabelas</h1>
<p>Esta página permite criar as tabelas das classes no Banco de Dados.</p>

<ul>
	<li>
		<? $db->query($user->SQL()); ?>
		Tabela Users: Criada com sucesso!
	</li>
	
	<li>
		<? $db->query($team->SQL()); ?>
		Tabela Teams: Criada com sucesso!
	</li>
</ul>
