<?php 
session_start() ;
require "C:\laragon\www\projet\back-end\\tache-func.php";
gestionprojet();
if(!$_SESSION["logged"]){
    header("Location: connexion.php");
}

?>
<!DOCTYPE html>
<html lang="fr">
<?php
        require "headnav.php";
        ?>
        <h1><span class="label label-primary">Projets</span></h1>
      <?php
  
      
    if (isset($_SESSION['queryprojets']))
        {
        if(isset($_SESSION['queryprojets']) && $_SESSION['queryprojets'])
            {
            while ($row = $_SESSION['queryprojets'] ->fetch_assoc()){
                            
                echo "<ul class=\"list-group\">";
                echo "<li class=\"list-group-item disabled\">Nom du projet : {$row['nom']}<br></li>";
                echo "<li class=\"list-group-item disabled\">Définition du projet : {$row['definition']}<br></li>";
                echo  "<li class=\"list-group-item disabled\"><a class=\"btnSubmit\" href=\"detailprojet.php?projet_id={$row['id']}&amp;nom_projet={$row['nom']}\" >Accédez aux taches</a></li>";
                if($_SESSION['data']['role']=="admin"){
                echo  "<li class=\"list-group-item disabled\"><a onClick=\"return confirm('Are you sure to delete ?')\" class=\"btnSubmit\" href=\"gestiontache.php?droprojet_id={$row['id']}\" >Supprimer le projet ?</a></li>";
                }
                echo "</ul>";
                echo "<br><br>";
 
            }
        }
    } 
   echo "<br>";
   echo "<div id=\"menu1\">";
   if ($_SESSION['data']['role']=="admin"){
   echo "<a class=\"button\" href=\"modifproj.php\">Modifier un projet </a>";
}
echo "</div>";
echo "<br><br>";
  ?>        

 

 
  
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