<?php
require "db.php";
 if (!empty($_GET['submit'])){
    return modifstat();
 }

 if (!empty($_GET['droprojet_id'])){
     return droproj();
 }
if (!empty($_GET['id_tachedrop'])){
    return droptache();
}
if (!empty($_GET['clicked'])){
    return affctache();
}
function droptache (){
    $mysqli=connectdb();
    $queryResult2 = $mysqli->query("SELECT * FROM taches where id=".$_GET['id_tachedrop']);
    while ($row = $queryResult2->fetch_assoc()){
    $queryResult1 = $mysqli->query("DELETE FROM utilisateurs_has_taches where taches_id=".$row['id']);
    }
    $queryResult = $mysqli->query("DELETE FROM taches where id=".$_GET['id_tachedrop']);
    if ($queryResult && $queryResult1 && $queryResult2 ){
        $_SESSION['grant'][]="Tâche supprimée";
    }
    else {
        $_SESSION['errors'][]="Erreur de suppression".mysqli_error($mysqli);
    }
}
 function droproj(){
    $mysqli=connectdb();
    $queryResult = $mysqli->query("DELETE FROM projets where id=".$_GET['droprojet_id']);
    $queryResult1 = $mysqli->query("DELETE FROM projets_has_utilisateurs where projets_id=".$_GET['droprojet_id']);
    $queryResult2 = $mysqli->query("SELECT * FROM taches where projets_id=".$_GET['droprojet_id']);
    while ($row = $queryResult2->fetch_assoc()){
        $queryResult3 = $mysqli->query("DELETE FROM utilisateurs_has_taches where taches_id=".$row['id']);
    }
    $queryResult4 = $mysqli->query("DELETE FROM taches where projets_id=".$_GET['droprojet_id']);

    if ($queryResult && $queryResult1 && $queryResult2 ){
        $_SESSION['grant'][]="Projet supprimé";
    }
    else {
        $_SESSION['errors'][]="Erreur de suppression".mysqli_error($mysqli);
    }
 }
 function modifstat(){
     $bool=true;
    $mysqli=connectdb();
    $statut= htmlspecialchars(filter_input(INPUT_POST, 'statut'));
    if (empty($taskid)&&empty($statut)){
        $_SESSION["errors"][]="Veuillez renseigner un statut et l'id de la tache correspondante";
        $bool=false;
    }
    $queryResult = $mysqli->query("select * from utilisateurs_has_taches where utilisateurs_id={$_SESSION ['data']['userid']} and taches_id=".$_SESSION['a']['idtache']);
    if (is_bool($queryResult) && !$queryResult)
        {
        $_SESSION["errors"][]="Internal error select. Veuillez utiliser un Id de la tâche correspondant à vos tâches".mysqli_error($mysqli);
        $bool=false;
        }
        else if ($mysqli->affected_rows<=0){
            $_SESSION["errors"][]="Veuillez utiliser un Id de la tâche correspondant à vos tâches";
        }

       else{

    if ($bool){
    $queryResult = $mysqli->query("update taches set status=\"$statut\" where id=".$_SESSION['a']['idtache']);

    if (is_bool($queryResult) && $queryResult && $mysqli->affected_rows>=1)
        {
            $_SESSION["grant"][]="Le statut a été mis à jour";
        }
        else    {
            $_SESSION["errors"][]=mysqli_error($mysqli);
        }
    }
}
    return $bool;
 }
 
