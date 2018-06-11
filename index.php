<?php
    include_once('master.php');

    if(!login_check()){
        header("location: login.php");
    }

    echo $navbar;
