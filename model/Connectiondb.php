<?php
	//connection to database
	function Connection()
	{
		$host="localhost";
		$dbna="mtptc_vizidb";
		$name="root";
		$pass="";
		try {
   			 $conn= new PDO('mysql:host='.$host.';dbname='.$dbna.'',''.$name.'',''.$pass.'');
   			 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e) {
		    echo 'Error : ' .$e->getMessage();
		}
		return $conn;
	}
