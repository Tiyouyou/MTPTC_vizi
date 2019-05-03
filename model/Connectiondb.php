<?php
	//connection to database
	function Connection()
	{
		try {
   			 $conn= new PDO('mysql:host=localhost;dbname=mtptc_vizidb','root','');
   			 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e) {
		    echo 'Error : ' .$e->getMessage();
		}
		return $conn;
	}