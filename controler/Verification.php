<?php
if(isset($_POST["val"]) AND isset($_POST["sorti"]))
{
  require("../model/Connectiondb.php");
  $connect=Connection();
  $id=htmlspecialchars($_POST["val"]);
  $sql2=$connect->query("UPDATE `visite` SET `sorti`=1 WHERE `Id_visiteur`='$id' AND `sorti`=0");
  header("location:../index.php?verification");
}
?>
