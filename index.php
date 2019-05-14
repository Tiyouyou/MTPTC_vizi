<?php
	session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>MTPTCvizi</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="view/js/jquery-3.3.1.min.js"></script>
    <script src="view/js/bootstrap.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="view/css/bootstrap.min.css">
    <link href="view/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="view/css/style.css">
</head>
<body>
	<?php
	//
		require("controler/Controler.php");
		$controler= new ControlerUser;
		if(!isset($_SESSION["UserName"]) AND !isset($_SESSION["Password"]))
		{

			$controler->connectionControler();
		}
		else
		{
			require("view/UserView.php");
		}
		//mysql_close($con);
	?>

</body>
</html>
