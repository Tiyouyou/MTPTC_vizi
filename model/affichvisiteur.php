<?php
require("connectiondb.php");
$conn=Connection();
$p=1;
$ok=0;
echo"<p>LISTE VISITEUR DANS LE MINISTERE</p>";
$sql=$conn->query("SELECT R.Id_visiteur,R.Nom,R.Prenom,R.Tel,d.Id_visiteur,d.Date_d_entree,d.h_entrer,d.h_sortie,d.Departement,d.Personne_a_contacter,d.objet_visite,d.sorti  FROM Visite d ,visiteur R WHERE R.Id_visiteur=d.Id_visiteur AND d.sorti=0 ");
while($visiteur=$sql->fetch()){
  if(isset($visiteur["Id_visiteur"]))
  {
    echo'<p> '.$p.'.- CIN/NIF:'.$visiteur["Id_visiteur"].', NOM:'.$visiteur["Nom"].' ,PRÉNOM:'.$visiteur["Prenom"].' ,TEL:'.$visiteur["Tel"].', DATE_ENTRÉE:'.$visiteur["Date_d_entree"].'</p>';
    echo'<p>*****</p>';
    $p++;
    $ok=1;
  }

}
if($ok==0)
{
  echo"<p>*Il y a pas de visiteur dans le batiment*</p>";
}
?>
