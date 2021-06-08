<?php 
session_start() ;
require "C:\laragon\www\projet\back-end\\tache-func.php";
if(!$_SESSION["logged"]){
    header("Location: connexion.php");
}    
else if ($_SESSION['data']["role"]!=="admin"){
        header("Location: blog.php");
    }
if (isset($_GET['valueid'])&&isset($_GET['nomproj'])&&isset($_GET['nomtache'])){
    $_SESSION['a']['idtache']=$_GET['valueid'];
    $_SESSION['a']['nomproj']=$_GET['nomproj'];
    $_SESSION['a']['nomtache']=$_GET['nomtache'];
    }

?>
<!DOCTYPE html>
<html lang="fr">
<?php
        require "headnav.php";
        ?>
      
        <h1><span class="label label-primary">Pensez à actualiser le statut de vos tâches</span></h1>
   <form action="modifstatus.php?submit=1" method="post">    

            <label for="exampleInput">Nom du projet : <?php echo "{$_SESSION['a']['nomproj']}"?></label>
            <br>
            <label for="exampleInput">Nom de la tache : <?php echo "{$_SESSION['a']['nomtache']}"?></label>
            <br>
            <label for="exampleInput">Choisissez le Statut de la tâche*</label>
                        <select name="statut">
                        <option value="Nouveau">Nouveau</option>
                        <option value="En cours">En cours</option>
                        <option value="Résolu">Résolus</option>
                        <option value="Clos"> Clos</option>
                        </select>
                        <br>
                        <br>
        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Changement de statut" />
        </div>
</form>
<br>

  
     </body>
   </html>
   
    
   
   <?php 
   $_SESSION['errors'] = [];
   $_SESSION['grant'] = [];
   ?>
   </body>
   <!-- Footer -->
   <?php
        require "footer.php";
        ?>
   
   </html>