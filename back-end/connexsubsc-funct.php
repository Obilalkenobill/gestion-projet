<?php

/*if(!(bool)$_POST['condition']){

    $_SESSION['errors'][] = 'Vous devez accepter les conditions';

}*/
require "db.php";

function subscribeon()
    {
        if (!empty($_GET['clicked']))
            {
                return subscribe();
            }
    }

        if (!empty($_GET['logout']))
            {
                logout();
            }

function logout ()
    {
    session_destroy();
    !$_SESSION["logged"]=false;
    }
      
function subscribe()
    {
        $bool=true;
        $mysqli=connectdb();
        $mail = htmlspecialchars(filter_input(INPUT_POST, 'mail', FILTER_VALIDATE_EMAIL));
  
        if (!empty($mail))
            {
                $_SESSION ['data']['mail']=$mail; 
            } 
        
        else 
            {
                $_SESSION['errors'][]="Veuillez entrer votre adresse email";
                $bool=false;
            }  

        $bool=true;
        $nom    = htmlspecialchars(filter_input(INPUT_POST, 'nom'));
        
        if (!empty($nom))
            {
                $_SESSION ['data']['nom']=$nom;}
        else 
            {
                $_SESSION['errors'][]="Veuillez entrer votre nom";
                $bool=false;
            }  
    
        $prenom = htmlspecialchars(filter_input(INPUT_POST, 'prenom'));
    
        if (!empty($prenom))
            {
                $_SESSION ['data']['prenom']= $prenom   ;
            }
        else 
            {
                $_SESSION['errors'][]="Veuillez entrer votre prénom";
                $bool=false;
            } 
        
            $password = password_hash(htmlspecialchars(filter_input(INPUT_POST, 'mot_de_passe')), PASSWORD_DEFAULT);

        if (!empty($password))
            {
                $_SESSION ['data']['password']=$password;
            }
        else 
            {
                $_SESSION['errors'][]="Veuillez entrer votre mot de passe";
                $bool=false;
            } 

        if (!empty($mail))
            {
                $queryResult = $mysqli->query("select email from utilisateurs where email=\"{$_SESSION ['data']['mail']}\"");
    
                if (is_bool($queryResult) && !$queryResult)
                    {
                        $_SESSION["errors"][]="Internal error select";
                        $bool=false;
                    }

                if (!empty($mail)&&$queryResult->num_rows>0)
                    {
                        $_SESSION['errors'][]="Mail already use";
                        $bool=false;
                    }
            }

        $creation_date=date("Y-m-d");
        if($bool) 
            {
                $queryResult = $mysqli->query("INSERT INTO utilisateurs (nom,prenom,password,email,creation_date) VALUES ('{$_SESSION ['data']['nom']}','{$_SESSION ['data']['prenom']}', '{$_SESSION['data']['password']}','{$_SESSION ['data']['mail']}','$creation_date')");
        
                if ($queryResult!==true)
                    {
                        $_SESSION['errors'][]="Internal error set".mysqli_error($mysqli);
                        $bool=false;
                    } 
            }
        $condit=filter_input(INPUT_POST,'presence');
        
        if (!empty($condit))
            {
                $_SESSION['data']['condit']=$condit;
            }
    
        else 
            {
                $_SESSION['errors'][]="Veuillez accepter les conditions";
                $bool=false;
            }

        if ($bool)
            {
                $_SESSION['grant'][]="Subscription successful :)"; 
            }
        return $bool;   
    }

function handlelogin()
    {
        $mysqli=connectdb();
        $error=false;
    
        if (empty($_GET['clicked']))
        {
            return false;
        }
        $mail = htmlspecialchars(filter_input(INPUT_POST, 'mail', FILTER_VALIDATE_EMAIL));

        if(empty($mail))
        {
            $_SESSION['errors'][] = 'Vous avez oublié l\'adresse mail';
            $error=true;
            return false;
        }
    
        $queryResult = $mysqli->query("select* from utilisateurs where email=\"$mail\"");
        
        if (is_bool($queryResult) && !$queryResult)
            {
                $_SESSION["errors"][]="Internal error";
                return false;
            }

        if (!empty($_POST['mail'])&&$queryResult->num_rows==0 )
            {
                $_SESSION['errors'][]="Invalid email";
                return false;
            } 
        
            $pass=null;
            if ($queryResult->num_rows>0)
            {
            while($row = $queryResult->fetch_assoc()) 
                {
                    $_SESSION["data"]["userid"]=$row['id'];
                    $_SESSION["data"]["nom"]=$row['nom'];
                    $_SESSION["data"]["prenom"]=$row['prenom'];
                    $pass=$row['password'];
                    $_SESSION["data"]['role']=$row['roles_id'];
                    $_SESSION ['data']['mail']=$mail;
                }
             
                }

                $queryResult = $mysqli->query("SELECT * from roles where id=".$_SESSION["data"]['role']);

                while($row = $queryResult->fetch_assoc()) 
                {
                    $_SESSION["data"]['role']=$row['libelle'];
                }

        $password = htmlspecialchars(filter_input(INPUT_POST, 'mot_de_passe'));
        if(empty($password))
        {
            $_SESSION['errors'][] = 'Vous avez oublié le mot de passe';
            $error=true;
            return false;
        }
           $isconnected=password_verify ( $password ,  $pass) ;

        if (!$isconnected )
            {
                $_SESSION['errors'][]="Mot de passe incorrect";
                return $isconnected;
            }
        else 
            {
                return $isconnected;
            }
            
    }

?>