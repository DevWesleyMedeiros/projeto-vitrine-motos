<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <?php
            include "topo.php";
        ?>
    </header>
    
    <section id="main" class="main">

        <?php

        include "conexaoDB.php"; // Acessa o banco de dados

        // Função "isset" Verifica se o formulário foi submetido Retorna true se SIM ou false se NÃO
        if (isset($_POST["f_logar"])) {
            $user = $_POST["f_user"];
            $password = $_POST["f_senha"];

            $sql = "SELECT * FROM tb_colaboradores WHERE s_user_name='$user' AND s_user_password='$password'";
            $res = mysqli_query($con, $sql); // executa o comando sql
            $ret = mysqli_fetch_array($res); // verifica quantas linhas foram retornadas pela conexão quantas eu tiver no banco de dados, nesse caso retorna em formato de array

            if ($ret == 0) {
                echo "<p id='lgErro' style='color: red;'>Login incorreto</p>";
            } else {
                $chave1 = "abcdefghijklmnopqrstuvwxyz";
                $chave2 = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                $chave3 = "0123456789";
                $chave = str_shuffle($chave1 . $chave2 . $chave3);
                $tam = strlen($chave);
                $num = "";
                $qtde = rand(20, 50);
                for ($i = 0; $i < $qtde; $i++) {
                    $pos = rand(0, $tam);
                    $num .= substr($chave, $pos, 1);
                }
                session_start();
                $_SESSION['numlogin'] = $num;
                $_SESSION['username'] = $user;
                $_SESSION['acesso'] = $ret['i_user_acesso']; // 0 restrito e 1 permissção

                header("Location: gerenciamento.php?num=$num");
            }
        }
        mysqli_close($con); // fechar a conexão de con
        ?>    
    
        <form action="login.php" method="post" name="f_login" id="f_login" class="f_login">
            <label for="user">Usuário</label>
            <input type="text" name="f_user" id="user">
            <label for="password">Senha</label>
            <input type="password" name="f_senha" id="password">
            <input type="submit" value="LOGAR" name="f_logar">
        </form>
    </section>

    <footer id="rodape" class="rodape">
        <?php
            include "rodape.html";
        ?>
    </footer>
</body>
</html>