<?php 
session_start() ;
require "C:\laragon\www\projet\back-end\affprojet-func.php";
if(empty($_SESSION)){
    header("Location: connexion.php");
}
else if ($_SESSION['data']["role"]!=="admin"){
    header("Location: blog.php");
}

affuser();
$_SESSION['i']=0;
?>
<!DOCTYPE html>
<html lang="fr">
<?php
        require "headnav.php";
        ?>
    <div class="back">
    <h1 class="text-center"><span class="label label-primary">Veuillez affecter votre Projet</span></h1> 
        <form action="affprojet.php?clicked1=1" method="post">
        
            <div class="form-group">
                <label for="exampleInput">Nom projet*</label>
                <input name="nomprojet" class="form-control" placeholder="Nom du projet" value="">

                <label for="exampleInput">Définition du projet*</label>
                <textarea rows="5" cols="33" type="textarea" name="defprojet" class="form-control" id="exampleInputName" value="" ></textarea>
                
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Participant(s) au projet*</label>
                <br>

            <?php
          
            while($row = $_SESSION["query3"]->fetch_assoc()) {
                echo "<div class=part>";
                echo "<input type=\"checkbox\" name=\"{$_SESSION['i']}\" value=\"{$row['id']}\">";
                echo "<label for=\"notification\"> Nom : {$row['nom']}, Prénom : {$row['prenom']}</label>  &nbsp &nbsp";
                echo "</div>";
                $_SESSION['i']++;
            }
    ?>
            </div>
  
     <button type="submit" class="btn btn-default" >Enregistrer le projet</button>
        </form> 
       
    

<?php 
$_SESSION['errors'] = [];
$_SESSION['info'] = [];
$_SESSION['grant'] = [];
?>
</div>
</body>
<!-- Footer -->
<?php
        require "footer.php";
        ?>
</html>