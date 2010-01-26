<h1>Adicionar Equipe</h1>

<?
	if($_GET['do'] == 'add' && $_POST['name'] == "")
	{
		echo "<br><br> Não se pode criar um grupo sem um nome!<br>";
	}

	if ($_GET['do'] == 'add' && $_POST['name'] != "") 
	{
		$team = new Team;
		$team->setName($_POST['name']);		
		$team->setPlace(""); //HUAHUAHUAHAUHA
		$team->setRules($_POST['rules']);
		
		if ($_POST['privative'] == 'true')
			$team->setPrivative(TRUE);
		else
			$team->setPrivative(FALSE);
		$team->setDescription($_POST['description']);
		$team->setDateCreated();
		$team->setImage($_POST['image']);
		$team->setIDOwner($idUserFacebook);
		$team->Add();
		
		$name = $_POST['name'];
		echo "<br><br> Time criado com sucesso! <br>";
		
		//PARTE DE ENVIO DO NEWSFEED
		if (!($_POST['privative'] == 'true'))
		{
			$has_permission = $facebook->api_client->users_hasAppPermission("publish_stream");
			if(!$has_permission)
			{
				echo "<br /><fb:prompt-permission perms=\"publish_stream\"> Publique no seu NewsFeed! </fb:prompt-permission>";
			}
			else
			{
				$title = "Criou o grupo $name utilizando Sport Manager! ";
				$attachment = array( 
					'name' => APP_NAME,
					'href' => 'http://apps.facebook.com/futebolmanager/',
					'caption' => '', 
					'description' => "Comece a usar já o Sport Manager e marque jogos com sua turma!", 
					'properties' => '',
					'media' => array(array('type' => 'image', 'src' => 'http://knuth.ufpel.edu.br/tiago/media/img/logo-icon.png',
						'href' => 'http://apps.facebook.com/futebolmanager/'))
							);
				$attachment = json_encode($attachment); 
				$facebook->api_client->stream_publish($title, $attachment);
			}
		}
		return;
	}
	
?>

<form action="?act=team-add&do=add" method="POST">
	<label for='name'>Nome:</label>
		<input type="text" id='name' name='name' />
	<br />
	<!--<label for='place'>Local:</label>
		<input type="text" id='place' name='place' />
	<br /> -->
		<label for='image'>Link da imagem:</label>
		<input type="text" id='image' name='image' />
	<br />
	<label for='description'>Descricao:</label>
		<textarea cols=20 rows=5 id='description' name='description' /></textarea>
	<br />
	<label for='rules'>Regras:</label>
		<textarea id='rules' name='rules' /></textarea>
	<br />
		<input type='radio' name='privative' value='false' checked>Publico</br>
		<input type='radio' name='privative' value='true'>Privado</br>
	<br />
	<input type='submit' value='Salvar' />
</form>

