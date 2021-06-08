<?php 
session_start() ;
require "C:\laragon\www\projet\back-end\connexsubsc-funct.php";
$_SESSION['data']['condit']="notcheck";
$isub=false;
$isub=subscribeon();
$_SESSION['data']["isub"]=$isub;
/*if ($isub){
    header("Location: connexion.php");
}*/
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
    <!-- Latest compiled and minified CSS -->
   <!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<body>
<h1 class="text-center">Please subscribe</h1>  
<?php 
if (isset($_SESSION)):
    if (isset($_SESSION['errors'])): ?>
        <?php foreach ($_SESSION['errors'] as $error): ?>
        <div class="alert alert-danger" role="alert">
        <?php echo $error ?>
        </div> 
        <?php endforeach ?>
        <?php endif ?>
        <?php endif ?>
        <?php if (isset($_SESSION['grant'])): ?>
        <?php foreach ($_SESSION['grant'] as $grant): ?>
        <div class="alert alert-success" role="alert">
        <?php echo $grant ?>
        </div> 
        <?php endforeach ?>
        <?php endif ?>
    <div>
        <form action="subscribe.php?clicked=1" method="post">
        <div class="form-group">
                <label for="exampleInputEmail1">Nom*</label>
                <input type="name" name="nom" class="form-control" id="exampleInputName" placeholder="Name" value="<?php echo $_SESSION['data']['name'] ?? null ?>" >
            </div>
            <div class="form-group">
            <div class="form-group">
                <label for="exampleInputEmail1">Prénom*</label>
                <input type="firstname" name="prenom" class="form-control" id="exampleInputName" placeholder="Firstname" value="<?php echo $_SESSION['data']['firstname'] ?? null ?>" >
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address*</label>
                <input type="email" name="mail" class="form-control" id="exampleInputEmail1" placeholder="Email" value="<?php echo $_SESSION['data']['mail'] ?? null ?>" >
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password*</label>
                <input type="password" name="mot_de_passe" class="form-control" id="exampleInputPassword1" placeholder="Password" value=" <?php echo $_SESSION['data']['password'] ?? null ?> ">
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="presence" value="conditok"<?php if (($_SESSION['data']['condit'])=="conditok") {echo "checked";} ?> > Vous acceptez les conditions*
                </label>
                <div>
                    <label>
                        * mentions obligatoires
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-default" >Subscribe</button>
        </form> 
        <a class="btn btn-default" href="connexion.php" >Login</a>
        <a class="btn btn-default" href="index.php" >Home</a>
    

    <script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<?php 
$_SESSION['errors'] = [];
$_SESSION['data'] = [];
$_SESSION['grant'] = [];
?>

</body>


</html>