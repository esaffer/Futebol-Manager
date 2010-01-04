<?php
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

	public	$db;
	private $base;
	private $table_name;

	/************************************************************************
	 * __construct
	 * Construtor da classe.
	 ************************************************************************/
	public function __construct () {
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
			$this->id 		= $sql->id;
			$this->idInviter	= $sql->idInviter;
			$this->idInvited	= $sql->idInvited;
			$this->idTeam	 	= $sql->idTeam;
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
	 * setAll
	 * Seta as variáveis em um array antes de salvá-las.
	 ************************************************************************/
	private function setAll ()
	{
		$this->base = array (
			'idTeam'		=> $this->idTeam,
			'idInviter'		=> $this->idInviter,
			'idInvited'		=> $this->idInvited,
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
			$this->messageOk("O User foi convidado com sucesso!");
		else
			$this->messageFail("Ocorreu um erro ao convidar o user.");
	}



	/*************************************************************************
	 * SQL
	 * Código SQL referente a tabela da Classe.
	 *************************************************************************/
	public function SQL () {
		$sql = "CREATE TABLE " . $this->table_name . " (
					id			int(11) NOT NULL AUTO_INCREMENT,
					idInviter	bigint(11) NOT NULL,
					idInvited	bigint(11) NOT NULL,
					idTeam		int(11),
					PRIMARY KEY(id));";		
		return $sql;
	}



	/***************************************************************
	 * setters
	 * Seta o valor de uma variável.
	 ***************************************************************/
	public function setIDTeam		($value) { $this->idTeam	= $value; }
	public function setIDInviter	($value) { $this->idInviter	= $value; }
	public function setIDInvited	($value) { $this->idInvited	= $value; }



	/*************************************************************************
	 * Getters
	 * Retorna o conteúdo de uma variável.
	 *************************************************************************/
	 public function getID			() { return $this->id; }
	 public function getIDTeam		() { return $this->idTeam; }
	 public function getIDInviter	() { return $this->idInviter; }
	 public function getIDInvited	() { return $this->idInvited; }
}
?>