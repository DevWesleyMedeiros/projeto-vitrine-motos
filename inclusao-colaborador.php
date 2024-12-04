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

include "./conexaoDB.php";
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

        <h2>Novo Usuário</h2>
      
        <?php
        if (isset($_GET["f_novo_colaborador"])) {
            $name = mysqli_real_escape_string($con, $_GET['_nome']);
            $username = mysqli_real_escape_string($con, $_GET['_user']);
            $password = mysqli_real_escape_string($con, $_GET['_senha']);
            $access = mysqli_real_escape_string($con, $_GET['_acesso']);

            // A consulta SQL agora não inclui a chave primária (presumindo que seja AUTO_INCREMENT)
            $sql = "INSERT INTO tb_colaboradores (str_nome_colaboradores, str_username_colaboradores, str_senha_colaboradores, int_acesso_colaboradores) VALUES ('$name', '$username', '$password', $access)";

            // Executa a consulta SQL
            mysqli_query($con, $sql);
            $linesDBReturn = mysqli_affected_rows($con);
            
            if ($linesDBReturn >= 1) {
                echo "<p style='color: blue; margin-left: 0.5rem; margin-bottom: 0.5rem;'>Novo colaborador gravado com sucesso</p>";
            } else {
                echo "<p style='color: red; margin-left: 0.5rem; margin-bottom: 0.5rem;'>Erro ao gravar um novo colaborador</p>";
            }
        }
        ?>

        <div class="form_employee">
            <form action="inclusao-colaborador.php" method="get" class="f-nome-colaborador">
                <input type="hidden" name="num" value="<?php echo $n1; ?>">
            
                <label>Usuário</label>
                <input type="text" name="_nome" maxlength="255" size="50" class="text" required aria-label="Nome" placeholder="Seu nome">
                
                <label>Username</label>
                <input type="text" name="_user" maxlength="255" size="50" class="text" required aria-label="Nome de usuário" placeholder="Nome de usuário">
                
                <label>Senha</label>
                <input type="text" name="_senha" maxlength="255" size="50" class="text" required aria-label="Senha" placeholder="Sua senha">
                
                <label>Acesso</label>
                <input type="text" name="_acesso" class="text" required pattern="[0-1]+$" placeholder="0 ou 1" title="0 ou 1"><br>
            
                <input type="submit" class="botao-menu" name="f_novo_colaborador" value="Gravar">
            </form>
        </div>
    </section>
</body>
</html>
