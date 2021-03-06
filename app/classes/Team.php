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
	private $name;
	private $description;
	private $date_created;
	private $rules;
	private $place;
	private $privative;
	private $id_owner;
	private $image;

	public	$db;
	private $base;
	private $table_name;



	/************************************************************************
	 * __construct
	 * Construtor da classe.
	 ************************************************************************/
	public function __construct () {
		$this->table_name = DB_TABLE_TEAM;
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
		{
			$this->id 			= $sql->id;
			$this->name			= $sql->name;
			$this->rules			= $sql->rules;
			$this->description 		= $sql->description;
			$this->date_created		= $sql->date_created;
			$this->image 			= $sql->image;
			$this->id_owner			= $sql->id_owner;
			$this->privative		= $sql->privative;
			$this->place 			= $sql->place;
			return True;
		
		
			return True;
		}			
		else
			return False;
	}




	/************************************************************************
	 * getAll
	 * Retorna a lista com todas as equipes.
	 ************************************************************************/
	public function getAll () {
		$sql = "SELECT * from " . $this->table_name . " ORDER BY name";
		$this->db->query($sql);
		return $this->db->get_results();
	}
	


	/************************************************************************
	 * getTeamOwner
	 * Pega o dono do grupo.
	 ************************************************************************/
	public function getTeamOwner ()
	{
		if($this->id_owner != NULL)
		{
			$user = new User();
			$user->getUser($this->id_owner);
		
			return $user;
		}
		else
			return False;
	}
	
	
	/************************************************************************
	 * getTeamOwnerName
	 * Retorna o nome do Owner do time.
	 ************************************************************************/
	public function getTeamOwnerName ()
	{
		if($this->id_owner != NULL)
		{
			$user = new User();
			$user->getUser($this->id_owner);		
			return $user->getNick();
		}
		else
			return False;
	}



	/************************************************************************
	 * getListTeamOwner
	 * Retorna os grupos que o membro é dono.
	 ************************************************************************/
	public function getListTeamOwner($idOwner)
	{
		$this->db->query("SELECT * from $this->table_name WHERE id_owner = $idOwner ORDER BY name ");
		return $this->db->get_results();
	}



	/************************************************************************
	 * setAll
	 * Seta as variáveis em um array antes de salvá-las.
	 ************************************************************************/
	private function setAll ()
	{
		$this->base = array (
			'name'			=> $this->name,
			'place'			=> $this->place,
			'privative'		=> $this->privative,
			'description'		=> $this->description,
			'date_created'		=> $this->date_created,
			'rules'			=> $this->rules,
			'id_owner'		=> $this->id_owner,
			'image'			=> $this->image,
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
			$this->messageFail("Ocorreu um erro ao adicionar a equipe.");			
	}
		
	public function getListPublic() 
	{
		$this->db->query("SELECT * from " .  $this->table_name . " WHERE privative = 0 ORDER BY name");
		return $this->db->get_results();	
	}

	public function getListSearch($name) 
	{
		$name_temp = "'%".$name."%'";
		$this->db->query("SELECT * from ". $this->table_name." WHERE privative = 0 AND name LIKE ".$name_temp." ORDER BY name");
		return $this->db->get_results();	
	}


	/*************************************************************************
	 * getImage
	 * Retorna a imagem que representa a equipe
	 *************************************************************************/
	public function getImage ()
	{
		if($this->image != "")
			return "<img src=".$this->image. " />";
		else
			return "<img src='http://knuth.ufpel.edu.br/tiago/images/noImage.jpg' alt='No Image' />";
	}
	
	public function getImageSrc()
	{
		return $this->image;
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
		$sql = $this->createUpdateQuery($this->table_name, $this->base, $id);
		
		if ($this->db->query($sql))
			$this->messageFail("Ocorreu um erro ao editar a equipe...");			
	}



	/*************************************************************************
	 * SQL
	 * Código SQL referente a tabela da Classe.
	 *************************************************************************/
	public function SQL () {
		$sql = "CREATE TABLE " . $this->table_name . " (
					id			int(11) NOT NULL AUTO_INCREMENT,
					id_owner		bigint(11) NOT NULL,
					name			varchar(100) NOT NULL ,
					description		text,
					rules			text,
					date_created		datetime NOT NULL,
					place			mediumint(9),
					privative		bool,
					image			varchar(255),
					
					UNIQUE KEY id (id));";
		
		return $sql;
	}
	
	/**************************************************************************
	 * deleteAll
	 * Deleta todos as ocorrências de determinado jogo em determinado time....
	 **************************************************************************/	
	public function delete( $idTeam) 
	{	
		if($idTeam == "")
		{
			$this->messageFail("Ocorreu um erro ao deletar dados do jogo");
		}	
		else
		{
			$this->db->query("DELETE FROM " . $this->table_name . " WHERE id = $idTeam");
			return True;
		}
	}



	/***************************************************************
	 * setters
	 * Seta o valor de uma variável.
	 ***************************************************************/
	public function setName			($value) { $this->name 		= $value; }
	public function setRules		($value) { $this->rules		= $value; }
	public function setDescription 	($value) { $this->description 	= $value; }
	public function setPrivative 	($value) { $this->privative 	= $value; }
	public function setPlace 		($value) { $this->place		= $value; }
	public function setIDOwner 		($value) { $this->id_owner	= $value; }
	public function setImage		($value) { $this->image 	= $value; }
	public function setDateCreated	($value = NULL)
	{
		if ($value == NULL)
			$this->date_created = date('Y-m-d H:i:s');
		else
			$this->date_created = $value;
	}
	
	
	/*************************************************************************
	 * Getters
	 * Retorna o conteúdo de uma variável.
	 *************************************************************************/
	 public function getID				() { return $this->id; }
	 public function getName			() { return $this->name; }
	 public function getRules			() { return $this->rules; }
	 public function getDescription			() { return $this->description; }
	 public function getDateCreated			() { return strtotime($this->date_created); }
	 public function getPlace			() { return $this->place; }
	 public function getPrivative			() { return $this->privative; }
	 public function getIDOwner			() { return $this->id_owner; }
}
?>
