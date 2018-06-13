<?php
    include_once("assets/phpbase/session.php");
    include_once("assets/phpbase/loginfunctions.php");
    include_once("assets/phpbase/basescripts.php");

    secure_session_start();
    
    if(login_check()){
       header("location: index.php");
    }

    // Get JSON as a string
    $json_str = file_get_contents('php://input');
    // Get as an object
    $json_obj = json_decode($json_str,true);

    $response = "";
    
    if(isset($json_obj['username'], $json_obj['password']) && $json_obj['username']!="" && $json_obj['password']!=""){
        $user = (string)$json_obj['username'];
        $pass = (string)$json_obj['password'];

        if(login($user,$pass)){
            $response = "ok";
        }
        elseif(isset($_SESSION['login_string'])){
            $response = "ok";
        }
        else{
            $response = "errore";
        }
        echo $response;
    } 
    else{
        echo "errore";
    }

    