function affctache(){
    $mysqli=connectdb();
    $bool=true;
    $userid    = htmlspecialchars(filter_input(INPUT_POST, 'idpart'));
    $deftask = htmlspecialchars(filter_input(INPUT_POST, 'deftask'));
    $datedeb = htmlspecialchars(filter_input(INPUT_POST, 'datedeb'));
    $datefin = htmlspecialchars(filter_input(INPUT_POST, 'datefin'));
    $nomtach= htmlspecialchars(filter_input(INPUT_POST, 'nom'));
    /*$projet_id= (int)htmlspecialchars(filter_input(INPUT_POST, 'projet'));
    $_SESSION['projets_id']=$projet_id;*/
    if (empty($nomtach))
    {
        $_SESSION['errors'][]="Veuillez nommer la tâche";
        $bool=false;
    }
    else {
       $_SESSION ['info']['nomtach']=$nomtach;
    }
 if (empty($deftask))
 {
     $_SESSION['errors'][]="Veuillez définir la tâche";
     $bool=false;
 }
 else {
    $_SESSION ['info']['deftask']=$deftask;
 }
 if (empty($datedeb)||$datedeb<date("Y-m-d"))
 {
     $_SESSION['errors'][]="Veuillez définir une date de début pour la tâche, veillez aussi à ce qu'elle soit anterieur à hier";
     $bool=false;
 }
 else {
    $_SESSION ['info']['datedeb']=$datedeb;
 }
 if (empty($datefin))
 {
     $_SESSION['errors'][]="Veuillez définir l'échéance final de la tâche";
     $bool=false;
 }
 else {
    $_SESSION ['info']['datefin']=$datefin;
 }
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
    if($bool) {       
        $i=$_SESSION['i']-1;

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
                        $queryResult = $mysqli->query("select * from projets_has_utilisateurs where projets_id={$_SESSION['projet_id']} and utilisateurs_id=$y");
                        if (!$queryResult || $queryResult->num_rows<=0){
                            $_SESSION['errors'][]="Veillez à choisir des membres internes au projet";
                            $bool=false;
                            return $bool;
                            }
                        } 
                        $i--;
                    }
                    $tacheid=null;
                    $projet_id = htmlspecialchars(filter_input(INPUT_POST, 'projet'));
                    $projet_id=(int)$projet_id;
                       if($bool) {
                           $queryResult = $mysqli->query("INSERT INTO taches (definition,date_debut,date_fin,nom,projets_id) VALUES ('$deftask','$datedeb','$datefin','$nomtach','{$_SESSION['projet_id']}')");
                           $tacheid=$mysqli->insert_id;
                       if ($queryResult!==true)
                           {
                           $_SESSION['errors'][]="Internal error set".mysqli_error($mysqli);
                           $bool=false;
                           } 
                       }      
    $i=$_SESSION['i']-1;
        while ($i>=0)
            {
            if (isset($idpart[$i]))
                    {
                        $y=(int) $idpart[$i];
                        $queryResult = $mysqli->query("INSERT INTO utilisateurs_has_taches(taches_id,utilisateurs_id) VALUES ('$tacheid','$y')");
                        
                    }
                $i--;
                }
    if ($queryResult!==true)
        {
        $_SESSION['errors'][]="Internal error set".mysqli_error($mysqli);
        $bool=false;
        } 
        else {
        $_SESSION['grant'][]="Enregistrement de la tâche éffectué, aussi un mail à été envoyé";
       envoismail();
     }
     }
    

     
     return $bool;
    }
