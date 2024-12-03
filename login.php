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
            $sql = "SELECT * FROM tb_colaboradores WHERE s_user_name = ? AND s_user_password = ?";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, "ss", $user, $password);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            $ret = mysqli_fetch_array($res); // verifica se encontrou algum usuário

            // Verificando se o login foi bem-sucedido
            if (!$ret) {
                echo "<p id='lgErro' style='color: red;'>Login incorreto</p>";
            } else {
                // Gerando um token de login seguro
                $num = bin2hex(random_bytes(16)); // Gerando um token de 32 caracteres hexadecimais
                session_start();
                
                // Armazenando informações na sessão
                $_SESSION['numlogin'] = $num;
                $_SESSION['username'] = $user;
                $_SESSION['acesso'] = $ret['i_user_acesso']; // 0 restrito, 1 permissão

                // Redirecionando para a página de gerenciamento
                header("Location: gerenciamento.php?num=$num");
                exit; // Garante que o código após o header não seja executado
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
