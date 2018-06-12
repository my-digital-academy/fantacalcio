<?php

const HOST = "mysql:dbname=fantacalcio;host=localhost";
const USER = "root";
const PASSWORD = "root";

$head = "
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'> 
        <title>Fantamondiale</title>
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css' />
        <link rel='stylesheet' href='assets/css/style.css' />
        <script src='https://code.jquery.com/jquery-3.3.1.min.js' integrity='sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=' crossorigin='anonymous'></script>
        <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js'></script>
        <script src='assets/js/login.js'></script>
    </head>
";

$navbar = "
    <nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
        <a class='navbar-brand' href='#'>FantaCore</a>
        <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
        </button>
        <div class='collapse navbar-collapse' id='navbarSupportedContent'>
            <ul class='navbar-nav mr-auto'>
                <li class='nav-item active'>
                    <a class='nav-link' href='#'>Home <span class='sr-only'>(current)</span></a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='#'>Squadra</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='#'>Formazione</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='#'>Risultati</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='#'>Classifica</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link logout' href='logout.php'>Esci</a>
                </li>
            </ul>
        </div>
    </nav>
";