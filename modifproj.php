<?php 
session_start() ;
require "C:\laragon\www\projet\back-end\affprojet-func.php";
if(!$_SESSION["logged"]){
    header("Location: connexion.php");
}
else if ($_SESSION['data']["role"]!=="admin"){
    header("Location: blog.php");
}

affuser();
selection();
$_SESSION['i']=0;
?>
<!DOCTYPE html>
<html lang="fr">
<?php
        require "headnav.php";
        ?>
    <div class="back">
    <h1 class="text-center"><span class="label label-primary">Veuillez modifier votre Projet</span></h1> 
    <form action="modifproj.php?clik=1" method="post">
        <label for="exampleInputEmail1">Projet*</label>
        <br>
        <select name="projet">";
            <?php
                
                   
                while($row = $_SESSION["query4"]->fetch_assoc()) {
    

                echo "<option value=\"{$row['id']}\" >{$row['nom']}</option>";
    
                }
                
            ?> 
        </select>
        <button type="submit" class="btn btn-default" >Valider le projet avant de continuer</button>
        </form>
        <form action="modifproj.php?modif=1" method="post">
        
            <div class="form-group">
                <label for="exampleInput">Nom projet*</label>
                <input name="nomprojet" class="form-control" placeholder="Nom du projet" value="<?php if (isset( $_SESSION['proj']['nom'])) {echo $_SESSION['proj']['nom'];}?>">

                <label for="exampleInput">Définition du projet*</label>
                <textarea rows="5" cols="33" type="textarea" name="defprojet" class="form-control" id="exampleInputName" ><?php  if (isset( $_SESSION['proj']['def'])) { echo $_SESSION['proj']['def'];}?></textarea>
                
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Participant(s) au projet*</label>
                <br>

                <div class=part>
                <?php 
            $_SESSION['i']=0;
            while($row = $_SESSION["query2"]->fetch_assoc()) {
           
            $checked="";
                    
            if (isset($_SESSION['userss_id']) && in_array($row['id'],$_SESSION['userss_id'])) {
               $checked="checked";
            }
                    echo "<div class=part>";
                    echo "<input type=\"checkbox\" name=\"{$_SESSION['i']}\" value=\"{$row['id']}\" $checked>";
                    echo "<label for=\"notification\"> Nom : {$row['nom']}, Prénom : {$row['prenom']}</label>  &nbsp &nbsp";
                    echo "</div>";
 
                    $_SESSION['i']++;
                }
    ?>
    </div>
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