<?php 
session_start() ;
require "C:\laragon\www\projet\back-end\\tache-func.php";
gestiontacheuser();
if(!$_SESSION["logged"]){
    header("Location: connexion.php");
}
else if ($_SESSION['data']["role"]!=="admin"){
    header("Location: blog.php");
}

$mysqli=connectdb();
?>
<!DOCTYPE html>
<html lang="fr">
<?php
        require "headnav.php";
        ?>
        <div class=global >
  <?php 
  
  echo "<h1><span class=\"label label-default\">Aperçu des tâches de | Nom:{$_GET['username']} Prénom:{$_GET['prenom']} |</span></h1>";
  if (isset($_SESSION['queryprojets'])){
  foreach($_SESSION['queryprojets'] as $query){
    while ($row = $query->fetch_assoc()){
        
        echo "<ul class=\"list-group\">";
         echo "<li class=\"list-group-item disabled\">Nom du projet : {$row['nom']}</li>";
         echo "<li class=\"list-group-item disabled\">Définition du projet : {$row['definition']}</li>";
         echo "<li class=\"list-group-item disabled\">";
         

         $queryResult5 = $mysqli->query("select * from projets_has_utilisateurs where projets_id=".$row['id']);
         echo "<select >";

         while ($row6 = $queryResult5->fetch_assoc()){
         
             $queryResult6 = $mysqli->query("select * from utilisateurs where id=".$row6['utilisateurs_id']);
             while ($row7 = $queryResult6->fetch_assoc()){
                 echo "<option >{$row7['nom']}, {$row7['prenom']}</option>";
     
             }
         
         }
         echo "</select>";
         echo "</li>";
         echo "</ul>";
         echo "<br><br>";

         $queryResult = $mysqli->query("select * from taches where projets_id=\"{$row['id']}\"");
         while ($row1 = $queryResult->fetch_assoc()){
            $queryResult1 = $mysqli->query("select * from utilisateurs_has_taches where taches_id=\"{$row1['id']}\" and utilisateurs_id=\"{$_SESSION['data']['id_detail']}\"");
        
            while ($row2 = $queryResult1->fetch_assoc()){

            $queryResult2 = $mysqli->query("select * from taches where id=\"{$row2['taches_id']}\"");

            while ($row3 = $queryResult2->fetch_assoc()){
            echo "<ul class=\"list-group\">";
            if (date("Y-m-d")>$row3['date_fin']){
                 echo "<li class=\"list-group-item-danger disabled\">Id tache : {$row3['id']}</li>";
             }else{     
             echo "<li class=\"list-group-item-success disabled\">Id tache : {$row3['id']}</li>";
             }
             echo "<li class=\"list-group-item disabled\">Nom de la tâche : {$row3['nom']}</li>";
             echo "<li class=\"list-group-item disabled\">Définition de la tâche : {$row3['definition']}</li>";
             echo "<li class=\"list-group-item disabled\">Date de début de la tâche : {$row3['date_debut']}</li>";
             echo "<li class=\"list-group-item disabled\">Date de fin de la tâche : {$row3['date_fin']}</li>";
             echo "<li class=\"list-group-item disabled\">Statut de la tâche : {$row3['status']}</li>";
             echo "<li class=\"list-group-item disabled\">";
             echo "Participant à la tâche :";
             $queryResult3 = $mysqli->query("select * from utilisateurs_has_taches where taches_id=".$row1['id']);
             echo "<select >";

             while ($row4 = $queryResult3->fetch_assoc()){
             
                 $queryResult4 = $mysqli->query("select * from utilisateurs where id=".$row4['utilisateurs_id']);
                 while ($row5 = $queryResult4->fetch_assoc()){
                     echo "<option >{$row5['nom']}, {$row5['prenom']}</option>";
         
                 }
             
             }
             echo "</select>";
         
             echo "</ul>";
             echo "<br><br>";
        }
    }
}

}
} 
  }
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
?>
</body>
<!-- Footer -->

<!-- Footer -->
<?php
        require "footer.php";
        ?>

</html>