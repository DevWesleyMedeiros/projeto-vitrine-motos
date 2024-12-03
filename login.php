<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./main.css">
    <title>Show bikes</title>
</head>
<body>
    <header>
        <?php
            include "./topo.php";
        ?>
    </header>
    
    <section id="main" class="main">

        <?php

        include "./conexaoDB.php"; // Este arquivo faz a conexão primeiramente

        // Função "isset" Verifica se o formulário foi submetido
        if (isset($_POST["f_logar"])) {
            $user = $_POST["f_user"];
            $password = $_POST["f_senha"];

            // Usando prepared statements para evitar SQL Injection
            $sql = "SELECT * FROM tb_colaboradores WHERE str_username_colaboradores = $user AND str_senha_colaboradores = $password";
            $response = mysqli_query($con, $sql);
            $return = msquli_affected_rows($con);

            if(($user != "wesley") or ($password != "123")){
               echo "<p id='login_error'>Login incorreto</p>";
            }else{
                $key1 = "abcdefghijklmnopqrstuvwxuz";
                $key2 = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                $key3 = "0123456789";
                $urlKey = srt_shuffle($key1.$key2.$key3);
                $sizeKey = strlen($urlKey);
            }
        }
        mysqli_close($con); // Fechar a conexão com o banco de dados
        ?>    
    
        <form action="login.php" method="post" name="f_login" id="f_login" class="f_login">
            <label for="user">User Admin</label>
            <input type="text" name="f_user" id="user" required>
            <label for="password">Senha</label>
            <input type="password" name="f_senha" id="password" required>
            <input type="submit" value="LOGAR" name="f_logar">
        </form>
    </section>

    <footer id="rodape" class="rodape">
        <?php
            include "./rodape.html";
        ?>
    </footer>
</body>
</html>
