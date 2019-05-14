<?php
  function VAcount($user,$password)
  {
    if(isset($user) and isset($password))
    {
      require("model/Connectiondb.php");
      $con=$connect();
      $sql=$con->query("SELECT `Nom_utilisateur`, `Password`FROM `utlisateur` WHERE `Nom_utilisateur`='$user' AND `Password`='$password'");

      while($User=$sql->fetch())
      {

        if(!isset($User["Nom_utilisateur"]))
        {
          echo "Identifiant Incorrecte";
        }
      }
    }
  }
?>
