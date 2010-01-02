<?
	/*************************************************************************
	 * isEmpty
	 * Usada para programação funcional, retorna True se o valor for Null
	 *************************************************************************/
	function isEmpty ($value)
	{
		return ($value == "") ? TRUE : FALSE;
	}



	/*************************************************************************
	 * notEmpty
	 * Usada para programação funcional, retorna True se não estiver vazio.
	 *************************************************************************/
	function notEmpty ($value)
	{
		return ($value != "") ? TRUE : FALSE;
	}



	/*************************************************************************
	 * onlyString
	 * Retorna True se o valor não for numérico.
	 *************************************************************************/
	function onlyString($value)
	{
		return ((is_numeric($value) == FALSE) && (is_string($value) == TRUE)) ? TRUE : FALSE;
	}



	/*************************************************************************
	 * slugify
	 * Cria um slug de uma string.
	 *************************************************************************/
	function slugify($str)
	{
		$str = preg_replace('/[^a-zA-Z0-9 -]/', '', $str);
		$str = strtolower(str_replace(' ', '-', trim($str)));
		$str = preg_replace('/-+/', '-', $str);
		return $str;
	}


	/*************************************************************************
	 * printr
	 * Versão mais amigável do print_r
	 *************************************************************************/
	function printr($var)
	{
		$output = print_r($var, True);
		$output = str_replace("\n", "<br>", $output);
		$output = str_replace(' ', '&nbsp;', $output);
		echo "<div style='font-family:courier;'>$output</div>";
	}


	/*************************************************************************
	 * naturalTime
	 * Hora em português e mais 'humana'.
	 *************************************************************************/
	function naturalTime ($ts)
	{
		if(!ctype_digit($ts))
			$ts = strtotime($ts);

		$diff = time() - $ts;
		if($diff == 0)
			return 'now';
		elseif($diff > 0)
		{
			$day_diff = floor($diff / 86400);
			if($day_diff == 0)
			{
				if($diff < 60) return 'agora';
				if($diff < 120) return '1 minuto atrás';
				if($diff < 3600) return floor($diff / 60) . ' minutos atrás';
				if($diff < 7200) return '1 hora atrás';
				if($diff < 86400) return floor($diff / 3600) . ' horas atrás';
			}
			if($day_diff == 1) return 'Ontem';
			if($day_diff < 7) return $day_diff . ' dias atrás';
			if($day_diff < 31) return ceil($day_diff / 7) . ' semanas atrás';
			if($day_diff < 60) return 'mês passado';
			return date('F Y', $ts);
		}
		else
		{
			$diff = abs($diff);
			$day_diff = floor($diff / 86400);
			if($day_diff == 0)
			{
				if($diff < 120) return 'em um minuto';
				if($diff < 3600) return 'em ' . floor($diff / 60) . ' minutos';
				if($diff < 7200) return 'em uma hora';
				if($diff < 86400) return 'em ' . floor($diff / 3600) . ' horas';
			}
			if($day_diff == 1) return 'Amanhã';
			if($day_diff < 4) return date('l', $ts);
			if($day_diff < 7 + (7 - date('w'))) return 'semana que vem';
			if(ceil($day_diff / 7) < 4) return 'em ' . ceil($day_diff / 7) . ' semanas';
			if(date('n', $ts) == date('n') + 1) return 'mês que vem';
			
			return date('F Y', $ts);
		}
	}
?>
