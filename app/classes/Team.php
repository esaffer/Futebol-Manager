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
	private $name = null;	
	private $team = array ();
	
	
	public function __construct {
		
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
