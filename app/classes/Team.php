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

	public	$db;
	private $base;
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



	/************************************************************************
	 * getTeam
	 * Pega todos os usuários de uma determinada equipe.
	 ************************************************************************/
	public function getTeam ($id)
	{
		$sql = "SELECT * from " . $this->table_name . " WHERE id = " . $id;
		$sql = $this->db->get_row($sql);		
		
		if ($sql->id != NULL)
			return $sql;
		else
			return False;
	}



	/************************************************************************
	 * getTeamOwner
	 * Pega o dono do grupo.
	 ************************************************************************/
	public function getTeamOwner ($idOwner)
	{
		$sql = "SELECT * from " . DB_TABLE_USERS . " WHERE id = " . $idOwner;
		$sql = $this->db->get_row($sql);
		
		if ($sql->id != NULL)
			return $sql;
		else
			return False;
	}



	/************************************************************************
	 * getListTeamOwner
	 * Retorna os grupos que o membro é dono.
	 ************************************************************************/
	public function getListTeamOwner($idOwner)
	{
		$this->db->query("SELECT * from " .  $this->table_name . " WHERE idowner = " . $idOwner );
		return $this->db->get_results();
	}



	/************************************************************************
	 * setAll
	 * Seta as variáveis em um array antes de salvá-las.
	 ************************************************************************/
	private function setAll ()
	{
		$this->base = array (
			'nome'			=> $this->nome,
			'local'			=> $this->local,
			'privado' 		=> $this->privado,
			'descricao' 	=> $this->descricao,
			'datacadastro' 	=> $this->dataCadastro,
			'regras' 		=> $this->regras,
			'idOwner'		=> $this->idOwner,
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



	/*************************************************************************
	 * getImage
	 * Retorna a imagem que representa a equipe
	 * TODO: Remover o link temporário da imagem.
	 *************************************************************************/
	public function getImage()
	{
		return "<img src='http://knuth.ufpel.edu.br/tiago/images/noImage.jpg' alt='No Image' />";
	}



	/**************************************************************************
	 * Edit
	 * Edita os dados de um grupo.
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
			$this->messageOk("A equipe <b>" . $this->nome . "</b> foi editado com sucesso!");
		else
			$this->messageFail("Ocorreu um erro ao editar a equipe...");
	}



	/***************************************************************
	 * setters
	 * 
	 ***************************************************************/
	public function setNome 		($valor){$this->nome 		= $valor; }
	public function setRegras 		($valor){$this->regras		= $valor; }
	public function setDescricao 	($valor){$this->descricao 	= $valor; }
	public function setPrivado 		($valor){$this->privado 	= $valor; }
	public function setLocal 		($valor){$this->local 		= $valor; }
	public function setIDOwner 		($valor){$this->idOwner		= $valor; }
	
	public function setDataCadastro	($valor = NULL) 
	{	
		if($valor == NULL)
			$this->dataCadastro = date("o-m-d");
		else
			$this->dataCadastro = $valor;
	}
	
	
	/*************************************************************************
	 * Getters
	 * Retorna o conteúdo de uma variável.
	 *************************************************************************/
	 public function getID				() { return $this->id; }
	 public function getNome			() { return $this->nome; }
	 public function getRegras			() { return $this->regras; }
	 public function getDescricao		() { return $this->descricao; }
	 public function getDataCadastro	() { return $this->dataCadastro; }
	 public function getLocal			() { return $this->local; }
	 public function getPrivado			() { return $this->privado; }
	 public function getIDOwner			() { return $this->idOwner; }
}
?>
