<?php
require "db.php";
    function gestionuser(){
        $mysqli=connectdb();
        $queryResult = $mysqli->query("SELECT *,utilisateurs.id as ut_id FROM utilisateurs LEFT JOIN roles ON utilisateurs.roles_id=roles.id");
    if (is_bool($queryResult) && !$queryResult)
        {
        $_SESSION["errors"][]="Internal error select";
        return false;
        }
    if (!empty($mail)&&$queryResult->num_rows==0){
        $_SESSION['errors'][]="Aucun users";
        return false;
        
        }
        $_SESSION["query"]=$queryResult;
    }
    if (isset($_GET['codex'])){
    if ($_GET['codex']==5353){
        return dropuser();
    }
}

    function dropuser()
    {
        $iduser=$_GET['value'];
        $mysqli=connectdb();
        $queryResult=$mysqli->query("DELETE FROM utilisateurs WHERE id=".$iduser);
        $queryResult1=$mysqli->query("DELETE FROM utilisateurs_has_taches WHERE utilisateurs_id=".$iduser);
        $queryResult2=$mysqli->query("DELETE FROM projets_has_utilisateurs WHERE utilisateurs_id=".$iduser);
        if(!$queryResult || !$queryResult1 || !$queryResult2 ){
            $_SESSION['errors'][]="error drop";
        }
        else{
            $_SESSION['grant'][]="utilisateur exclus des participants";
        }
        
    }
    ?>