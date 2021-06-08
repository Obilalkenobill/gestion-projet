<?php 
session_start() ;
require "C:\laragon\www\projet\back-end\\tache-func.php";
tacheuser();
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


  <?php 
  foreach ($_SESSION["query3"] as $value) {
    
  while($row = $value->fetch_assoc()){
    echo "<tr>";
    echo  "<td>{$row['nom']}</td>";
    echo  "<td>{$row['prenom']}</td>";
    echo  "<td>{$row['email']}</td>";
    echo  "<td>{$row['creation_date']}</td>";
    echo  "<td>{$row['libelle']}</td>";
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