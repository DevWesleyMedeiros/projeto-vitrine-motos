<?php
    session_start();
    
    if (isset($_SESSION['numlogin'])) {
        $n1 = $_GET['num'] ?? null;
        $n2 = $_SESSION['numlogin'];
        if ($n1 != $n2) {
            echo "<p>O login não foi efetuado</p>";
            exit;
        }
    }else{
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
    <title>excluir colaborador</title>
</head>
<body>
    
    <header>
        <?php
            include "./topo.php";
        ?>
    </header>
    
    <section class="delete-employee">
        
        <a href="gerenciamento.php?num=<?php echo $n1; ?>" target="_self" class="botao-menu">Voltar</a>

        <h1>Excluir colaborador</h1>

        <?php

            if (isset($_GET["f_excluir_colaborador"])) {
                $colaboradorID = $_GET["colaboradores"];
                $sql = "DELETE FROM tb_colaboradores WHERE int_id_colaborador_colaboradores = $colaboradorID";
                mysqli_query($con, $sql);
                $rows = mysqli_affected_rows($con);
                if ($rows >= 1) {
                    echo "<p style='color: #0000ff;'>Colaborador deletado com sucesso</p>";
                }else{
                    echo "<p style='color: #ff0000;'>Erro ao deletar um colaborador</p>";
                }
            }     
        ?>

        <div class="delete-form">
            <form action="exclusao-colaborador.php" name="excluir-colaborador" method="get" class="f-nome-colaborador">
                <input type="hidden" name="num" value="<?php echo $n1; ?>">
                <label>Selecione um colaborador</label>
                <select name="colaboradores" size="10">
                    <?php
                        $sql = "SELECT * FROM tb_colaboradores";
                        $colaboradores = mysqli_query($con, $sql);
                        while ($exibir = mysqli_fetch_array($colaboradores)) {
                            echo "<option value='".$exibir['int_id_colaboradores_colaboradores']."'>".$exibir['str_nome_colaboradores']."</option>";
                        }
                    ?>
                </select>
                <input type="submit" class="delete-button" name="f_excluir_colaborador" value="excluir">
            </form>
        </div>

    </section>
</body>
</html>