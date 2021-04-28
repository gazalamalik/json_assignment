<?php

class DB {  

    public $db;

    public function __construct() {
	     $host = "host = 127.0.0.1";
	     $port = "port = 5432";
	     $dbname = "dbname =mini_project";
	     $credentials = "user = postgres password=postgres";
 
	     $this->db = pg_connect( "$host $port $dbname $credentials"  );
	            if(!$this->db) {
	                 echo "Error : Unable to open database\n";
	            } else {
                    echo "Connected successfully\n";
	            }
    }
    
   

	public function query($sql) {
		$ret = pg_query($this->db, $sql);
		//$rows = pg_num_rows($ret);
		return $ret;
	}



}
	
 ?>
	
   
   

