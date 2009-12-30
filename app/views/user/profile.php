<?
	$profile = new User;
	$profile->getUser($idUserFacebook);
	echo "Apelido == " . $profile->getApelido();
	echo "<br> Data Cadastro == " . $profile->getDataCadastro();
	echo "<br> Descricao == " . $profile->getDescricao();
	echo $profile->getImage();
?>

