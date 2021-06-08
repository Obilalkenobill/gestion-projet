<?php
require "db.php";

function selection(){
    $mysqli=connectdb();
    $queryResult = $mysqli->query("select * from utilisateurs ");
if (is_bool($queryResult) && !$queryResult)
    {
    $_SESSION["errors"][]="Internal error select";
    $bool=false;
    }
if (!empty($mail)&&$queryResult->num_rows==0){
    $_SESSION['errors'][]="UserId introuvable";
    $bool=false;
    
    }
    $_SESSION["query2"]=$queryResult;

    $queryResult = $mysqli->query("select * from projets ");
    if (is_bool($queryResult) && !$queryResult)
        {
        $_SESSION["errors"][]="Internal error select";
        $bool=false;
        }
    if (!empty($mail)&&$queryResult->num_rows==0){
        $_SESSION['errors'][]="UserId introuvable";
        $bool=false;
        
        }
        $_SESSION["query4"]=$queryResult;
   }
   if (!empty($_GET['clik'])){
       selectuser1();
   }

   function selectuser1(){
    $mysqli=connectdb();
    $projet_id= (int)htmlspecialchars(filter_input(INPUT_POST, 'projet'));
    
    if (empty($projet_id)){
        $_SESSION["errors"][]="Veuillez selectionner un projet.";
    }
    else {
        $_SESSION['projet_id']=$projet_id;
    }
    $queryResult = $mysqli->query("select * from projets_has_utilisateurs where projets_id=".$projet_id);
        $_SESSION['userss_id']=null;
         while ($row = $queryResult->fetch_assoc()){
            $_SESSION['userss_id'][]=$row['utilisateurs_id'];
           
        }

        $queryResult = $mysqli->query("select * from projets where id=".$projet_id);
         while ($row = $queryResult->fetch_assoc()){
            $_SESSION['proj']['id']=(int)$row['id'];
            $_SESSION['proj']['nom']=$row['nom'];
            $_SESSION['proj']['def']=$row['definition'];

        }
    

}
function affuser()
    {
        $mysqli=connectdb();
        $queryResult = $mysqli->query("SET GLOBAL FOREIGN_KEY_CHECKS=0");
        $queryResult = $mysqli->query("select * from utilisateurs");

        if (is_bool($queryResult) && !$queryResult)
            {
                $_SESSION["errors"][]="Internal error select";
                $bool=false;
            }   

        if (!empty($mail)&&$queryResult->num_rows==0)
            {
                $_SESSION['errors'][]="UserId introuvable";
                $bool=false;
            }

        $_SESSION["query3"]=$queryResult;
    }

if (!empty($_GET['clicked1']))
    {
        return affprojet();
    }

function affprojet()
    {
        
        $mysqli=connectdb();
        $projid=null;
        $nomproj = htmlspecialchars(filter_input(INPUT_POST, 'nomprojet'));
        $defproj = htmlspecialchars(filter_input(INPUT_POST, 'defprojet'));
        $queryResult = $mysqli->query("INSERT INTO projets (definition,nom) VALUES ('$defproj','$nomproj')");
        $projid=$mysqli->insert_id;

        if ($queryResult!==true)
            {
                $_SESSION['errors'][]="Internal error set1".mysqli_error($mysqli);
            } 

        $i=$_SESSION['i']-1;
        $idpart=[];

        while ($i>=0)
            {
                if (isset($_POST[$i]))
                {
                    $idpart[$i] = $_POST[$i];
                }    
                $i--;
            }
        $i=$_SESSION['i']-1;

        while ($i>=0)
            {
                
                if (isset($idpart[$i]))
                {
                    $y=(int) $idpart[$i];
                $queryResult = $mysqli->query("INSERT INTO projets_has_utilisateurs(projets_id,utilisateurs_id) VALUES ('$projid','$y')");
                }
                $i--;
            }

        if ($queryResult!==true)
            {
                $_SESSION['errors'][]="Internal error set2".mysqli_error($mysqli);
            } 

        else {

        $_SESSION['grant'][]="Enregistrement du projet effectué";
            }

    }
if (!empty($_GET['modif'])){
    modifprojet();
}
    function modifprojet()
    {
        if (empty($_SESSION['proj']['id'])){
            $_SESSION["errors"][]="Veuillez selectionner un projet.";
            return false;
        }
        $mysqli=connectdb();
        $queryResult = $mysqli->query("select * from projets where id=".$_SESSION['proj']['id']);
        $projid=null;
        $nomproj = htmlspecialchars(filter_input(INPUT_POST, 'nomprojet'));
        $defproj = htmlspecialchars(filter_input(INPUT_POST, 'defprojet'));
        $queryResult = $mysqli->query("UPDATE projets set (definition,nom) VALUES ('$defproj','$nomproj') where id=".$_SESSION['proj']['id']);

        if ($queryResult!==true&& $_SESSION['proj']['nom']!==$nomproj&&$_SESSION['proj']['def']!==$defproj)
            {
                $_SESSION['errors'][]="Internal error set1".mysqli_error($mysqli);
            } 

        $i=$_SESSION['i']-1;
        $idpart=[];

        while ($i>=0)
            {
                if (isset($_POST[$i]))
                {
                    $idpart[$i] = $_POST[$i];
                }    
                $i--;
            }
            $queryResult = $mysqli->query("DELETE FROM projets_has_utilisateurs WHERE projets_id={$_SESSION['proj']['id']}"); ;
        $i=$_SESSION['i']-1;

        while ($i>=0)
            {
                
                if (isset($idpart[$i]))
                {
                    $y=(int) $idpart[$i];
                $queryResult = $mysqli->query("INSERT INTO projets_has_utilisateurs(projets_id,utilisateurs_id) VALUES ({$_SESSION['proj']['id']},'$y')");
                }
                $i--;
            }

        if ($queryResult!==true)
            {
                $_SESSION['errors'][]="Internal error set2".mysqli_error($mysqli);
            } 

        else {

        $_SESSION['grant'][]="Modification du projet effectué";
            }
            $_SESSION['proj']['id']=null;

    }

?>
