<?php 
session_start() ;
//require "C:\laragon\www\projet\back-end\connexsubsc-funct.php";
if(!$_SESSION["logged"]){
    header("Location: connexion.php");
}
?>
<html>
   <?php
        require "headnav.php";
        ?>
      
        <div class="container section">
            <div class="row">
                <div class="col-md-6">
                    <h3>
                    Les projets sont les relais du chemin. 
                    <br>
                    </h3>
                    <p>
                    Citation de Anne Barratin ; Chemin faisant (1894)
                    </p>
                    <h3>
                    En effet, une équipe doit toujours prendre en compte l’individualité de chacun. Tous les membres de l’équipe doivent se sentir utiles.
                    </h3>
                </div>
                <div class="col-md-6">
                    <img src="blog-image.jpg" alt=""/>
                </div>
            </div>
<!-- Footer -->
<?php
        require "footer.php";
        ?>
</body>
</html>