<?php

    $database= new mysqli("localhost","root","","bytehealth (1)");
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>