<?php 
session_start() ;
require "C:\laragon\www\projet\back-end\\rolefunc.php";
selectrole();
if(!$_SESSION["logged"]){
    header("Location: connexion.php");
}/*
else if ($_SESSION['data']["role"]!=="admin"){
  header("Location: blog.php");
}*/
?>
<!DOCTYPE html>
<html lang="fr">
<?php
        require "headnav.php";
        ?>
        <h1><span class="label label-primary">Supprimer un rôle</span></h1>
        <br>
        <div class=back1>
        <form action=supprole.php?clicka=1" method="post" >
      <p>Choisissez un rôle à supprimer : </p>
      <?php
  
  echo "<select name=\"role\">";
    if (isset($_SESSION['queryroles']))
        {
            while ($row5 = $_SESSION['queryroles']->fetch_assoc()){
                echo "<option value=\"{$row5['id']}\" >{$row5['libelle']}</option>";
    
            }
            echo "</select>";                    
    } 
   echo "<br>";
   
  ?>        
<br>

<button type="submit" class="btn btn-default" onClick="return confirm('Are you sure to delete ?')">Supprimer le rôle</button>
</form>

 </div>
  
  </body>
</html>
<SCRIPT LANGUAGE="JavaScript">
function confirmation() {
var msg = "Êtes-vous sur de vouloir supprimer ce truc ?";
if (confirm(msg))
location.replace(supprole.php);
}
</SCRIPT> 
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