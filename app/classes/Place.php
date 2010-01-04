<?
class Place extends Model {
	private $id;
	private $city_id;
	private $name;
	private $description;
	private $created_by;
	private $coords_x;
	private $coords_y;
	private $date_created;
	
	public $db;
	private $base;
	private $table_name;



	public function __construct ()
	{
		$this->table_name = DB_TABLE_PLACES;
		$this->db = new Database(DB_USER, DB_PASS, DB_NAME, DB_HOST);
	}



	/*************************************************************************
	 * getPlace
	 * Retorna o local designado pelo ID.
	 *************************************************************************/
	private function getPlace ($id)
	{
		$sql = "SELECT * from " . $this->table_name . " WHERE id = " . $id;
		$sql = $this->db->get_row($sql);

		if ($sql->id != NULL)
		{
			$this->id			= $sql->id;
			$this-city_id		= $sql->city_id;
			$this->name			= $sql->name;
			$this->description	= $sql->description;
			$this->created_by	= $sql->created_by;
			$this->latitude		= $sql->latitude;
			$this->longitude	= $sql->longitude;
			$this->date_created	= $sql->date_created;
			return True;
		}
		else {
			return False;
		}
	}
}
?>
