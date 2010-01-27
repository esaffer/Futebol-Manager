<?
	$team = new Team ();
	$teams = $team->getAll();
?>

<h1>Equipes</h1>
<hr />
<? if ($teams) { ?>
	<table>
		<thead>
		<tr>
			<td>Nome</td>
			<td>Jogadores</td>
			<td>Cidade</td>
			<td>Local</td>
		</tr>
		</thead>
		
		<tbody>
		<? foreach ($teams as $t) { ?>
			<tr>
				<td><?= $t->name ?></td>
				<td><?= '12' ?></td>
				<td><?= 'Pelotas' ?></td>
				<td><?= 'Gigantinho' ?></td>
			</tr>
		<? } ?>
		</tbody>
	</table>

<? } else { ?>
	<? $team->messageFail("Não existe nenhuma equipe cadastrada para ser exibida!"); ?>
<? } ?>
