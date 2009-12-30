<?
/******************************************************************************
 * Class		: User
 * Description	: Define o comportamento e criação do usuário no site.
 ******************************************************************************/

class User extends Model {
	private $facebook;
	private $name;
	private $position;
	private $points;
	
	private $base;
	private $db;
	private $table_name;
	
	
	
	/************************************************************************
	 * __construct
	 * Construtor da classe.
	 ************************************************************************/
	public function __construct () {
		// Seta o nome da tabela no banco de dados
		$this->table_name = DB_PREFIX . 'data_user';
		$this->db = new Database(DB_USER, DB_PASS, DB_NAME, DB_HOST);
	}
	
	
	
	
	/*************************************************************************
	 * getUser
	 * Procura um usuário.
	 *************************************************************************/
	public function getUser ($fid) {
		$this->sql = "SELECT * from " . $this->table_name . " WHERE fid = " . $fid;
		$this->sql = $this->db->query($sql);
		
		if ($sql) {
			$this->fid		= $sql['fid'];
			$this->name		= $sql['name'];
			$this->status	= $sql['status'];
			$this->points	= $sql['points'];
			
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
			'fid' 		=> $this->facebook,
			'name'		=> $this->name,
			'status'	=> $this->status,
			'points'	=> $this->points,
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
			$this->messageOk("O usuário <b>" . $this->name . "</b> foi adicionado com sucesso!");
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
		$sql = $this->createUpdateQuery($this->table_name, $this->article_base, $id);
		
		if ($this->db->query($sql))
		$this->messageOk("O usuário <b>" . $this->name . "</b> foi editado com sucesso!");
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
	 * createDatabase
	 * Verifica se existe e depois cria o banco de dados, caso necessário.
	 *************************************************************************/
	public function createDatabase () {
		// Código SQL da tabela ----------------------------------------------
		$sql	= "CREATE TABLE " . $this->table_name . " (
					id			mediumint(9) NOT NULL AUTO_INCREMENT,
					fid			varchar(64),
					points		mediumint(9),
					position	mediumint(9),
					
					UNIQUE KEY id (id));";
		
		// Checa se existe, senão, cria a tabela -----------------------------
		if ($this->db->get_var("show tables like '" . $this->table_name . "'") == $this->table_name) {
			$this->messageFail('A tabela já existe.');
		}
		else {
			$this->db->query($sql);
			$this->messageOk('A tabela de <b>Usuários</b> foi criada com sucesso!');
		}
		
	}
	
	
	
	
	/*************************************************************************
	 * Setters
	 * Seta o conteúdo de uma variável.
	 *************************************************************************/
	public function setPosition	($value) { $this->position	= $value; }
	public function setName		($value) { $this->name		= $value; }
	public function setFacebook	($value) { $this->facebook	= $value; }
	public function setPoints	($value) { $this->points	= $value; }
	
	
	
	
	/*************************************************************************
	 * Getters
	 * Retorna o conteúdo de uma variável.
	 *************************************************************************/
	 public function getFacebook	() { return $this->facebook; }
	 public function getName		() { return $this->name; }
	 public function getPosition	() { return $this->position; }
	 public function getPoints		() { return $this->points; }
}
?>
