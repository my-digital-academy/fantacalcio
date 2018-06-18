<?php
    include_once("assets/phpbase/classes.php");
    include_once("assets/phpbase/session.php");
    include_once("assets/phpbase/loginfunctions.php");
    
    secure_session_start();

    if(!login_check()){
        header("location: login.html");
    }
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <!-- meta tag -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- links css --> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <!-- icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <title>Fantamondiale</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg nav-fanta">
            <a class="navbar-brand" href="#">
                <img class="logo-fanta" src="https://upload.wikimedia.org/wikipedia/it/1/1f/FIFA_World_Cup_Russia_2018_Logo.png">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navMobile">
                <i class="fas fa-bars fa-2x"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navMobile">
                <ul class="nav navbar-nav">
                    <li class="nav-item nav-fanta-item">
                        <a class="nav-link" href="#" id="squadra">Team</a>
                    </li>
                    <li class="nav-item nav-fanta-item">
                        <a class="nav-link" href="#" id="formazione">Formazione</a>
                    </li>
                    <li class="nav-item nav-fanta-item">
                        <a class="nav-link" href="#" id="risultati">Risultati</a>
                    </li>
                    <li class="nav-item nav-fanta-item">
                        <a class="nav-link" href="#" id="classifica">Classifica</a>
                    </li>
                    <li class="nav-item nav-fanta-item">
                        <a class="nav-link logout" href="logout.php">Esci</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    
    <main></main>    

    <!-- scripts js -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="assets/js/functions.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>