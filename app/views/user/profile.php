<?
	$profile = new User;
	$profile->getUser(5);
	echo "Apelido == " . $profile->getApelido();
	echo "<br> Data Cadastro == " . $profile->getDataCadastro();
	echo "<br> Descricao == " . $profile->getDescricao();
	echo $profile->getImage();
?>

