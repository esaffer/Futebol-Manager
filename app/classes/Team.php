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
 

class Team extends Model {	
	private $id;
	private $nome;	
	private $descricao;
	private $dataCadastro;
	private $regras;
	private $local;
	private $privado;
	private $idOwner;
	
	private $base;
	public $db;
	private $table_name;
	
	
	/************************************************************************
	 * __construct
	 * Construtor da classe.
	 ************************************************************************/
	public function __construct () {
		// Seta o nome da tabela no banco de dados
		$this->table_name = 'grupo';
		$this->db = new Database(DB_USER, DB_PASS, DB_NAME, DB_HOST);
	}
	
	
	public function getGrupo ($id) {
		
		$sql = "SELECT * from " . $this->table_name . " WHERE id = " . $id;
		$sql = $this->db->get_row($sql);		
		
		if ($sql->id != NULL) {
		
			$this->id 		= $sql->id;
			$this->idOwner 		= $sql->idOwner;
			$this->nome		= $sql->nome;
			$this->regras		= $sql->regras;
			$this->descricao 	= $sql->descricao;
			$this->dataCadastro 	= $sql->datacadastro;
			$this->local	 	= $sql->local;
			$this->privado	 	= $sql->privado;
			return True;
		}
		else {
			return False;
		}
	}
	
	public function getGrupoOwner ($idOwner) {
		
		$sql = "SELECT * from " . $this->table_name . " WHERE idowner = " . $idOwner;
		$sql = $this->db->get_row($sql);		
		
		if ($sql->id != NULL) {
		
			$this->id 		= $sql->id;
			$this->idOwner 		= $sql->idOwner;
			$this->nome		= $sql->nome;
			$this->regras		= $sql->regras;
			$this->descricao 	= $sql->descricao;
			$this->dataCadastro 	= $sql->datacadastro;
			$this->local	 	= $sql->local;
			$this->privado	 	= $sql->privado;
			return True;
		}
		else {
			return False;
		}
	}
	
	//Falta testar...
	public function getListaGrupoOwner($idOwner)
	{
		$groups = array ();
		$this->db->query("SELECT * from " .  $this->table_name . " WHERE idowner = " . $idOwner );
		return $this->db-get_results();
	}
	
	
	private function setAll ()
	{
		$this->base = array (
			'nome'		=> $this->nome,
			'local'		=> $this->local,
			'descricao' 	=> $this->descricao,
			'datacadastro' 	=> $this->dataCadastro,
			'privado' 	=> $this->privado,
			'regras' 	=> $this->regras,
			'idOwner'	=> $this->idOwner
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
			$this->messageOk("O grupo <b>" . $this->apelido . "</b> foi adicionado com sucesso!");
		else
			$this->messageFail("Ocorreu um erro ao adicionar o grupo.");
	}
	
	public function getImage()
	{
		return "<img src=http://knuth.ufpel.edu.br/tiago/trunk/aux/noImage.jpg>"; //Provisório
	}
	
	
	/***************************************************************
	 * setters
	 * 
	 ***************************************************************/
	public function setNome 	($valor){$this->nome 		= $valor; }	
	public function setRegras 	($valor){$this->regras		= $valor; }
	public function setDescricao 	($valor){$this->descricao 	= $valor; }
	public function setPrivado 	($valor){$this->privado 	= $valor; }
	public function setLocal 	($valor){$this->local 		= $valor; }
	public function setIDOwner 	($valor){$this->idOwner		= $valor; }
	public function setDataCadastro	() 	{$this->dataCadastro 	= date("o-m-d");}
	
	
	/*************************************************************************
	 * Getters
	 * Retorna o conteúdo de uma variável.
	 *************************************************************************/
	 public function getID			() { return $this->id; }
	 public function getNome		() { return $this->nome; }
	 public function getRegras		() { return $this->regras; }
	 public function getDescricao		() { return $this->descricao; }
	 public function getDataCadastro	() { return $this->dataCadastro; }
	 public function getLocal		() { return $this->local; }
	 public function getPrivado		() { return $this->privado; }
	 public function getIDOwner		() { return $this->idOwner; }
}
?>
