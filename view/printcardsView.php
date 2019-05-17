<!DOCTYPE HTML>
<html>
<head>
	<title>MTPTCvizi</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="../view/js/jquery-3.3.1.min.js"></script>
    <script src="../view/js/bootstrap.min.js"></script>
		<script src="../view/js/html2canvas.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../view/css/bootstrap.min.css">
    <link href="../view/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../view/css/styleImpretion.css">
</head>
<body>
  <div class="container-fluid">
    <div class="blok">
  <div id="html-content-holder" style=" color:  #404bc2; width: 500px;
          padding-left: 25px; padding-top: 10px;" class="col-md-3">
          <h5 style="color: white; background-color:#fb3232">
              Carte de Visite
          </h5>
          <p style="color: #3e4b51;">

              CIN/NIF:002-365-569-9<br/>
              NOM:Jeudi<br/>
              Prenom:Audine<br/>
              Persone à Visiter:Gabriel<br/>
              Département: Direction Generale<br/>
              Objet de la visite:Jòb<br/>

          </p>
      </div>
      <center><input id="btn-Preview-Image" type="button" value="Preview"/>
      <a id="btn-Convert-Html2Image" href="#">Download</a></center>
      <br/>
      <h3>Preview :</h3>
      <div id="previewImage">
      </div>


  <script>
  $(document).ready(function(){


  var element = $("#html-content-holder"); // global variable
  var getCanvas; // global variable

      $("#btn-Preview-Image").on('click', function () {
           html2canvas(element, {
           onrendered: function (canvas) {
                  $("#previewImage").append(canvas);
                  getCanvas = canvas;
               }
           });
      });

  	$("#btn-Convert-Html2Image").on('click', function () {
      var imgageData = getCanvas.toDataURL("image/png");
      // Now browser starts downloading it instead of just showing it
      var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
      $("#btn-Convert-Html2Image").attr("download", "your_pic_name.png").attr("href", newData);
  	});

  });

  </script>
</div>
</div>
</body>
</html>
