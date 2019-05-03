<?php

	/**
	* 
	*/
	class UserModel
	{
		
		function UserConnection($user,$password)
		{
			require("model/Connectiondb.php");
			
			$connect=Connection();
			if($user!=NULL and $password!=NULL)
			{
				
				$l=$connect->query("SELECT * FROM `user` WHERE UserName='$user' AND Password='$password'");
				while ($user=$l->fetch()) {
					$_SESSION["UserName"]=$user["UserName"];
					$_SESSION["Password"]=$user["Password"];
					$_SESSION["Statut"]=$user["Statut"];
				}
				
			}
			
		}
	}