function envoismail(){
        ini_set("sendmail_path","C:\sendmail\sendmail.exe");
        $mysqli=connectdb();
        $to = htmlspecialchars(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
        $email="support-technique@gmail.com";
        $sujet="Affectation de tache";
        $to= $_SESSION ['data']['mail'];
        $nom= $_SESSION['data']['nom'];
        $msg='Bonjour, Monsieur' .$nom."\r\n\r\n";
        $msg .= 'Ce mail a été envoyé depuis le support technique du management de tâche pour une définition de votre tâche';
        $msg .= 'Cette tâche débute le :'.$_SESSION ['info']['datedeb'];
        $msg .= 'Cette tâche prend fin le:'.$_SESSION ['info']['datefin'];
        $msg .= "********************VOICI LA DÉFINITION DE VOTRE TÂCHE*******************";
        $msg .= $_SESSION ['info']['deftask'];
        $msg .= "***************************************";
        $headers='From: <' .$email . '>'. "\r\n\r\n";
        mail($to, $sujet, $msg, $headers);
     }


    
    
    
    function gestiontacheuser(){
            $mysqli=connectdb();
            $queryResult = $mysqli->query("select * from projets_has_utilisateurs where utilisateurs_id=\"{$_GET['value']}\"");
            $_SESSION['data']['id_detail']=$_GET['value'];
        if (is_bool($queryResult) && !$queryResult)
            {
            $_SESSION["errors"][]="Internal error select";
            $bool=false;
            }
        if ($queryResult->num_rows==0){
            $_SESSION['errors'][]="Aucun projet trouver";
            $bool=false;
            }
            else {
            while ($row = $queryResult->fetch_assoc()){
                $proj['projets_id'][]=$row['projets_id'];
            }
            
            $queryResult=array();
            $i=0;
            if (isset($proj["projets_id"]))
            foreach ($proj['projets_id'] as $projets_id) {
                $queryResult[$i] = $mysqli->query("select * from projets where id=\"$projets_id\"");
                $i++;
            }

            $_SESSION['queryprojets']=$queryResult;
        }
    }
    
function gestiontache(){
    $mysqli=connectdb();
    $queryResult = $mysqli->query("select * from projets_has_utilisateurs where utilisateurs_id=".$_SESSION ['data']['userid']);
if (is_bool($queryResult) && !$queryResult)
    {
    $_SESSION["errors"][]="Internal error select";
    $bool=false;
    }
if ($queryResult->num_rows==0){
    $_SESSION['errors'][]="Aucun projet trouver";
    $bool=false;
    }
    else {
    while ($row = $queryResult->fetch_assoc()){
        $proj['projets_id'][]=$row['projets_id'];
    }
    
    $queryResult=array();
    $i=0;
    foreach ($proj['projets_id'] as $projets_id) {
        $queryResult[$i] = $mysqli->query("select * from projets where id=".$projets_id);
        $i++;
    }
    $_SESSION['queryprojets']=$queryResult;
        }

}

function gestionprojet(){
    $mysqli=connectdb();
    $queryResult = $mysqli->query("select * from projets ");
    $_SESSION['queryprojets']=$queryResult;
}

function gestiontache1(){
    $mysqli=connectdb();
    $useridproj['users_id'][]=null;
    $queryResult = $mysqli->query("select * from projets_has_utilisateurs where projets_id=".$_GET['projet_id']);
    while ($row = $queryResult->fetch_assoc()){
        $useridproj['users_id'][]=$row['utilisateurs_id'];
    }
    $queryResult1=array();
    foreach ($useridproj['users_id'] as $users_id) {
        $queryResult0[]= $mysqli->query("select * from utilisateurs where id=".$users_id);  
    }
    foreach ($queryResult0 as $value) {
        if ($value){
        $queryResult1[]=$value;
    }
        }
    $_SESSION['query1']=$queryResult1;//utilisateur du projet
    $queryResult = $mysqli->query("select * from taches where projets_id=\"{$_GET['projet_id']}\"");
    $_SESSION['query2']=$queryResult;//taches du projet
}

function tacheuser(){
    $mysqli=connectdb();
    $queryResult4=array();

    $queryResult3 = $mysqli->query("select * from utilisateurs_has_taches where taches_id=".$_GET['id_tache']);
        
    while ($row4 = $queryResult3->fetch_assoc()){   
    $queryResult4[] = $mysqli->query("SELECT * FROM utilisateurs INNER JOIN roles ON utilisateurs.roles_id=roles.id where utilisateurs.id={$row4['utilisateurs_id']}");
        }
    $_SESSION['query3']=$queryResult4;
    foreach ($queryResult4 as $key => $value) {
        if (!$value){
            $_SESSION["errors"][]= "Internal error set".mysqli_error($mysqli);
        }
    }
}

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

if (isset($_GET['click'])){
    selectuser();
}

function selectuser(){
    $mysqli=connectdb();
    $projet_id= (int)htmlspecialchars(filter_input(INPUT_POST, 'projet'));
    if (empty($projet_id)){
        $_SESSION["errors"][]="Veuillez selectionner un projet.";
    }
    else {
        $_SESSION['projet_id']=$projet_id;
    }
    $queryResult = $mysqli->query("select * from projets_has_utilisateurs where projets_id=".$projet_id);
    $_SESSION['users_id']=null;
    while ($row = $queryResult->fetch_assoc()){
        $_SESSION['users_id'][]=$row['utilisateurs_id'];
    }

}
if (isset($_GET['clik'])){
    selectache();
}
function selectache(){
    $mysqli=connectdb();
    $projet_id= (int)htmlspecialchars(filter_input(INPUT_POST, 'projet'));
    if (empty($projet_id)){
        $_SESSION["errors"][]="Veuillez selectionner un projet.";
    }
    else {
        $_SESSION['projet_id']=$projet_id;
    }
    $queryResult = $mysqli->query("select * from projets where id=".$projet_id);
    while ($row = $queryResult->fetch_assoc()){
        $_SESSION['projet']['nom']=$row['nom'];
       
    }
    $queryResult = $mysqli->query("select * from taches where projets_id=".$projet_id);
        $_SESSION['query5']=$queryResult;
      

}

if (isset($_GET['clicke'])){
    selectuser1();
}
function selectuser1(){
    $mysqli=connectdb();
    $tache_id= (int)htmlspecialchars(filter_input(INPUT_POST, 'tache'));
    
    if (empty($tache_id)){
        $_SESSION["errors"][]="Veuillez selectionner une tâche.";
    }
    else {
        $_SESSION['tache_id']=$tache_id;
    }
    $queryResult = $mysqli->query("select * from utilisateurs_has_taches where taches_id=".$tache_id);
        $_SESSION['userss_id']=null;
         while ($row = $queryResult->fetch_assoc()){
            $_SESSION['userss_id'][]=$row['utilisateurs_id'];
           
        }
        $queryResult = $mysqli->query("select * from taches where id=".$tache_id);
         while ($row = $queryResult->fetch_assoc()){
            $_SESSION['tache']['nom']=$row['nom'];
            $_SESSION['tache']['def']=$row['definition'];
            $_SESSION['tache']['datedeb']=$row['date_debut'];
            $_SESSION['tache']['datefin']=$row['date_fin'];

        }
    

}
if (isset($_GET['clickee'])){
    modiftache();
}
function modiftache(){
    $mysqli=connectdb();
    $bool=true;
    $deftask = htmlspecialchars(filter_input(INPUT_POST, 'deftask'));
    $datedeb = htmlspecialchars(filter_input(INPUT_POST, 'datedeb'));
    $datefin = htmlspecialchars(filter_input(INPUT_POST, 'datefin'));
    $nomtach= htmlspecialchars(filter_input(INPUT_POST, 'nom'));
    if (empty($nomtach))
    {
        $_SESSION['errors'][]="Veuillez nommer la tâche";
        $bool=false;
    }
    else {
       $_SESSION ['info']['nomtach']=$nomtach;
       $_SESSION ['infos']['nomtach']=$nomtach;
    }
 if (empty($deftask))
 {
     $_SESSION['errors'][]="Veuillez définir la tâche";
     $bool=false;
 }
 else {
    $_SESSION ['info']['deftask']=$deftask;
 }
 if (empty($datedeb))
 {
     $_SESSION['errors'][]="Veuillez définir une date de début pour la tâche";
     $bool=false;
 }
 else {
    $_SESSION ['info']['datedeb']=$datedeb;
 }
 if (empty($datefin))
 {
     $_SESSION['errors'][]="Veuillez définir l'échéance final de la tâche";
     $bool=false;
 }
 else {
    $_SESSION ['info']['datefin']=$datefin;
 }
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
      
    if($bool) {               
        $i=$_SESSION['i']-1;

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
                        $queryResult = $mysqli->query("select * from projets_has_utilisateurs where projets_id={$_SESSION['projet_id']} and utilisateurs_id=$y");
                        if (!$queryResult || $queryResult->num_rows<=0){
                            $_SESSION['errors'][]="Veillez à choisir des membres internes au projet";
                            $bool=false;
                            return $bool;
                            }
                        } 
                        $i--;
                    }
                    $_SESSION['taskid']=null;
                    $projet_id = htmlspecialchars(filter_input(INPUT_POST, 'projet'));
                    $projet_id=(int)$projet_id;
                       if($bool) {
                           $queryResult = $mysqli->query("UPDATE taches SET definition='$deftask',date_debut='$datedeb',date_fin='$datefin',nom='$nomtach' WHERE id={$_SESSION['tache_id']}");
                       if ($queryResult!==true)
                           {
                           $_SESSION['errors'][]="Internal error set".mysqli_error($mysqli);
                           $bool=false;
                           } 
                       }
                       
                       $queryResult = $mysqli->query("DELETE FROM utilisateurs_has_taches WHERE taches_id={$_SESSION['tache_id']}"); ;
                        $i=$_SESSION['i']-1;
                        while ($i>=0)
                            {
                            if (isset($idpart[$i]))
                                    {
                                        $y=(int) $idpart[$i];
                                        $queryResult = $mysqli->query("INSERT INTO utilisateurs_has_taches(taches_id,utilisateurs_id) VALUES ('{$_SESSION['tache_id']}','$y')");
                                        
                                    }
                                $i--;
                                }
                    if ($queryResult!==true)
                        {
                        $_SESSION['errors'][]="Internal error set2".mysqli_error($mysqli);
                        $bool=false;
                        } 
                        else {
                        $_SESSION['grant'][]="Enregistrement de la tâche éffectué, aussi un mail à été envoyé";
                    envoismail();
                    }
                    }
                    $_SESSION['tache']['nom']=null;
                    $_SESSION['projet']['nom']=null;
     
     return $bool;
    }
     ?>