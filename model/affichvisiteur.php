<?php
require("connectiondb.php");
$conn=Connection();
$sql=$conn->query("SELECT R.Id_visiteur,R.Nom,R.Prenom,R.Tel,d.Id_visiteur,d.Date_d_entree,d.h_entrer,d.h_sortie,d.Departement,d.Personne_a_contacter,d.objet_visite,d.sorti  FROM Visite d ,visiteur R WHERE R.Id_visiteur=d.Id_visiteur AND d.sorti=0 ");
while($visiteur=$sql->fetch()){
  if(isset($visiteur["Id_visiteur"]))
  {
    echo $visiteur["Id_visiteur"].' '.$visiteur["Nom"].' '.$visiteur["Prenom"].' '.$visiteur["Tel"].' '.$visiteur["Date_d_entree"].' <br/>';
  }
}
?>
