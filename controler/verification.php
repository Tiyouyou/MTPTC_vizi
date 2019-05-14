function VAcount()
{
  require("model/Connectiondb.php");
  $con=$connect();
  $sql=$connect->query("SELECT  `Nom_utilisateur`, `Password`FROM utlisateur");
}
