<?
/******************************************************************************
 * Class		: User
 * Description	: Define o comportamento e criação do usuário no site.
 ******************************************************************************/

class User extends Model {
	private $id;
	private $apelido;
	private $points;
	private $descricao;
	private $dataCadastro;
	
	private $base;
	public $db;
	private $table_name;
	
	
	
	/************************************************************************
	 * __construct
	 * Construtor da classe.
	 ************************************************************************/
	public function __construct () {
		// Seta o nome da tabela no banco de dados
		$this->table_name = 'user';
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
		
			$this->id 		= $sql->id;
			$this->apelido		= $sql->apelido;
			$this->points		= $sql->points;
			$this->descricao 	= $sql->descricao;
			$this->dataCadastro 	= $sql->datacadastro;
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
			'id' 		=> $this->id,
			'apelido'	=> $this->apelido,
			'points'	=> $this->points,
			'descricao' 	=> $this->descricao,
			'datacadastro' 	=> $this->dataCadastro
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
			$this->messageOk("O usuário <b>" . $this->apelido . "</b> foi adicionado com sucesso!");
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
		$this->messageOk("O usuário <b>" . $this->apelido . "</b> foi editado com sucesso!");
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
	 /*
	public function createDatabase () {
		// Código SQL da tabela ----------------------------------------------
		$sql	= "CREATE TABLE " . $this->table_name . " (
					id			mediumint(9) NOT NULL AUTO_INCREMENT,
					fid			varchar(64),
					name		varchar(90),
					points		mediumint(9),
					status		mediumint(9),
					
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
	*/
	/*************************************************************************
	 * getImage
	 * Retorna a imagem do perfil do usuário
	 *************************************************************************/	
	public function getImage()
	{
		
		return "<img src=http://knuth.ufpel.edu.br/tiago/images/noImage.jpg>"; //Provisório
	//	return "<fb:profile-pic uid=" . $idUserFacebook . " linked="true" />";
	//Tornar o $idUserFacebook visível aqui!
	}
	
	
	
	
	/*************************************************************************
	 * Setters
	 * Seta o conteúdo de uma variável.
	 *************************************************************************/
	public function setApelido	($value) { $this->apelido	= $value; }
	public function setID		($value) { $this->id		= $value; }
	public function setPoints	($value) { $this->points	= $value; }
	public function setDescricao	($value) { $this->descricao	= $value; }
	
	public function setDataCadastro	($value = NULL) 
	{ 
		if($value == NULL)
			$this->dataCadastro	= date("o-m-d");
		else
			$this->dataCadastro	= $value;
	}
	
	
	
	/*************************************************************************
	 * Getters
	 * Retorna o conteúdo de uma variável.
	 *************************************************************************/
	 public function getID			() { return $this->id; }
	 public function getApelido		() { return $this->apelido; }
	 public function getPoints		() { return $this->points; }
	 public function getDescricao		() { return $this->descricao; }
	 public function getDataCadastro	() { return $this->dataCadastro; }
}
?>
