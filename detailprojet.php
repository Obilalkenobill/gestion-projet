<?php 
session_start() ;
require "C:\laragon\www\projet\back-end\\tache-func.php";
gestiontache1();
if(!$_SESSION["logged"]){
    header("Location: connexion.php");
}
?>
<!DOCTYPE html>
<html lang="fr">
<?php
        require "headnav.php";
        ?>
        <div class=global >
  <?php 
             
  echo "<div class=\"rest\" ><h1><span class=\"label label-default\">Projet : {$_GET['nom_projet']}</span></h1>";

  echo "Participant au projet :";

            echo "<form action=\"detailprojet.php?deletepart=1\" method=\"post\">";
            echo "<select name=\"part\">";

             foreach (  $_SESSION['query1'] as $value) {
                 # code...
             
                 while ($row5 = $value->fetch_assoc()){
                     echo "<option value=\"{$row5['id']}\" >{$row5['nom']}, {$row5['prenom']}</option>";
         
                 }
                }
             echo "</select></div>";
             
             echo "</form>";
             //echo "</ul>";
             echo "<br><br>";
             echo "<form action=\"detailprojet.php?modiftask=1\" method=\"post\">";
             while ($row3 = $_SESSION['query2']->fetch_assoc()){
            echo "<ul class=\"list-group\">";
            if (date("Y-m-d")>$row3['date_fin']){
                 echo "<li class=\"list-group-item-danger disabled\">Nom tache : {$row3['nom']}<br></li>";
             }else{     
             echo "<li class=\"list-group-item-success disabled\">Nom tache : {$row3['nom']}<br></li>";
             }
             echo " <li class=\"list-group-item disabled\">Définition de la tâche : {$row3['definition']}<br></li>";
             echo "<li class=\"list-group-item disabled\">Date de début de la tâche : {$row3['date_debut']}<br></li>";
             echo "<li class=\"list-group-item disabled\">Date de fin de la tâche : {$row3['date_fin']}<br></li>";
             echo "<li class=\"list-group-item disabled\">Statut de la tâche : {$row3['status']}
             <br>
             <a class=\"button\" href=\"modifstatus.php?valueid={$row3['id']}&amp;nomtache={$row3['nom']}&amp;nomproj={$_GET['nom_projet']}\">Modifier statut </a>
             </li>";
             echo  "<li class=\"list-group-item disabled\"><a class=\"btnSubmit\" href=\"usertache.php?id_tache={$row3['id']}\" >Utilisateurs concernés</a></li>";
             if ($_SESSION['data']['role']=="admin"){
             echo "<li class=\"list-group-item disabled\"><a onClick=\"return confirm('Are you sure to delete ?')\" class=\"button\" href=\"detailprojet.php?id_tachedrop={$row3['id']}&amp;projet_id={$_GET['projet_id']}&amp;nom_projet={$_GET['nom_projet']}\">Supprimer Tâche </a></li>"; 
             }
             echo "</ul>";
             echo "<br><br>";
           
  }  
  echo "</form>";
  echo "<div id=\"menu1\">";
  if ($_SESSION['data']['role']=="admin"){
    echo "<a  class=\"button\" href=\"modiftache.php?id_tache={$row3['id']}\">Modifier une tâche </a>";
     }
     echo "</div>";
     echo "<br>";
     echo "<br>";

  ?>
  </div>

  </body>
</html>

    <script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<?php 
$_SESSION['errors'] = [];
$_SESSION['queryprojets']=null;
$_SESSION['query1']=null;
?>
</body>
<!-- Footer -->

<footer class="page-footer font-small blue">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">
    <a class="spec"> © 2020 Copyright : TaskManager.         Bienvenu, et bonne navigation <?php echo "{$_SESSION["data"]["nom"]} {$_SESSION["data"]["prenom"]}"?> </a>
  </div>
  <!-- Copyright -->

</footer>


</html>