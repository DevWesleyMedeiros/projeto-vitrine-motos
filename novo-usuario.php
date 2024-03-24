<?php
    session_start();
    
    if (isset($_SESSION['numlogin'])) {
        $n1 = $_GET['num'];
        $n2 = $_SESSION['numlogin'];
        if ($n1 != $n2) {
            echo "<p>O login não foi efetuado</p>";
            exit;
        }
    }else{
        echo "<p>Página não encontrada</p>";
        exit;
    }

    // No arquivo abaixo esta a variável com o script de conexão com o banco de dados. Temos de fazer o import para fazer o uso dela aqui como o banco de dados e o formulário
    include "conexaoDB.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
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
        
        <a href="gerenciamento.php?num=<?php echo $n1; ?>" target="_self" class="botao-menu">Voltar</a>
        <h1>Novo usuário</h1>

        <!-- Rotina para inserir um novo colaborador na minha tabela -->
        <!-- Toda a rotina abaixo somente será executado logo após o botão de submit ter sido acionado, após o carregamento da página-->
        <!-- Se o meu botão de submit não tiver sido acionado, simplismente só o HTML do formulário é lido -->

        
        <?php
            // f_novo_colaborador - meu botão de submit do formulário
            
            if (isset($_GET["f_novo_colaborador"])) {
                $name = mysqli_real_escape_string($con, $_GET['_nome']);
                $username = mysqli_real_escape_string($con, $_GET['_user']);
                $password = mysqli_real_escape_string($con, $_GET['_senha']);
                $access = mysqli_real_escape_string($con, $_GET['_acesso']); // Supondo que '_acesso' seja o nome correto do parâmetro.

                // Comando SQL para inserir um novo colaborador
                $sql = "INSERT INTO tb_colaboradores (s_nome, s_user_name, s_user_password, i_user_acesso) VALUES ('$name', '$username', '$password', $access)";

                // Executa o comando SQL diretamente no banco de dados
                // Verifica quantas linhas foram afetadas
                mysqli_query($con, $sql); 
                $row = mysqli_affected_rows($con);
                if ($row >= 1) {
                    echo "<p style='color: blue;'>Novo colaborador gravado com sucesso</p>";
                } else {
                    echo "<p style='color: red;'>Erro ao gravar um novo colaborador</p>";
                }
            }
        ?>



        <!-- HTML que carrega o formulário -->
        <form action="novo-usuario.php" name="campo-novo-colaborador" method="get" class="f-nome-colaborador">
            <input type="hidden" name="num" value="<?php echo $n1; ?>">
            <label>Usuário</label>
            <input type="text" name="_nome" maxlength="255" size="50" class="text" requerid="requerid">
            <label>Username</label>
            <input type="text" name="_user" maxlength="255" size="50" class="text" requerid="requerid">
            <label>Senha</label>
            <input type="text" name="_senha" maxlength="255" size="50" class="text" requerid="requerid">
            <label>Acesso</label>
            <input type="text" name="_acesso" class="text" requerid="requerid" pattern="[0-1]+$" placeholder="0 ou 1" title="0 ou 1">
            <input type="submit" class="botao-menu" name="f_novo_colaborador" value="Gravar">
        </form>
    </section>

</body>
</html>