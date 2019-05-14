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
		<p><a href="Deconnection.php">DECONNEXION</a></p>
		<p class="palm"><img src="view/image/palm.png"></p>

		</div>
		<p class="logo"><img src="view/image/logo_mini.png"/></p>
		<hr/>
		<div class="container-fluid" id="content">
			<?php
			//menu user-------------------------------------------------------------------------------------

				if(isset($_SESSION["Statut"]))
				{
					echo "Bonjour ".$_SESSION["Nom"]." ".$_SESSION["Prenom"];
					if($_SESSION["Statut"]=="0" and !isset($_GET["enregistrement"]) AND !isset($_GET["verification"]) AND !isset($_GET["recherche"]))
					{
						require("view/AgentMenu.php");
					}

					if($_SESSION["Statut"]=="1" and !isset($_GET["enregistrement"]))
					{
						require("view/AdminMenu.php");
					}

				}
				else{
					header("location:index.php");
				}

			//-----------------------------------------------------------------------------------------------

			//page User--------------------------------------------------------------------------------------
				if(isset($_GET["enregistrement"]) AND $_SESSION["Statut"]==1)
				{
					$controler= new ControlerUser;
					$controler->ConRecordUser();
				}
				if($_SESSION["Statut"]==0)
				{
					if(isset($_GET["enregistrement"]))
					{
						echo '<p id="menu"><a href="index.php"><img src="view/image/menu.png"><br/>MENU PRINCIPAL</a></p>';
						$controler= new ControlerUser;
						$controler->ConRecordVisitor();
					}

					if(isset($_GET["verification"]))
					{
						echo '<p id="menu"><a href="index.php"><img src="view/image/menu.png"><br/>MENU PRINCIPAL</a></p>';
						require("view/VisitorVerificationView.php");
					}
					if(isset($_GET["recherche"]))
					{
							echo '<p id="menu"><a href="index.php"><img src="view/image/menu.png"><br/>MENU PRINCIPAL</a></p>';
							$controler = new ControlerUser;
							$controler-> conseachVisitor();
					}
				}

			//-------------------------------------------------------------------------------------------------
			?>
		</div>
	</body>
</html>
