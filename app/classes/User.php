<?
/******************************************************************************
 * Class		: User
 * Description	: Define o comportamento e criação do usuário no site.
 ******************************************************************************/

class User extends Model {
	private $id;
	private $nick;
	private $points;
	private $description;
	private $date_created;
	private $image;
	
	private $base;
	public $db;
	private $table_name;



	/************************************************************************
	 * __construct
	 * Construtor da classe.
	 ************************************************************************/
	public function __construct () {
		$this->table_name = DB_TABLE_USERS;
		$this->db = new Database(DB_USER, DB_PASS, DB_NAME, DB_HOST);
	}



	/*************************************************************************
	 * getUser
	 * Procura um usuário.
	 *************************************************************************/
	public function getUser ($id) {
		
		$sql = "SELECT * from " . $this->table_name . " WHERE id = " . $id;
		$sql = $this->db->get_row($sql);		
		
		if ($sql->id != NULL) {
		
			$this->id 			= $sql->id;
			$this->nick			= $sql->nick;
			$this->points		= $sql->points;
			$this->description 	= $sql->description;
			$this->date_created	= $sql->date_created;
			$this->image 		= $sql->image;
			return True;
		}
		else {
			return False;
		}
	}



	/*************************************************************************
	 * setAll
	 * Seta os atributos do usuário para um array que salvará os dados no BD.
	 *************************************************************************/
	private function setAll ()
	{
		$this->base = array (
			'id' 			=> $this->id,
			'nick'			=> $this->nick,
			'points'		=> $this->points,
			'description'		=> $this->description,
			'date_created'		=> $this->date_created,
			'image'			=> $this->image,
		);
	}



	/**************************************************************************
	 * Add
	 * Adiciona um usuário no banco.
	 **************************************************************************/
	public function Add ()
	{
		$this->setAll();
		
		$sql  = $this->createInsertQuery($this->table_name, $this->base);
		
		if ($this->db->query($sql))
			$this->messageOk("O usuário <b>" . $this->nick . "</b> foi adicionado com sucesso!");
		else
			$this->messageFail("Ocorreu um erro ao adicionar o usuário.");
	}



	/**************************************************************************
	 * Edit
	 * Edita os dados de um usuário.
	 **************************************************************************/
	public function Edit ($id = Null)
	{
		if (is_null($id))
		{
			$this->messageFail('É necessário informar um ID.');
			return False;
		}
		
		$this->setAll();
		$sql = $this->createUpdateQuery($this->table_name, $this->base, $id);
		
		if ($this->db->query($sql) == False)
			$this->messageOk("O usuário <b>" . $this->nick . "</b> foi editado com sucesso!");
		else
			$this->messageFail("Ocorreu um erro ao editar o usuário.");
	}



	/*************************************************************************
	 * Delete
	 * Exclui um usuário do banco de dados
	 * 
	 * @params	id	ID do usuário que deseja excluir
	 * @return 	boolean
	 *************************************************************************/
	public function delete($id) 
	{
		if ($this->checkId($this->table_name, $id)) 
		{
			$this->messageFail("Não existe nenhum usuário com esse ID.");
			return False;
		}
		else
		{
			$this->db->query("DELETE FROM " . $this->table_name . " WHERE id = $id");
			$this->messageOk("O usuário foi excluído com sucesso!");
			return True;
		}
	}



	/*************************************************************************
	 * SQL
	 * Código SQL referente a tabela da classe.
	 *************************************************************************/
	public function SQL () {
		$sql	= "CREATE TABLE " . $this->table_name . " (
					id				bigint(20) NOT NULL,
					image			varchar(50),
					nick			varchar(25),
					points			mediumint(9),
					description		text,
					date_created	timestamp,
					UNIQUE KEY id (id));";
		
		return $sql;
	}



	/*************************************************************************
	 * getImage
	 * Retorna a imagem do perfil do usuário
	 *************************************************************************/	
	public function getImage ($id)
	{
		if($this->image != "")
			return "<img src=".$this->image. " />";
		else
			return "<fb:profile-pic uid=" . $id . " linked='true' />";
	}
	
	public function getImageSrc()
	{
		return $this->image;
	}



	/*************************************************************************
	 * Setters
	 * Seta o conteúdo de uma variável.
	 *************************************************************************/
	public function setNick			($value) { $this->nick		= $value; }
	public function setID			($value) { $this->id		= $value; }
	public function setPoints		($value) { $this->points	= $value; }
	public function setDescription		($value) { $this->description	= $value; }
	public function setImage		($value) { $this->image		= $value; }
	public function setDateCreated		($value = NULL)
	{ 
		if ($value == NULL)
		{
			$this->date_created = time();
		}
		else 
		{
			$this->date_created = $value;
		}
	}



	/*************************************************************************
	 * Getters
	 * Retorna o conteúdo de uma variável.
	 *************************************************************************/
	 public function getID				() { return $this->id; }
	 public function getNick			() { return $this->nick; }
	 public function getPoints			() { return $this->points; }
	 public function getDescription		() { return $this->description; }
	 public function getDateCreated		() { return $this->date_created; }
}
?>
