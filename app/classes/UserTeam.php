<?
/******************************************************************************
 * Class		: User
 * Description	: Define o comportamento e criação do usuário no site.
 ******************************************************************************/

class UserTeam extends Model {
	private $idUser;
	private $idTeam;
	private $locked;
	private $points;
	private $date_joined;
	
	private $base;
	public $db;
	private $table_name;



	/************************************************************************
	 * __construct
	 * Construtor da classe.
	 ************************************************************************/
	public function __construct () {
		$this->table_name = DB_TABLE_USERTEAM;
		$this->db = new Database(DB_USER, DB_PASS, DB_NAME, DB_HOST);
	}



	/*************************************************************************
	 * getListTeam
	 * Retorna a lista de todas as ocorrências de dado team
	 *************************************************************************/	 
	public function getListTeam ($idTeam)
	{
		$sql = "SELECT * from " . $this->table_name . " WHERE idTeam = " . $idTeam;
		$sql = $this->db->get_row($sql);		
		
		if ($sql->idTeam != NULL)
			return $sql;
		else
			return False;
	}
	
	
	/*************************************************************************
	 * getListUser
	 * Retorna a lista de todas os grupos que tal user participa (não sendo owner!)
	 *************************************************************************/	 
	public function getListUser ($idUser)
	{
		$sql = "SELECT * from " . $this->table_name . " WHERE idUser = " . $idUser;
		$sql = $this->db->get_row($sql);		
		
		if ($sql->idUser != NULL)
			return $sql;
		else
			return False;
	}



	/*************************************************************************
	 * setAll
	 * Seta os atributos do usuário para um array que salvará os dados no BD.
	 *************************************************************************/
	private function setAll ()
	{
		$this->base = array (
			'idUser' 		=> $this->idUser,
			'idTeam'		=> $this->idTeam,
			'points'		=> $this->points,
			'locked'		=> $this->locked,
			'date_joined'		=> $this->date_joined,
		);
	}
	
	public function getData($idUser, $idTeam)
	{				
		$sql = "SELECT * from $this->table_name WHERE idUser = $idUser AND idTeam = $idTeam";
		$sql = $this->db->get_row($sql);		
		
		if ($sql->idUser != NULL && $sql->idTeam != NULL ) {
		
			$this->idUser			= $sql->idUser;
			$this->idTeam			= $sql->idTeam;
			$this->points			= $sql->points;
			$this->locked 			= $sql->locked;
			$this->date_joined		= $sql->date_joined;
			return True;
		}
		else {
			return False;
		}
	}
	
	/*************************************************************************
	 * getNumUsers
	 * Retorna o números de users "normais" de determinado grupo.
	 *************************************************************************/	
	public function getNumUsers($idTeam)
	{
		$sql = "SELECT COUNT(idUser) FROM " . $this->table_name . " WHERE idTeam = ". $idTeam;
		$sql = $this->db->get_var($sql);
		return $sql;
	}
	
	/*************************************************************************
	 * getNumTeams
	 * Retorna o números de grupos que um determinado user é membro "normal".			 	 *************************************************************************/	
	public function getNumTeams($idUser)
	{
		$sql = "SELECT COUNT(idUser) FROM " . $this->table_name . " WHERE idUser = ". $idUser;
		$sql = $this->db->get_var($sql);
		return $sql;
	}



	/**************************************************************************
	 * Add
	 * Adiciona um usuário ao time.
	 **************************************************************************/
	public function Add ()
	{
		$this->setAll();
		
		$sql  = $this->createInsertQuery($this->table_name, $this->base);
		
		if ($this->db->query($sql))
			$this->messageOk("O usuário foi adicionado com sucesso!");
		else
			$this->messageFail("Ocorreu um erro ao adicionar o usuário.");
	}



	/**************************************************************************
	 * Edit
	 * Edita os dados de um usuário.
	 **************************************************************************/
	public function Edit ($idTeam = Null, $idUser = Null)
	{
		if (is_null($idTeam) || is_null($idUser))
		{
			$this->messageFail('É necessário informar ambos IDs.');
			return False;
		}
		
		$this->setAll();
		$sql = $this->createUpdateQuery($this->table_name, $this->base, $id);
		
		if ($this->db->query($sql) == False)
			$this->messageOk("O Registro foi editado com sucesso!");
		else
			$this->messageFail("Ocorreu um erro ao editar o registro.");
	}



	/*************************************************************************
	 * Delete
	 * Exclui um user do time do banco de dados
	 * 
	 * @params	idUser	ID do usuário que deseja excluir
	 * @params	idTeam	ID do time que deseja
	 * @return 	boolean
	 *************************************************************************/
	public function delete($idUser, $idTeam) 
	{
		if ($this->checkId($this->table_name, $idUser) && $this->checkId($this->table_name, $idTeam)) 
		{
			$this->messageFail("Não existe tal user registrado nesse grupo.");
			return False;
		}
		else
		{
			$this->db->query("DELETE FROM " . $this->table_name . " WHERE idUser = $idUser AND idTeam = $idTeam");
			$this->messageOk("O usuário foi expulso com sucesso!");
			return True;
		}
	}



	/*************************************************************************
	 * SQL
	 * Código SQL referente a tabela da classe.
	 *************************************************************************/
	public function SQL () {
		$sql	= "CREATE TABLE " . $this->table_name . " (
					idUser				bigint(20) NOT NULL,
					idTeam				bigint(20) NOT NULL,
					locked				bool,
					points				mediumint(9),
					date_joined			timestamp,
					PRIMARY KEY ( `idTeam` ));";
		
		return $sql;
	}


	/*************************************************************************
	 * Setters
	 * Seta o conteúdo de uma variável.
	 *************************************************************************/
	public function setIDUser		($value) { $this->idTeam		= $value; }
	public function setIDTeam		($value) { $this->idUser		= $value; }
	public function setPoints		($value) { $this->points		= $value; }
	public function setLocked		($value) { $this->locked		= $value; }
	public function setDateJoined		($value = NULL)
	{ 
		if ($value == NULL)
		{
			$this->date_joined = time();
		}
		else 
		{
			$this->date_joined = $value;
		}
	}



	/*************************************************************************
	 * Getters
	 * Retorna o conteúdo de uma variável.
	 *************************************************************************/
	 public function getIDUser			() { return $this->idUser; }
	 public function getIDTeam			() { return $this->idTeam; }
	 public function getPoints			() { return $this->points; }
	 public function getLocked			() { return $this->locked; }
	 public function getDateJoined			() { return $this->date_joined; }
}
?>