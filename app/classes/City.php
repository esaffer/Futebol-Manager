<?
class Country {
	private $id;
	private $iso;
	private $iso3;
	private $name;
	
	public $db;
	private $base;
	
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
		$sql = "SELECT * FROM " . $this->table_name . " WHERE id = $id";
		if ($country = $this->db->get_row($sql))
		{
			$this->id	= $country->id;
			$this->iso	= $country->iso;
			$this->iso3	= $country->iso3;
			$this->name	= $country->name;
			return True;
		}
		else
		{
			return False;
		}
	}
	
	public function getId	() { return $this->id; }
	public function getName	() { return $this->name; }
	public function getIso	() { return $this->iso; }
	public function getIso3	() { return $this->iso3; }
}



class Region {
	private $id;
	private $country;
	private $name;
	
	public $db;
	private $base;
	
	public function __construct ()
	{
		$this->table_name = 'regions';
		$this->db = new Database(DB_USER, DB_PASS, DB_NAME, DB_HOST);
	}



	/*************************************************************************
	 * getRegion
	 * Pega o estado indicado pelo ID.
	 *************************************************************************/
	public function getRegion ($id)
	{
		$sql = "SELECT * FROM " . $this->table_name . " WHERE id = $id";
		if ($region = $this->db->get_row($sql))
		{
			$this->id			= $region->id;
			$this->name			= $region->name;
			$this->country		= $region->country_id;
			return True;
		}
		else
		{
			return False;
		}
	}


	public function getCountry ()
	{
		$country = new Country();
		return $country->getCountry($this->country);
	}
	
	public function getId		() { return $this->id; }
	public function getName		() { return $this->name; }
	public function getCountry	() { return $this->country; }
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
		$this->table_name = 'cities';
		$this->db = new Database(DB_USER, DB_PASS, DB_NAME, DB_HOST);
	}



	/*************************************************************************
	 * getRegion
	 * Pega o estado indicado pelo ID.
	 *************************************************************************/
	public function getCity ($id)
	{
		$sql = "SELECT * FROM " . $this->table_name . " WHERE id = $id";
		if ($city = $this->db->get_row($sql))
		{
			$this->id		= $region->id;
			$this->name		= $region->name;
			$this->region	= $this->region;
			return True;
		}
		else
		{
			return False;
		}
	}



	public function getRegion ()
	{
		$region = new Region();
		return $region->getRegion($this->region);
	}



	public function getCountry ($id)
	{
		return $this->getRegion-()->getCountry();
	}



	public function getId		() { return $this->id; }
	public function getName		() { return $this->name; }
}
?>
