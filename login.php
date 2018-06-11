<?php
    include_once('master.php');
    
    if(login_check()){
        header("location: index.php");
    }

    $form ="
        <div class='container'>
            <form class='col-6 offset-3' action='login.php' method='POST'>
                <h1>Login</h1>
                <div class='form-group'>
                    <label for='username'>Username</label>
                    <input type='text' class='form-control' id='username' name='username' aria-describedby='emailHelp' placeholder='username...'>
                </div>
                <div class='form-group'>
                    <label for='password'>Password</label>
                    <input type='password' class='form-control' id='password' name='password' placeholder='password...'>
                </div>
                <button type='submit' class='btn btn-primary'>Accedi</button>
            </form>
    ";

    $script = "
        <script>
            let form = document.getElementsByTagName('form')[0];
            document.addEventListener('DOMContentLoaded', function(event) {
                form.addEventListener('submit', function(e){
                    e.preventDefault();
                    if(validateForm(form) == 'true'){

                    }
                });
            });
        </script>
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
            $form .= "<p class='col-6 offset-3 error-message fade'>Username o Password errati</p></div>";
        }
    } 
    else{
        $form .= "<p class='col-6 offset-3 error-message'></p></div>";
    }

    echo $form;

    echo $script;

    
