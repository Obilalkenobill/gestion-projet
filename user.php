<?php 
session_start() ;
require "C:\laragon\www\projet\back-end\user-func.php";
gestionuser();
if(!$_SESSION["logged"]){
    header("Location: connexion.php");
}
?>
<!DOCTYPE html>
<html lang="fr">
<?php
        require "headnav.php";
        ?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Nom</th>
      <th scope="col">Prénom</th>
      <th scope="col">Email</th>
      <th scope="col">Date de création</th>
      <th scope="col">Rôle</th>
      <th scope="col">Infos</th>
  
    </tr>
  </thead>
  <tbody>


  <?php while($row = $_SESSION["query"]->fetch_assoc()){
    echo "<tr>";
    echo  "<td>{$row['nom']}</td>";
    echo  "<td>{$row['prenom']}</td>";
    echo  "<td>{$row['email']}</td>";
    echo  "<td>{$row['creation_date']}</td>";
    echo  "<td>{$row['libelle']}</td>";
    //echo  "<td>{$row['role']}</td>";
    echo  "<td>";
    echo  "<div class=\"btnSubmit\">";
    echo  "<a class=\"btnSubmit\" href=\"detail.php?value={$row['ut_id']}&amp;username={$row['nom']}&amp;prenom={$row['prenom']}\" >Détail tâches</a>";
    echo  "</div>";
    echo  "</td>";
    if ($_SESSION['data']["role"]=="admin"){
    echo  "<td>";
    echo  "<div class=\"btnSubmit\">";
    echo  "<a class=\"btnSubmit\" href=\"modifrole.php?value={$row['ut_id']}&amp;username={$row['nom']}&amp;prenom={$row['prenom']}&amp;&amp;role={$row['libelle']}\" >Modifier Rôle</a>";
    echo  "</div>";
    echo  "</td>";
    echo  "<td>";
    echo  "<div class=\"btnSubmit\">";
    echo  "<a class=\"btnSubmit\" onClick=\"return confirm('Are you sure to delete ?')\" href=\"user.php?value={$row['ut_id']}&amp;username={$row['nom']}&amp;prenom={$row['prenom']}&amp;codex=5353\" >Supprimer Utilisateur</a>";
    echo  "</div>";
    echo  "</td>";
    echo  "</tr>";
    }
    } 
 
    
    ?>
  </tbody>
</table>

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