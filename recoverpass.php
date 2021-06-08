<?php session_start() ;
require "C:\laragon\www\projet\back-end\recoverpass-func.php";

rempliformon();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
.container{
    margin-left:32.5%
}
.login-container{
    margin-top: 5%;
    margin-bottom: 5%;
}
.login-form-1{
    padding: 5%;
    box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
}
.login-form-1 h3{
    text-align: center;
    color: #333;
}
.login-form-2{
    padding: 5%;
    background: #0062cc;
    box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
}
.login-form-2 h3{
    text-align: center;
    color: #fff;
}
.login-container form{
    padding: 10%;
}
.btnSubmit
{
    margin-left:25%;
    width: 50%;
    border-radius: 1rem;
    padding: 1.5%;
    padding-left:5%;
    border: none;
    cursor: pointer;
}
.login-form-1 .btnSubmit{
    font-weight: 600;
    color: #fff;
    background-color: #0062cc;
}

</style>
</head>
<body>
<?php 
        if (isset($_SESSION)){
        if (isset($_SESSION['errors'])){
        foreach ($_SESSION['errors'] as $error){
        echo "<div class=\"alert alert-danger\" role=\"alert\">";
        echo $error ;
        echo "</div>"; 
        }
      }
    }?>
    <form action="recoverpass.php?clicked=1" method="post">        
        <div class="container login-container">
            <div class="row">
                <div class="col-md-6 login-form-1">
                    <h3>Login</h3>
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address*</label>
                            <input type="text"  name="mail" class="form-control" placeholder="Your Email *" value="<?php echo $_SESSION['data']['mail'] ?? null ?>" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Recover" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </form>

    <script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<?php 
$_SESSION['errors'] = [];
$_SESSION['data'] = [];
?>

</body>


</html>