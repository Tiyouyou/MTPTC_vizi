<?php
if(isset($_POST["desactive"]))
{
  if(isset($_POST["val"]))
  {
    require("Connectiondb.php");
    $con=Connection();
    $id=$_POST["val"];
    $sql=$con->query("UPDATE `utlisateur` SET `Active`=1  WHERE `Id_utilisateur`='$id' ");
    header("location:../index.php?recherche");
  }

}

if(isset($_POST["active"]))
{
  if(isset($_POST["val"]))
  {
    require("Connectiondb.php");
    $con=Connection();
    $id=$_POST["val"];
    $sql=$con->query("UPDATE `utlisateur` SET `Active`=0  WHERE `Id_utilisateur`='$id' ");
    header("location:../index.php?recherche");
  }

}
?>
