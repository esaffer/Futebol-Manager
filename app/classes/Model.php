<?
/**
 * Classe base para as outras do framework, com funções universais
 * de acesso a banco de dados e listagem.
 **/

class Model {
	public $db;

	
	private $user = DB_USER;
	private $pass = DB_PASS;
	private $data = DB_NAME;
	private $host = DB_HOST;
	
	
	/**
	 * The constructor of the class. It sets the database handler
	 **/
	function __construct ()
	{
		$this->db = new Database($this->user, $this->pass, $this->data, $this->host); 
	}
	
	public function messageOk ($text)
	{
		echo "<div class='msg-success'>" . $text . "</div>";
		return True;
	}
	
	public function messageFail ($text)
	{
		echo "<div class='msg-error'>" . $text . "</div>";
		return True;
	}
	
	
	
	
	/**
	 * Checa se existe o ID na tabela
	 *
	 * @param table		string		Nome da tabela da busca
	 * @param id		integer		ID que se deseja pesquisar se existe
	 *
	 * @result			boolean
	 **/	 
	public function checkId ($table, $id) {
		$check = $this->db->get_row("SELECT id FROM " . $table . " WHERE id = " . $id);
		
		if (is_null($check->id))
			return FALSE;
		else
			return TRUE;
	}
	
	
	
	
	/**
	 * Cria um query mySQL para inserir arquivos em uma tabela
	 *
	 * @param table		Nome da tabela de destino
	 * @param values	Array com as chaves e valores a serem inseridos
	 *
	 * @result			mySQL Query
	 **/
	public function createInsertQuery ($table, $values) {
		$i	= count($values);
		$j  = 0;
		
		$s = "INSERT INTO `$table` (";
		
		reset($values);
		$list = array_keys($values);
		foreach ($list as $l) {
			$j++;
			$s .= ($j < $i) ? "`$l`, " : "`$l`) VALUES (";
		}
		
		reset($values);
		$list = array_values($values);
		$j = 0;
		foreach ($list as $l) {
			$j++;
			$s .= ($j < $i) ? "'$l', " : "'$l')";
		}
		
		return $s;
	}
	
	
	
	public function createUpdateQuery($table, $list, $id) {
		$list	= array_filter($list, notEmpty);
		$i 		= count($list);
		$j		= 0;
		
		$s = "UPDATE `$table` SET ";
		
		// adiciona na lista os elementos do tipo STRING
		$x = array_filter($list, onlyString);
		reset($x);
		while (list($key, $val) = each($x)) {
			$s .= "$key = \"$val\"";
			$j++;
			$s .= ($j < $i) ? ", " : " "; 
		}
			
		// adiciona na lista os elementos do tipo NUMERIC
		$x = array_filter($list, is_numeric);
		reset($x);
		while (list($key, $val) = each($x)) {
			$s .= "$key = $val";
			$j++;
			$s .= ($j < $i) ? ", " : " "; 
		}
			
		// finaliza a função e entrega a query
		$s .= "WHERE id = $id LIMIT 1";
		return $s;
	}
}
?>
