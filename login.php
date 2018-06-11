<?php

    include_once('master.php');

    $form ="
        <div class='container'>
            <form class='col-6 offset-3'>
                <h1>Login</h1>
                <div class='form-group'>
                    <label for='username'>Username</label>
                    <input type='text' class='form-control' id='username' name='username' aria-describedby='emailHelp' placeholder='username...'>
                </div>
                <div class='form-group'>
                    <label for='password'>Password</label>
                    <input type='password' class='form-control' id='password' placeholder='password...'>
                </div>
                <button type='submit' class='btn btn-primary'>Accedi</button>
            </form>
        </div>
    ";

    echo $form;