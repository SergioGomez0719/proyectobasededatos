<?php

$servidor = "localhost";
$db = "id20796575_trabajofinalbases";
$username = "id20796575_sergiouao";
$password = "@Autonoma2023";

try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$db", $username, $password);



} catch(Exception $e) {
    echo $e->getMessage();
}

?>