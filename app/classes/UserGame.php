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


class UserGame extends Model {
	private $idGame;
	private $idUser;
	private $idTeam; 
	private $status;
	
	public	$db;
	private $base;
	private $table_name;



	/************************************************************************
	 * __construct
	 * Construtor da classe.
	 ************************************************************************/
	public function __construct () {
		$this->table_name = DB_TABLE_USERGAME;
		$this->db = new Database(DB_USER, DB_PASS, DB_NAME, DB_HOST);
	}



	/************************************************************************
	 * getUserGame
	 * Atualiza todos os dados
	 ************************************************************************/
	public function getUserGame ($idGame, $idUser, $idTeam)
	{
		$sql = "SELECT * from " . $this->table_name . " WHERE idGame = $idGame AND idUser = $idUser AND idTeam = $idTeam";
		$sql = $this->db->get_row($sql);
				
		if ($sql->id != NULL) {
		
			$this->idGame			= $sql->idGame;
			$this->idTeam			= $sql->idTeam;
			$this->idUser			= $sql->idUser;
			$this->status 			= $sql->_status;		
			return True;
		}
		else {
			return False;
		}
	}

	/************************************************************************
	 * getListUserConfirmed
	 * Retorna a lista de jogos que determinado usuário já confirmou.
	 * status = 1 para confirmado, 0 para não informado, -1 para rejeitado
	 ************************************************************************/
	public function getListUser ($idUser, $status)
	{
		$sql = "SELECT * from $this->table_name WHERE idUser = $idUser AND status = $status";
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
			'idGame'		=> $this->idGame,
			'idTeam'		=> $this->idTeam,
			'idUser'		=> $this->idUser,
			'_status'		=> $this->status,
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
					idUser			bigint(20) NOT NULL,
					idTeam			int(11) NOT NULL,
					idGame			int(11) NOT NULL,
					_status			int(2) NOT NULL
					);";
		
		return $sql;
	}



	/***************************************************************
	 * setters
	 * Seta o valor de uma variável.
	 ***************************************************************/
	public function setIDTeam		($value) { $this->idTeam	= $value; }
	public function setIDUser		($value) { $this->idUser	= $value; }
	public function setIDGame 		($value) { $this->idGame 	= $value; }
	public function setStatus 		($value) { $this->idTeam 	= $value; }

	
	
	/*************************************************************************
	 * Getters
	 * Retorna o conteúdo de uma variável.
	 *************************************************************************/
	 public function getIDTeam			() { return $this->idTeam; }
	 public function getIDUser			() { return $this->idUser; }
	 public function getIDGame			() { return $this->idGame; }
	 public function getStatus			() { return $this->status; }
}
?>
