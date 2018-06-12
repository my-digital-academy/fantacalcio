<?php
    include_once("assets/phpbase/loginfunctions.php");
    include_once("assets/phpbase/basescripts.php");
    
    if(login_check()){
        header("location: index.php");
    }

    $form ="
        <div class='container'>
            <form class='col-6 offset-3' action='login.php' id='login-form' method='POST'>
                <h1>Login</h1>
                <div class='form-group'>
                    <label for='username'>Username</label>
                    <input type='text' class='form-control' name='username' aria-describedby='emailHelp' autocomplete='off' placeholder='username...'>
                </div>
                <div class='form-group'>
                    <label for='password'>Password</label>
                    <input type='password' class='form-control' name='password' placeholder='password...'>
                </div>
                <button type='submit' class='btn btn-primary'>Accedi</button>
            </form>
            <p class='error-message'></p>
    ";

    if(isset($_POST['username'], $_POST['password']) && $_POST['username']!="" && $_POST['password']!=""){
        $user = (string)$_POST['username'];
        $pass = (string)$_POST['password'];

        if(login($user,$pass)){
            header("location: index.php");
        }
        elseif(isset($_SESSION['login_string'])){
            header("location: index.php");
        }
        else{

        }
    } 
    else{

    }

    echo $head;
    echo $form;

    
