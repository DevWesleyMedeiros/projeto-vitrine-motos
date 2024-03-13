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