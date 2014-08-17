<?php 

// Singleton class
class App_Util_DbManager
{
	private static $_instance;
	private $_db_server = false;
	
	private function __construct()
	{
		$this->_connect();
	}
	
	public function __destruct()
	{
		$this->_disconnect();
		self::$_instance = null;
	}
	
	public static function getInstance()
	{
		if(!self::$_instance)
			self::$_instance = new App_Util_DbManager();
			
		return self::$_instance;
	}
	
	private function _connect()
	{
		$dbPath = $_SERVER["DOCUMENT_ROOT"] . "/hotel_boston/db/info.mdb";
		
		if (!file_exists($dbPath)) {
			die("Could not find database file.");
		}
		
		try {
			$this->_db_server = new PDO("odbc:Driver={Microsoft Access Driver (*.mdb)}; Dbq=$dbPath; Uid=; Pwd=;");
		}
		catch(PDOException $e){
			echo $e->getMessage();
			self::$_instance = null;
		}
			
		return true;
	}
	
	private function _disconnect()
	{
		if(!$this->_db_server)
			return false;

		$this->_db_server = null;
		
		return true;		
	}
	
	public function getLink()
	{
		return $this->_db_server;
	}
	
	// Return the result query
	public function query($query)
	{
		return $this->_db_server->query ( $query );
		/* $result = $this->_db_server->query ( $query );
		return $result->fetchall(PDO::FETCH_ASSOC); */
	}
	
	// Return the number of affected rows
	public function save($query)
	{
		return $this->_db_server->exec( $query );
	}
	
} // End class