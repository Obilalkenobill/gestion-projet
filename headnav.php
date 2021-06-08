<head>
<title>Task Manager</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" href="favicon.ico" /> 

        <style>
        @import "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css";
        @import "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css";
        @import "https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css";

        /* Nav Bar */

        body { 
        position:relative;}
        .logo {color:red;}
  
        #menu-social-menu li{display: inline-table}

        .section .row{
    margin-top: 7%;
    margin-bottom: 10%;
}
.section .row .col-md-6{
    background: #f5f5f5;
    margin-right: -2%;
    padding: 5%;
}
.section h3{
    color: #004085;
}
.section p{
    margin-top: 10%;
    color: #545b62;
}
.section img
{
    width: 100%;
}

footer {
    position: fixed; 
    bottom: 0; 
    left: 0; 
    right: 0;
    background:#1E90FF;}
    .footer-copyright{
        color:white;
    }
.spec{
    color:white;
    text-decoration: none;
    font-style:italic;
}
.spec:hover { color: inherit; }
.spec:link
{
text-decoration:none;
}
.part{
    display:inline-block;
}

.back{
    width:60%;
margin-right:auto;
margin-left:auto;
}
.back1{
    margin-left:5%;
}
.button {
  background-color: #31a5dd; 
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  font-size: 16px;
  display: inline-block;
  border-radius: 15px;
  
}
#menu1 {
position: fixed !important;
  right: 25% !important;
  top: 23% !important;

}
.list-group-item{
    width:50%;
    margin-left:5%;
}
.label-primary{
    margin-left:5%;

}
.list-group-item-success{
width:50%;
margin-left:5%;
}
.list-group-item-danger{
    width:50%;
    margin-left:5%;
}
.rest{
    margin-left:5%;
}
.margin{
    margin-left:5%;
}
.bout2 {
  position: fixed;
  right: 25%;
  top: 30%;
  width: 8em;
  margin-top: 2.5em;
}
.redrole{
    color:red;
}
.trogrand{
    width: 25rem;
}
</style>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Task <span class="logo">Manager</span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item ">
        <a class="nav-link" href="blog.php">Acceuil</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle"  id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Aperçu
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="projetvue.php">Projets</a>
          <a class="dropdown-item" href="gestiontache.php">Vos projets</a>
        </div>
      </li>
      <?php if (isset($_SESSION['data']['role']) && $_SESSION['data']['role']=="admin"){
     echo  "<li class=\"nav-item dropdown\">";
     echo  "  <a class=\"nav-link dropdown-toggle\"  id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">";
     echo  "   Créer";
     echo  " </a>";
     echo  " <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">";
     echo  " <a class=\"dropdown-item\" href=\"affprojet.php\">Créer Projet</a>";
     echo  " <a class=\"dropdown-item\" href=\"affctache.php\">Créer Tache </a>";
     echo  " </div>";
     echo  " </li>";
     echo  " <li class=\"nav-item dropdown\">";
     echo  " <a class=\"nav-link dropdown-toggle\"  id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">";
     echo  "  Gérer";
     echo  " </a>";
     echo  "<div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">";
     echo  " <a class=\"dropdown-item\" href=\"modifproj.php\">Modifier Projet</a>";
     echo  " <a class=\"dropdown-item\" href=\"modiftache.php\">Modifier Tache</a>";
     echo  "</div>";
     echo  "</li>";
     echo  " <li class=\"nav-item dropdown\">";
     echo  " <a class=\"nav-link dropdown-toggle\"  id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">";
     echo  "  Rôle";
     echo  " </a>";
     echo  "<div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">";
     echo  " <a class=\"dropdown-item\" href=\"creerole.php\">Créer Rôle</a>";
     echo  " <a class=\"dropdown-item\" href=\"modif_role_exis.php\">Gérer Rôle</a>";
     echo  " <a class=\"dropdown-item\" href=\"supprole.php\">Supprimer Rôle</a>";
     echo  "</div>";
     echo  "</li>";
    }
    ?>
    <li class="nav-item ">
        <a class="nav-link" href="user.php">Participants</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="connexion.php?logout=1">Logout</a>
      </li>
    </ul>
  </div>
</nav>
        <!--
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid nav">
           
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Task manager</span>
                    </button>
                    <a class="navbar-brand brand" href="blog.php">Task <span class="logo">Manager</span></a>
                </div>

           
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">                                
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="projetvue.php">Projets</a></li>
                        <li><a href="gestiontache.php">Vos projets</a></li>
                        <?php/* if ($_SESSION['data']['role']=="admin"){
                        echo "<li><a href=\"affctache.php\">Affectation Tâche</a></li>";
                        
                        
                        echo "<li><a href=\"user.php\">Participants</a></li>";
                        echo "<li><a href=\"affprojet.php\">Affectation Projet</a></li>";
                        }*/
                        ?>
                        <li><a href="connexion.php?logout=1">logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>-->
        <?php   if (isset($_SESSION)):
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
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>