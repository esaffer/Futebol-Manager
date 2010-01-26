<?
	$country	= new Countr y();
	$region		= new Region ();
	$city		= new City ();



	if (isset($_GET['country']))
	{
		if (isset($_GET['region'])
		{
			if (isset($_GET['city'])
			{
				// Mostra grupos na cidade
			}
			else
			{
				// Mostra lista de cidades
			}
		}
		else
		{
			// Mostra lista de regiões
		}
	}
	else
	{
		// Mostra lista de países
	}
?>
