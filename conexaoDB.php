<!--Este arquivo Vai fazer a conexão com meu banco de dados -->

<?php

    $servername = "localhost";
    $username = "root";
    $password = "hyu112358@";
    $database = "wesleyveiculos";
    $port = 3307;

    // Criar conexão
    $con = mysqli_connect($servername, $username, $password, $database, $port);

    // Verificar conexão
    if (!$con) {
        die("A conexão falhou inesperadamente: " . mysqli_connect_error());
    }
?>