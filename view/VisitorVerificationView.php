<div class="row">
<div class="col-md-12">
  <h2> VERIFICATION VISITEUR </h2>
  
  <?php
    require("model/Model.php");
    $visitor = new UserModel;
    $visitor->VerifVisitor();

   ?>
</div>
</div>
