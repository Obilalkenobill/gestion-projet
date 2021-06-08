<?php

function connectdb()
    {
        $user='root';
        $password='';
        $database='mytask';
        $port=3306;
        $mysqli= mysqli_connect('127.0.0.1',$user,$password,$database,$port);
        if (mysqli_connect_errno()) 
            {
                echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
                $_SESSION['error'][]=mysqli_connect_error();
            }
            return $mysqli;
    }
connectdb();
