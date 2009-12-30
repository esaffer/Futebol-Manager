<?
/*****************************************************************************
 *                            Futebol Manager                                *
 *****************************************************************************
 * Classe que define os grupos de usuários de um time.
 *
 * Autor:	Bruno Martins Rodrigues <bruno@thearmpit.net>
 *			Eduardo Saffer Medvedovsk <emedevas@gmail.com>
 *			Thiago Trojahn <troid16@gmail.com>
 *
 * Data:	21 de Dezembro de 2009
 *****************************************************************************/
 
class Team extends Model {
	private $name;
	private $team;
	
	private $base;
	
	
	public function __construct {
		$this->table_name = DB_PREFIX . 'team';
		$this->db = new Database(DB_USER, DB_PASS, DB_NAME, DB_HOST);
	}
	
	
	/***************************************************************
	 * setName
	 * Seta o nome da equipe.
	 ***************************************************************/
	public function setName ($name) {
		$this->name = $name;
	}
	
	
	
	/***************************************************************
	 * addPlayer
	 * Adiciona um jogador a um grupo.
	 *
	 * @param	$player_id		ID do jogador.
	 ***************************************************************/
	public function addPlayer ($player_id) {
		
	}
	
	
	
	/***************************************************************
	 * removePlayer
	 * Remove um jogador do grupo.
	 * 
	 * @param	$player_id		ID do jogador.
	 ***************************************************************/
	public function removePlayer ($player_id) {
	
	}



	/***************************************************************
	 * countPlayers
	 * Retorna o número de jogadores no grupo.
	 ***************************************************************/
	 public function countPlayers ()
	 {
	 	
	 }
}
?>
