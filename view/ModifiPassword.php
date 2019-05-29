<!DOCTYPE HTML>
<html>
<head>
	<title>MTPTCvizi</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/dateheure.js"></script>
		<script type="text/javascript" src="js/heure.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

</head>
	<body>
		<div id="bar2" class="container-fluid">
		<p><a href="../Deconnection.php">DECONNEXION</a></p>
		<p class="palm"><img src="image/palm.png"></p>

		</div>
		<p class="logo"><img src="image/logo_mini.png"/></p>
		<hr/>
		<div class="container-fluid" id="content">
			<div class="row">
			<div class="col-md-12">
				<h2>MODIFIER PASSWORD</h2>
				<p id="menu"><a href="../index.php"><img src="image/menu.png"><br/>MENU PRINCIPAL</a></p>
				<?php $ok=1;
					if(isset($_GET["val"])){

				?>
				<?php
				if(isset($_POST["password"]) and isset($_POST["passwordConfirm"]))
				{
					if($_POST["password"]!=$_POST["passwordConfirm"])
					{
						$ok=0;
					}
					else{
						if(isset($_GET["val"]))
						{

							require("../controler/Controler.php");
							$controler= new ControlerUser;
							$controler->Modif($_GET["val"]);
						}

					}
				}

				?>

					<form method="post" action="">
			      <p><input type="password" name="password" minlength="8" maxlength="20" size="50" placeholder="Nouveau Password"></p>
						<p>
							<input type="password" name="passwordConfirm" minlength="8" maxlength="20" size="50" placeholder="Confirmation Password">
							<?php
								if($ok==0)
								{
									echo"<br/><em>confirmation invalide veuillez entrer le même mots de passe dans les deux champs</em>";
								}
							?>
						</p>
						 <p><input type="submit" value="Modifier" class="btn"></p>
					</form>
					<?php
					}
					if(isset($_GET["001"]))
					{
						echo'<center><strong style="font-size:2em;">Mots de passe Modifier</strong></center>';

					}
				?>
			</div>
			</div>
	</div>
