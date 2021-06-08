<?php
require "db.php";
function rempliformon()
{
    if (!empty($_GET['clicked'])){
    return rempliform();
}
}
 function rempliform (){
    $mysqli=connectdb();
   $to = htmlspecialchars(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
$email="support-technique@gmail.com";
$sujet="Message de la maison blanche";

if (!empty($email)){
    $_SESSION ['email']=$to;
  } 
  else {
    $_SESSION['errors'][]="Veuillez entrer votre adresse email";
    return false;
}
$queryResult = $mysqli->query("select password from user where email=\"$to\"");
    if ($queryResult->num_rows>0)
    {  while($row = $queryResult->fetch_assoc()) 
        {
        $_SESSION["data"]["password"]=$row["password"];
      }
      $_SESSION['errors'][]="Un mail vous a été envoyé";
      return true;
    }
    else {
        $_SESSION['errors'][]="Invalid email";
        return false;
    }

$msg='Bonjour,' ."\r\n\r\n";
    $msg .= 'Ce mail a été envoyé depuis le support technique du management de tâche pour un recouvrement de mot de passe';
    $msg .= 'Votre mot de passe est le :';
    $msg .= "***************************************";
    $msg .= $_SESSION["data"]["password"];
    $msg .= "***************************************";
$headers='From: <' .$email . '>'. "\r\n\r\n";
mail($to, $sujet, $msg, $headers);
header('location:recoverpass.php');
 }
?>