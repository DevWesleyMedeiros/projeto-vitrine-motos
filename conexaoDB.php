<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "motorbikesshop";
$port = 3306;

// Criar a conexão
$con = mysqli_connect($servername, $username, $password, $database, $port);

// Verificar conexão
if (!$con) {
    die("A conexão falhou inesperadamente: " . mysqli_connect_error());
}
?>
