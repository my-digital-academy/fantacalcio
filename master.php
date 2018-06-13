<?php
    include_once("assets/phpbase/classes.php");
    include_once("assets/phpbase/session.php");
    include_once("assets/phpbase/loginfunctions.php");
    
    secure_session_start();

    if(!login_check()){
        header("location: login.html");
    }

