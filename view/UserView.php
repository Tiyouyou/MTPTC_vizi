<!DOCTYPE HTML>
<html>
<head>
	<title>MTPTCvizi</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="view/js/jquery-3.3.1.min.js"></script>
    <script src="view/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="view/js/dateheure.js"></script>
		<script type="text/javascript" src="view/js/heure.js"></script>
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
			<div id="revey">
				<P><img src="view/image/revey.png"/></p>
				<p id="heure" class="heure"></p>
				<script type="text/javascript">window.onload = heure('heure');</script>
			</div>
			<?php
			//menu user-------------------------------------------------------------------------------------

				if(isset($_SESSION["Statut"]))
				{
					echo "Bonjour ".$_SESSION["Nom"]." ".$_SESSION["Prenom"];
					if($_SESSION["Statut"]=="0" and !isset($_GET["enregistrement"]) AND !isset($_GET["verification"]) AND !isset($_GET["recherche"]) and !isset($_GET["rapport"]) and !isset($_GET["enVisit"]))
					{
						require("view/AgentMenu.php");
					}

					if($_SESSION["Statut"]=="1" and !isset($_GET["enregistrement"]) AND !isset($_GET["verification"]) AND !isset($_GET["recherche"]) and !isset($_GET["rapport"])and !isset($_GET["modification"]))
					{
						require("view/AdminMenu.php");
					}
					if($_SESSION["Statut"]=="2" and !isset($_GET["recherche"]) and !isset($_GET["rapport"]) AND !isset($_GET["verification"]) )
					{
						require("view/DirectionView.php");
					}
				}
				else{
					header("location:index.php");
				}

			//-----------------------------------------------------------------------------------------------

			//page User--------------------------------------------------------------------------------------
				//admin..............................................
				if($_SESSION["Statut"]==1)
				{
					if(isset($_GET["enregistrement"]))
					{
						echo '<p id="menu"><a href="index.php"><img src="view/image/menu.png"><br/>MENU PRINCIPAL</a></p>';
						$controler= new ControlerUser;
						$controler->ConRecordUser();
					}
					if(isset($_GET["rapport"]))
					{
						echo '<p id="menu"><a href="index.php"><img src="view/image/menu.png"><br/>MENU PRINCIPAL</a></p>';
						$controler= new ControlerUser;
						$controler->ConRapportAdmin();
					}
					if(isset($_GET["recherche"]))
					{
						echo '<p id="menu"><a href="index.php"><img src="view/image/menu.png"><br/>MENU PRINCIPAL</a></p>';
						$controler= new ControlerUser;
						$controler->conseach();
					}

					if(isset($_GET["verification"]))
					{
						echo '<p id="menu"><a href="index.php"><img src="view/image/menu.png"><br/>MENU PRINCIPAL</a></p>';
						require("view/VisitorVerificationView.php");
					}
				}
				//agent.............................................................................
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
					if(isset($_GET["rapport"]))
					{
						echo '<p id="menu"><a href="index.php"><img src="view/image/menu.png"><br/>MENU PRINCIPAL</a></p>';
						$controler = new ControlerUser;
						$controler->conchekRapport();
					}
					if(isset($_GET["enVisit"]))
					{
						echo '<p id="menu"><a href="index.php"><img src="view/image/menu.png"><br/>MENU PRINCIPAL</a></p>';
						$controler = new ControlerUser;
						$controler->ConRvisite();
					}
				}
				if($_SESSION["Statut"]==2)
				{
						if(isset($_GET["rapport"]))
						{
							echo '<p id="menu"><a href="index.php"><img src="view/image/menu.png"><br/>MENU PRINCIPAL</a></p>';
							$controler = new ControlerUser;
							$controler->conchekRapport();
						}
						if(isset($_GET["verification"]))
						{
							echo '<p id="menu"><a href="index.php"><img src="view/image/menu.png"><br/>MENU PRINCIPAL</a></p>';
							require("view/VisitorVerificationView.php");
						}
				}

			//-------------------------------------------------------------------------------------------------
			?>

		</div>
		<footer>

			<p class="actulite"><img src="view/image/actualite_bar.png"></p>
			<MARQUEE BGCOLOR="ffb101" id="date_heure">	</MARQUEE>
			<script type="text/javascript">window.onload = date_heure('date_heure');</script>
			<MARQUEE BGCOLOR="910909" id="ac1" class="vizi">	</MARQUEE>
			<script src="view/js/listevisiteur.js"></script>
		</footer>
	</body>
</html>
