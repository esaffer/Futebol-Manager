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


class Invite extends Model {
	private $id;
	private $idInviter;
	private $idInvited;
	private $idTeam;
	private $status;
	private $userStatus;
	
	public	$db;
	private $base;
	private $table_name;



	/************************************************************************
	 * __construct
	 * Construtor da classe.
	 ************************************************************************/
	public function __construct ()
	{
		$this->table_name = DB_TABLE_INVITE;
		$this->db = new Database(DB_USER, DB_PASS, DB_NAME, DB_HOST);
	}



	/************************************************************************
	 * getInvite
	 * Pega todos os usuários de uma determinada equipe.
	 ************************************************************************/
	public function getInvite ($id)
	{
		$sql = "SELECT * from " . $this->table_name . " WHERE id = " . $id;
		$sql = $this->db->get_row($sql);		
		
		if ($sql->id != NULL)
		{
			$this->id 			= $sql->id;
			$this->idInviter	= $sql->idInviter;
			$this->idInvited	= $sql->idInvited;
			$this->idTeam	 	= $sql->idTeam;
			$this->status		= $sql->status;
			$this->userStatus	= $sql->userStatus;
			return True;	
		}
		else
			return False;
	}



	/************************************************************************
	 * getInviteInvited
	 * Pega um usuário já invitado para tal grupo
	 ************************************************************************/
	public function getInviteInvited ($idInvited,$idTeam)
	{
		$sql = "SELECT * from $this->table_name WHERE idInvited = $idInvited AND idTeam = $idTeam";
		$sql = $this->db->get_row($sql);

		if ($sql->id != NULL)
		{
			$this->id 		= $sql->id;
			$this->idInviter	= $sql->idInviter;
			$this->idInvited	= $sql->idInvited;
			$this->idTeam	 	= $sql->idTeam;
			$this->status		= $sql->status;
			$this->userStatus	= $sql->userStatus;
			return True;	
		}
		else
			return False;
	}



	/************************************************************************
	 * getListInvited
	 * Retorna a lista de invites você têm..
	 ************************************************************************/
	public function getListInvited($idInvited)
	{
		$this->db->query("SELECT * from " .  $this->table_name . " WHERE idInvited = " . $idInvited );
		return $this->db->get_results();
	}



	/************************************************************************
	 * getListInviter
	 * Retorna a lista de invites que certo user fez..
	 ************************************************************************/
	public function getListInviter($idInviter)
	{
		$this->db->query("SELECT * from " .  $this->table_name . " WHERE idInviter = " . $idInviter );
		return $this->db->get_results();
	}



	/************************************************************************
	 * getListTeam
	 * Retorna a lista de invites que certo Team tenha..
	 ************************************************************************/
	public function getListTeam($idTeam)
	{
		$this->db->query("SELECT * from " .  $this->table_name . " WHERE idTeam = " . $idTeam );
		return $this->db->get_results();
	}



	/************************************************************************
	 * getListStatus
	 * Retorna a lista de invites de um time conforme o status de aprovação (TRUE = Aprovado, FALSE = caso contrário)
	 ************************************************************************/
	public function getListStatus($idTeam, $status)
	{
		$this->db->query("SELECT * from $this->table_name WHERE idTeam= $idTeam AND status= $status");
		return $this->db->get_results();	
	}



	/************************************************************************
	 * setAll
	 * Seta as variáveis em um array antes de salvá-las.
	 ************************************************************************/
	private function setAll ()
	{
		$this->base = array (
			'status'		=> $this->status,
			'idTeam'		=> $this->idTeam,
			'idInviter'		=> $this->idInviter,
			'idInvited'		=> $this->idInvited,			
			'userStatus'		=> $this->userStatus,
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
			$this->messageFail("Ocorreu um erro ao criar o convite!");;
	}



	/**************************************************************************
	 * Edit
	 * Edita um invite.
	 **************************************************************************/
	public function Edit ($id = Null)
	{
		if (is_null($id))
		{
			$this->messageFail('É necessário informar um ID');
			return False;
		}
		
		$this->setAll();
		$sql = $this->createUpdateQuery($this->table_name, $this->base, $id);
		if ($this->db->query($sql))
			$this->messageOk("O convite foi aceitado com sucesso!");
		else
			$this->messageFail("Ocorreu um erro ao editar o convite");
	}



	/*************************************************************************
	 * SQL
	 * Código SQL referente a tabela da Classe.
	 *************************************************************************/
	public function SQL () {
		$sql = "CREATE TABLE " . $this->table_name . " (
					id			int(11) NOT NULL AUTO_INCREMENT,
					idInviter	bigint(20),
					idInvited	bigint(20) NOT NULL,
					idTeam		int(11),
					status		int(2) NOT NULL,
					userStatus	int(2) NOT NULL,
					PRIMARY KEY(id));";		
		return $sql;
	}


	/**************************************************************************
	 * delete
	 * Exclui um convite enviado.
	 **************************************************************************/
	public function delete ($id) 
	{
		if ($this->checkId($this->table_name, $id) == False) 
		{
			$this->messageFail("Não foi possivel deletar o convite.");
			return False;
		}
		else
		{
			$this->db->query("DELETE FROM " . $this->table_name . " WHERE id = $id");
			$this->messageOk("O convite foi excluído com sucesso!");
			return True;
		}
	}
	 /**************************************************************************
	 * deleteTeam
	 * Exclui um convite enviado.
	 **************************************************************************/
	public function deleteTeam ($idTeam) 
	{
		if ($idTeam == "") 
		{
			$this->messageFail("Não foi possivel deletar o convite.");
			return False;
		}
		else
		{
			$this->db->query("DELETE FROM " . $this->table_name . " WHERE idTeam = $idTeam");
			return True;
		}
	}



	/***************************************************************
	 * setters
	 * Seta o valor de uma variável.
	 ***************************************************************/
	public function setIDTeam		($value) { $this->idTeam	= $value; }
	public function setIDInviter	($value) { $this->idInviter	= $value; }
	public function setIDInvited	($value) { $this->idInvited	= $value; }
	public function setStatus	($value) { $this->status	= $value; }
	public function setUserStatus	($value) { $this->userStatus	= $value; }



	/*************************************************************************
	 * Getters
	 * Retorna o conteúdo de uma variável.
	 *************************************************************************/
	 public function getID			() { return $this->id; }
	 public function getIDTeam		() { return $this->idTeam; }
	 public function getIDInviter	() { return $this->idInviter; }
	 public function getIDInvited	() { return $this->idInvited; }
	 public function getStatus	() { return $this->status; }
	 public function getUserStatus	() { return $this->userStatus; }
}
?>
