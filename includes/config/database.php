<?php

function conectarDB(){
    $db = mysqli_connect('localhost','root','','embriagatec_crud');

    if(!$db){
        echo "ERROR NO SE PUDO CONECTAR";
        exit;
    }

    return $db;
}