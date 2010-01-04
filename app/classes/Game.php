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


class Game extends Model {
	private $id;
	private $idTeam;
	private $idCreator; //ID do user que criou o jogo...
	private $description;
	private $date;
	private $numMinPlayers;
	private $numMaxPlayers;
	private $cost;
	
	public	$db;
	private $base;
	private $table_name;



	/************************************************************************
	 * __construct
	 * Construtor da classe.
	 ************************************************************************/
	public function __construct () {
		$this->table_name = DB_TABLE_GAME;
		$this->db = new Database(DB_USER, DB_PASS, DB_NAME, DB_HOST);
	}



	/************************************************************************
	 * getTeam
	 * Pega todos os usuários de uma determinada equipe.
	 ************************************************************************/
	public function getGame ($id)
	{
		$sql = "SELECT * from " . $this->table_name . " WHERE id = " . $id;
		$sql = $this->db->get_row($sql);
				
		if ($sql->id != NULL) {
		
			$this->id 			= $sql->id;
			$this->idCreator		= $sql->idCreator;
			$this->idTeam			= $sql->idTeam;
			$this->description 		= $sql->description;
			$this->numMinPlayers		= $sql->numminplayers;
			$this->numMaxPlayers 		= $sql->nummaxplayers;
			$this->cost 			= $sql->cost;			
			return True;
		}
		else {
			return False;
		}
	}

	/************************************************************************
	 * getListUser
	 * Retorna a lista de jogos que determinado usuário criou para este grupo.
	 ************************************************************************/
	public function getListUser ($idCreator, $idTeam)
	{
		$sql = "SELECT * from $this->table_name WHERE idCreator = $idCreator AND idTeam = $idTeam";
		$this->db->query($sql);		
		return $this->db->get_results();
	}		

	/************************************************************************
	 * getListTeam
	 * Retorna a lista de jogos de determinado team
	 ************************************************************************/
	public function getListTeam($idTeam)
	{
		$this->db->query("SELECT * from " .  $this->table_name . " WHERE idTeam = " . $idTeam );
		return $this->db->get_results();
	}
	
	/************************************************************************
	 * getNumUser
	 * Retorna o número de jogos que determinado usuário criou para este grupo.
	 ************************************************************************/
	public function getNumUser ($idCreator, $idTeam)
	{
		$sql = "SELECT COUNT(idCreator) from $this->table_name WHERE idCreator = $idCreator AND idTeam = $idTeam";	
		return $this->db->get_var($sql);;
	}
	
	/************************************************************************
	 * getNumTeam
	 * Retorna o número de jogos que determinado usuário criou para este grupo.
	 ************************************************************************/
	public function getNumTeam ($idTeam)
	{
		$sql = "SELECT COUNT(idTeam) from $this->table_name WHERE idTeam = $idTeam";	
		return $this->db->get_var($sql);;
	}


	/************************************************************************
	 * setAll
	 * Seta as variáveis em um array antes de salvá-las.
	 ************************************************************************/
	private function setAll ()
	{
		$this->base = array (
			'id'			=> $this->id,
			'idCreator'		=> $this->idCreator,
			'idTeam'		=> $this->idTeam,
			'description'		=> $this->description,
			'date'			=> $this->date,
			'numminplayers'		=> $this->numMinPlayers,
			'nummaxplayers'		=> $this->numMaxPlayers,
			'cost'			=> $this->cost,
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
			$this->messageOk("A equipe <b>" . $this->name . "</b> foi adicionada com sucesso!");
		else
			$this->messageFail("Ocorreu um erro ao adicionar a equipe.");
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
		print_r($this->base);
		$sql = $this->createUpdateQuery($this->table_name, $this->base, $id);
		
		if ($this->db->query($sql))
			$this->messageOk("A equipe <b>" . $this->name . "</b> foi editada com sucesso!");
		else
			$this->messageFail("Ocorreu um erro ao editar a equipe...");
	}



	/*************************************************************************
	 * SQL
	 * Código SQL referente a tabela da Classe.
	 *************************************************************************/
	public function SQL () {
		$sql = "CREATE TABLE " . $this->table_name . " (
					id			int(11) NOT NULL AUTO_INCREMENT,
					idTeam			int(11) NOT NULL,
					idCreator		bigint(11) NOT NULL,
					description		text,
					date			timestamp NOT NULL,					
					numminplayers		int(11),
					nummaxplayers		int(11),
					cost			float,
					
					PRIMARY KEY (id));";
		
		return $sql;
	}



	/***************************************************************
	 * setters
	 * Seta o valor de uma variável.
	 ***************************************************************/
	public function setID			($value) { $this->id 		= $value; }
	public function setIDCreator		($value) { $this->idCreator	= $value; }
	public function setDescription 		($value) { $this->description 	= $value; }
	public function setIDTeam 		($value) { $this->idTeam 	= $value; }
	public function setDate	($value = NULL)
	{
		if ($value == NULL)
			$this->date = time();
		else
			$this->date = $value;
	}
	public function setCost 		($value) 
	{
		if($value < 0)
			$this->cost = 0;
		else
			$this->cost = $value;
	}
	public function setNumMinPlayers 	($value)
	{
		if($value < 0)
			$this->numMinPlayers = 0;
		else
			$this->numMinPlayers = $value;
	}
	
	public function setNumMaxPlayers 	($value)
	{ 
		if($value < 0 || $value < $this->numMinPlayer )
			$this->numMaxPlayers = $this->numMinPlayer;
		else
			$this->numMaxPlayers = $value;
	}
	
	
	/*************************************************************************
	 * Getters
	 * Retorna o conteúdo de uma variável.
	 *************************************************************************/
	 public function getID				() { return $this->id; }
	 public function getIDCreator			() { return $this->idCreator; }
	 public function getIDTeam			() { return $this->idTeam; }
	 public function getDescription			() { return $this->description; }
	 public function getDate			() { return $this->date; }
	 public function getNumMinPlayers		() { return $this->numMinPlayers; }
	 public function getNumMaxPlayers		() { return $this->numMaxPlayers; }
	 public function getCost			() { return $this->cost; }
}
?>
