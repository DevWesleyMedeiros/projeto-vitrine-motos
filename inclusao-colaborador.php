<?php  
session_start();

if (isset($_SESSION['numlogin'])) {
    $n1 = $_GET['num'] ?? null;
    $n2 = $_SESSION['numlogin'];
    if ($n1 != $n2) {
        echo "<p>O login não foi efetuado</p>";
        exit;
    }
} else {
    echo "<p>Página não encontrada</p>";
    exit;
}

include "./conexaoDB.php"; // Verificação de conexão já deve estar na conexaoDB.php
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./main.css">
    <title>Incluir colaborador</title>
</head>
<body>
    <header>
        <?php include "./topo.php"; ?>
    </header>
    
    <section id="main" class="main">
        <a href="gerenciamento.php?num=<?php echo $n1; ?>" class="botao-menu" role="button">Voltar</a>

        <h1>Novo Usuário</h1>

        <?php
        if (isset($_GET["f_novo_colaborador"])) {
            $name = mysqli_real_escape_string($con, $_GET['_nome']);
            $username = mysqli_real_escape_string($con, $_GET['_user']);
            $password = mysqli_real_escape_string($con, $_GET['_senha']);
            $access = mysqli_real_escape_string($con, $_GET['_acesso']);

            $sql = "INSERT INTO tb_colaboradores (s_nome, s_user_name, s_user_password, i_user_acesso) 
                    VALUES ('$name', '$username', '$password', $access)";

            if (mysqli_query($con, $sql)) {
                echo "<p style='color: blue;'>Novo colaborador gravado com sucesso</p>";
            } else {
                echo "<p style='color: red;'>Erro ao gravar um novo colaborador: " . mysqli_error($con) . "</p>";
            }
        }
        ?>

        <form action="inclusao-colaborador.php" method="get" class="f-nome-colaborador">
            <input type="hidden" name="num" value="<?php echo $n1; ?>">
            
            <label>Usuário</label>
            <input type="text" name="_nome" maxlength="255" size="50" class="text" required>

            <label>Username</label>
            <input type="text" name="_user" maxlength="255" size="50" class="text" required>

            <label>Senha</label>
            <input type="text" name="_senha" maxlength="255" size="50" class="text" required>

            <label>Acesso</label>
            <input type="text" name="_acesso" class="text" required pattern="[0-1]+$" placeholder="0 ou 1" title="0 ou 1">
            
            <input type="submit" class="botao-menu" name="f_novo_colaborador" value="Gravar">
        </form>
    </section>
</body>
</html>
