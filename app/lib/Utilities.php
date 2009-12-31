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
	function time2str($ts)
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
				if($diff < 60) return 'just now';
				if($diff < 120) return '1 minute ago';
				if($diff < 3600) return floor($diff / 60) . ' minutes ago';
				if($diff < 7200) return '1 hour ago';
				if($diff < 86400) return floor($diff / 3600) . ' hours ago';
			}
			if($day_diff == 1) return 'Yesterday';
			if($day_diff < 7) return $day_diff . ' days ago';
			if($day_diff < 31) return ceil($day_diff / 7) . ' weeks ago';
			if($day_diff < 60) return 'last month';
			return date('F Y', $ts);
		}
		else
		{
			$diff = abs($diff);
			$day_diff = floor($diff / 86400);
			if($day_diff == 0)
			{
				if($diff < 120) return 'in a minute';
				if($diff < 3600) return 'in ' . floor($diff / 60) . ' minutes';
				if($diff < 7200) return 'in an hour';
				if($diff < 86400) return 'in ' . floor($diff / 3600) . ' hours';
			}
			if($day_diff == 1) return 'Tomorrow';
			if($day_diff < 4) return date('l', $ts);
			if($day_diff < 7 + (7 - date('w'))) return 'next week';
			if(ceil($day_diff / 7) < 4) return 'in ' . ceil($day_diff / 7) . ' weeks';
			if(date('n', $ts) == date('n') + 1) return 'next month';
			
			return date('F Y', $ts);
		}
	}
?>
