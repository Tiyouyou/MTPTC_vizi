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
		<div id="bar2" class="container-fluid">
		<p class="palm"><img src="view/image/palm.png"></p>
		<p><a href="Deconnection.php">DECONNEXION</a></p>
		</div>
		<p class="logo"><img src="view/image/logo_mini.png"/></p>
		<hr/>
		<div class="container-fluid" id="content">
			<?php
			//menu user-------------------------------------------------------------------------------------
				if(isset($_SESSION["Statut"]))
				{
					if($_SESSION["Statut"]==0 and !isset($_GET["enregistrement"]))
					{
						require("view/AgentMenu.php");
					}

					if($_SESSION["Statut"]==1)
					{
						require("view/AdminMenu.php");
					}
					
				}

			//-----------------------------------------------------------------------------------------------

			//page User--------------------------------------------------------------------------------------
				if(isset($_GET["enregistrement"]))
				{
					require("view/RecordVisitorView.php");
				}
			//-----------------------------------------------------------------------------------------------
			?>
		</div>
	</body>
</html>