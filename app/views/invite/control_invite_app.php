<?
	if ($_POST['ids'] != "" || $_POST['emails'] != "" ) {
	
		echo "Obrigado por convidar os seguintes amigos:<br />";	
		
		if($_POST['ids'] != "")
		{
			foreach($_POST['ids'] as $id) {
				echo "<fb:name uid=". $id . " linked='true' /> <br />";
	
			}	
		}
		if($_POST['emails'] != "")
		{		
			foreach($_POST['emails'] as $email) {
				echo "$email <br />";
	
			}
		}
	}
	else
	{
		//Imprime algo?
		echo "Nao convidou ninguem =( ";
	}
?>

