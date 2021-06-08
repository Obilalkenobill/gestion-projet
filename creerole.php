<?php 
session_start() ;
require "C:\laragon\www\projet\back-end\\rolefunc.php";
selectrole();
if(!$_SESSION["logged"]){
    header("Location: connexion.php");
}
else if ($_SESSION['data']["role"]!=="admin"){
    header("Location: blog.php");
}

?>
<!DOCTYPE html>
<html lang="fr">
<?php
        require "headnav.php";
        ?>
        <h1><span class="label label-primary">Modifier le rôle</span></h1>
        <br>
        <div class=back1>
        <form action="creerole.php?clicke=1" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Quel est le nom du nouveau Rôle *</label>
                <input type="datedeb" name="nom_role" class="form-control trogrand"  placeholder="Nom du rôle" value="" >
            </div>

<button type="submit" class="btn btn-default" >Créer le rôle</button>
</form>

 </div>
  
  </body>
</html>

<?php 
$_SESSION['errors'] = [];
$_SESSION['queryprojets']=null;
$_SESSION['grant']=[];
?>
</body>
<!-- Footer -->
<?php
        require "footer.php";
        ?>

</html>