<!--<div id="card">
<?php/*
  echo"CIN/NIF: ".$CIN."<br/>";
  echo"Nom: ".$nom."<br/>";
  echo"Prenom: ".$prenom."<br/>";
  echo"Personne à Visité: ".$personne."<br/>";
  echo"Département: ".$Departement."<br/>";
  */?>
  <a href="javascript:window.print()"><img src="../image/print.png"></a>
</div>-->


<script language="javascript" type="text/javascript">
    function printdiv(divID)
    {
      var headstr = "<html><head><title></title></head><body>";
      var footstr = "</body>";
      var newstr = document.all.item(divID).innerHTML;
      var oldstr = document.body.innerHTML;
      document.body.innerHTML = headstr+newstr+footstr;
      window.print();
      document.body.innerHTML = oldstr;
      return false;
    }
</script>





Code HTML:

<input name="b_print" type="button" onclick="printdiv('divID');" value=" Print " />
<div id="divID">
<h1 style="color:green">
  <img src="image/logo_mini.png">
</div>


</div>
