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
if (isset($_GET['value'])){
$_SESSION['iduser']=$_GET['value'];
}

?>
<!DOCTYPE html>
<html lang="fr">
<?php
        require "headnav.php";
        ?>
        <h1><span class="label label-primary">Modifier le rôle de <span class="redrole"><?php echo "{$_GET['role']}&nbsp"?></span> <?php echo "de {$_GET['username']}&nbsp {$_GET['prenom']}"?></span></h1>
        <br>
        <div class=back1>
        <form action="modifrole.php?clicked1=1" method="post">
      <p>Choisissez un nouveau rôle : </p>
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
<button type="submit" class="btn btn-default" >Modifier le rôle</button>
</form>

 </div>
  
  </body>
</html>

<?php 
/*$_SESSION['errors'] = [];
$_SESSION['queryprojets']=null;
$_SESSION['grant']=[];*/
?>
</body>
<!-- Footer -->
<?php
        require "footer.php";
        ?>

</html>