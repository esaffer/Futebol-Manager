<?
/*****************************************************************************
 *                            Futebol Manager                                *
 *****************************************************************************
 * Classe que define os grupos de usuários de um time.
 *
 * Autor:	Bruno Martins Rodrigues <bruno@thearmpit.net>
 *			Eduardo Saffer Medvedovsk <emedevas@gmail.com>
 *			Tiago Henrique Trojahn <troid16@gmail.com>
 *
 * Data:	21 de Dezembro de 2009
 *****************************************************************************/


class Warning extends Model {
	private $idDestino;
	private $id;
	private $text; 
	private $date;
	
	public	$db;
	private $base;
	private $table_name;



	/************************************************************************
	 * __construct
	 * Construtor da classe.
	 ************************************************************************/
	public function __construct () {
		$this->table_name = DB_TABLE_WARNING;
		$this->db = new Database(DB_USER, DB_PASS, DB_NAME, DB_HOST);
	}

	/************************************************************************
	 * getUserGame
	 * Atualiza todos os dados
	 ************************************************************************/
	public function getWarning ($id)
	{
		$sql = "SELECT * from " . $this->table_name . " WHERE id = $id";
		$sql = $this->db->get_row($sql);
				
		if ($sql->id != NULL) {
		
			$this->id			= $sql->id;
			$this->idDestino			= $sql->idDestino;
			$this->text			= $sql->text;
			$this->date 			= $sql->date;		
			return True;
		}
		else {
			return False;
		}
	}

	/************************************************************************
	 * getListUser
	 * Retorna a lista de warnings que determinado usuário já recebeu, em ordem de data.

	 ************************************************************************/
	public function getListUser ($idDestino)
	{
		$sql = "SELECT * from $this->table_name WHERE idDestino = $idDestino ORDER BY date";
		$this->db->query($sql);		
		return $this->db->get_results();
	}	
	
	
	
	/************************************************************************
	 * setAll
	 * Seta as variáveis em um array antes de salvá-las.
	 ************************************************************************/
	private function setAll ()
	{
		$this->base = array (
			'idDestino'		=> $this->idTeam,
			'text'		=> $this->text,
			'date'		=> $this->date,
		);
	}



	/**************************************************************************
	 * Add
	 * Adiciona um grupo no banco de dados.
	 **************************************************************************/
	public function Add ()
	{
		$this->setAll();
		
		$sql  = $this->createInsertQuery($this->table_name, $this->base);
		
		if ($this->db->query($sql))
			$this->messageFail("Erro ao criar os alertas");			
		else
			$this->messageOk("Alertas criados com sucesso!");		
	}


	/**************************************************************************
	 * Edit
	 * Edita os dados de um jogo.
	 **************************************************************************/
	public function Edit ($id = Null)
	{
		if (is_null($id))
		{
			$this->messageFail('É necessário informar um ID.');
			return False;
		}		
		$this->setAll();

		$sql = $this->createUpdateQueryGambiarra($this->table_name, $this->base, $id);
		
		if ($this->db->query($sql))
			$this->messageFail("Ocorreu um erro ao modificar um alerta");
		else
			$this->messageOk("Alerta editado com sucesso!");
	}



	/*************************************************************************
	 * SQL
	 * Código SQL referente a tabela da Classe.
	 *************************************************************************/
	public function SQL () {
		$sql = "CREATE TABLE " . $this->table_name . " (
					id			int(11) NOT NULL AUTO_INCREMENT,
					idDestino		int(11) NOT NULL,	
					text			text,
					date			datetime NOT NULL,				
					
					PRIMARY KEY (id))";
		
		return $sql;
	}



	/***************************************************************
	 * setters
	 * Seta o valor de uma variável.
	 ***************************************************************/
	public function setText			($value) { $this->text	= $value; }
	public function setIDDestino		($value) { $this->idDestino	= $value; }
	public function setDate	($value = NULL)
	{
		if ($value == NULL)
			$this->date = date('Y-m-d H:i:s');
		else
			$this->date = $value;
	}

	
	
	/*************************************************************************
	 * Getters
	 * Retorna o conteúdo de uma variável.
	 *************************************************************************/
	 public function getID			() { return $this->id; }
	 public function getIDDestino			() { return $this->idDestino; }
	 public function getText			() { return $this->text; }
	 public function getDate			() { return strtotime($this->date); }
}
?>
