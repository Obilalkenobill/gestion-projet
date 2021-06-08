<?php
require "db.php";
function selectrole(){
    $mysqli=connectdb();
    $queryResult = $mysqli->query("SELECT * FROM roles");
    $_SESSION['queryroles']=$queryResult ;
}

if (!empty($_GET['clicked1'])){
    modifroleuser();
}

function modifroleuser(){
    $mysqli=connectdb();
$role_id=htmlspecialchars(filter_input(INPUT_POST, 'role'));

if (empty($role_id)){
    $_SESSION['errors'][]="Veuillez choisir un rôle";
}
        $queryResult = $mysqli->query("UPDATE utilisateurs SET roles_id='$role_id' WHERE id=".$_SESSION['iduser']);
        if (!$queryResult)
        {
        $_SESSION['errors'][]="Internal error set".mysqli_error($mysqli);
        return false;
        } 
        else {
            $_SESSION['grant'][]="Rôle modifié";
            header("Location: user.php");
}
}

if (!empty($_GET['click'])){
    modifrole();
}

 
        function modifrole(){
            $mysqli=connectdb();
            $role_id=htmlspecialchars(filter_input(INPUT_POST, 'role'));
            if (empty($role_id)){
                $_SESSION['errors'][]="Veuillez choisir un rôle";
                return false;
            }
            $libelle=htmlspecialchars(filter_input(INPUT_POST, 'nom_role'));
            if (empty($libelle)){
                $_SESSION['errors'][]="Veuillez choisir un rôle";
                return false;
            }
            $libelle=strtolower(trim($libelle));
            $queryResult = $mysqli->query("UPDATE roles SET libelle='$libelle' WHERE id=".$role_id);
        if (!$queryResult)
        {
        $_SESSION['errors'][]="Internal error set".mysqli_error($mysqli);
        return false;
        } 
        else {
            $_SESSION['grant'][]="Rôle modifié";
        }

}

if (!empty($_GET['clicke'])){
    creerole();
}

function creerole(){
    $mysqli=connectdb();
    $libelle=htmlspecialchars(filter_input(INPUT_POST, 'nom_role'));
            if (empty($libelle)){
                $_SESSION['errors'][]="Veuillez choisir un rôle";
                return false;
            }
            $libelle=strtolower(trim($libelle));
            $queryResult = $mysqli->query("INSERT INTO roles(libelle) VALUES ('$libelle')");   
        if (!$queryResult)
        {
        $_SESSION['errors'][]="Internal error set".mysqli_error($mysqli);
        return false;
        } 
        else {
            $_SESSION['grant'][]="Rôle Créé";
        }
}


if (!empty($_GET['clicka'])){
    supprole();
}

function supprole(){
    $mysqli=connectdb();
    $role_id=htmlspecialchars(filter_input(INPUT_POST, 'role'));
    if (empty($role_id)){
        $_SESSION['errors'][]="Veuillez choisir un rôle";
        return false;
    }
    $queryResult = $mysqli->query("DELETE FROM roles where id=".$role_id);
    if (!$queryResult)
    {
    $_SESSION['errors'][]="Internal error set".mysqli_error($mysqli);
    return false;
    } 
    else {
        $_SESSION['grant'][]="Rôle supprimé";
    }
}