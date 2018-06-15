<?php

    include("assets/phpbase/classes.php");

    echo "<pre>";
    $b = new JSON();
    $b = $b->getJson(1);
    var_dump($b);