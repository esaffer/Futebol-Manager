<?
class Country {
	private $id;
	private $name;
	
	public $db;
	
	public function __construct ()
	{
		$this->table_name = 'countries';
		$this->db = new Database(DB_USER, DB_PASS, DB_NAME, DB_HOST);
	}



	/*************************************************************************
	 * getCountry
	 * Pega o país indicado pelo ID.
	 *************************************************************************/
	public function getCountry ($id)
	{
		$sql = "SELECT id, name FROM " . $this->table_name . " WHERE id = $id";
		$this->db->query($sql);
	}



	/*************************************************************************
	 * SQL
	 * Tabela SQL.
	 *************************************************************************/
	public function SQL ()
	{
		
	}
}



class Region {
	
}

class City {
	private $id;
	private $country_id;
	private $region_id;
	private $city;
	private $latitude;
	private $longitude;
	
	public function __construct ()
	{
		
	}
}
?>
