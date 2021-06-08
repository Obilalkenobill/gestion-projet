<?php 
session_start() ;
require "C:\laragon\www\projet\back-end\\tache-func.php";
if(empty($_SESSION)){
    header("Location: connexion.php");
}
else if ($_SESSION['data']["role"]!=="admin"){
    header("Location: blog.php");
}

selection();
?>
<!DOCTYPE html>
<html lang="fr">
<?php
        require "headnav.php";
        ?>
    <div class=back>
    <h1 class="text-center"><span class="label label-primary">Veuillez affecter votre tâche</span></h1> 
        <form action="affctache.php?click=1" method="post">
        <label for="exampleInputEmail1">Projet*</label>
        <br>
        <select name="projet">";
            <?php
                
                   
                while($row = $_SESSION["query4"]->fetch_assoc()) {
    

                echo "<option value=\"{$row['id']}\" $selected >{$row['nom']}</option>";
    
                }
                
            ?> 
        </select>
        <button type="submit" class="btn btn-default" >Valider le projet avant de continuer</button>
        </form>
        <form action="affctache.php?clicked=1" method="post">
        <div class="part form-group">
                <label for="exampleInputEmail1">Participant(s) à la tâche*</label>
                <br>

            <?php
            $_SESSION['i']=0;
            while($row = $_SESSION["query2"]->fetch_assoc()) {
            
            $checked="";
                    
            if (isset($_SESSION['users_id']) && in_array($row['id'],$_SESSION['users_id'])) {
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
            <div class="form-group">
                <label for="exampleInputEmail1">Nom *</label>
                <input type="datedeb" name="nom" class="form-control"  placeholder="Nom de la tâche" value="<?php echo $_SESSION['info']['nomtach'] ?? null ?>" >
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Définition de la tâche*</label>
                <textarea rows="5" cols="33" type="textarea" name="deftask" class="form-control" id="exampleInputName" placeholder="Définition de la tâche" value="" ><?php echo $_SESSION['info']['deftask'] ?? null ?></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Date de début de la tâche *</label>
                <input type="date" name="datedeb" class="form-control input" placeholder="AAAA-MM-DD" value="<?php echo $_SESSION['info']['datedeb'] ?? null ?>" >
            </div>
            <div class="form-group input">
                <label for="exampleInputPassword1">Date de fin de la tâche *</label>
                <input type="date"  min="<?php echo date("Y-m-d") ?>" name="datefin" class="form-control input" placeholder="AAAA-MM-DD" value="<?php echo $_SESSION['info']['datefin'] ?? null ?>">
            </div>
         
            <button type="submit" class="btn btn-default" >Enregistrer la tâche</button>
        </form> 
       
    
</div>
<?php 
$_SESSION['errors'] = [];
$_SESSION['info'] = [];
$_SESSION['grant'] = [];
$_SESSION['users_id']=[];
?>
</div>
</body>
<!-- Footer -->
<?php
        require "footer.php";
        ?>

</html>