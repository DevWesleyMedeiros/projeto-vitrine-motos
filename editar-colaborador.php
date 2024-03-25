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
    include "conexaoDB.php";
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>excluir colaborador</title>
</head>
<body>
    
    <header>
        <?php
            include "topo.php";
        ?>
    </header>
    
    <section id="main" class="main">
        
        <a href="gerenciamento.php?num=<?php echo $n1; ?>" target="_self" class="botao-menu menu-style">Voltar</a>
        <h1>Editar colaborador</h1>


        <form action="editar-colaborador.php" name="editar-colaborador" method="get" class="f-nome-colaborador">
            <input type="hidden" name="num" value="<?php echo $n1; ?>">
            <label>Selecione um colaborador</label>
            <select name="colaboradores" size="10">
                <?php

                    $sql = "SELECT * FROM tb_colaboradores";
                    $colaboradores = mysqli_query($con, $sql);
                    // $total_colaboradores = mysqli_num_rows($colaboradores);
                    while ($exibir = mysqli_fetch_array($colaboradores)) {
                        echo "<option value='".$exibir['i_id_colaborador']."'>".$exibir['s_nome']."</option>";
                    }
                ?>
            </select>
            <input type="submit" class="botao-menu menu-style" name="f_editar_colaborador" value="Editar">
        </form>

        <?php>

            if (isset($_GET["colaboradores"])) {
                $coloboradorID = $_GET["colaboradores"];
                $sql = "SELECT * FROM tb_colaboradores WHERE i_id_colaborador = $colaboradorID";
                $col = mysqli_query($con, $sql);
                $exibi = mysqli_fetch_array($col);
                if ($exibe >= 1) {
                    echo "
                    <form name='f_editar_colaborador' action='editar-colaborador.php' class='f-nome-colaborador' method='get'>
                    <input type='hidden' name='num' value='<?php echo $n1; ?>'>
                    <input type='hidden' name='id' value='".$exibe['i_id_colaborador']."'>
                    <label>Nome<input type='text' name='_nome' size='50' maxlength='50' required='required' value='".$exibe['s_nome']"'>
                    </label>
                    <label>Nome de usuário<input type='text' name='_username' size='50' maxlength='50' required='required' value='".$exibe['s_user_name']."'>
                    </label>
                    <label>Senha<input type='text' name='_userpassword' size='50' maxlength='50' required='required' value='".$exibe['s_user_password']."'>
                    </label>
                    <label>Acesso<input type='text' name='_useracesso' size='50' maxlength='50' required='required' value='".$exibe['i_user_acesso']."' pattern='[0-1]+$' placeholder='0 ou 1' title='0 ou 1'>
                    </label>
                    <input type='submit' class='botao-menu menu-style' name='f_editarColaborador' value='Gravar'>
                    </form>";
                }
            }
        ?>

        <?php

            if (isset($_GET["f_editar_colaborador"])) {
                $colaboradorID = $_GET["colaboradores"];
                $sql = "DELETE FROM tb_colaboradores WHERE i_id_colaborador = $colaboradorID";
                mysqli_query($con, $sql);
                $rows = mysqli_affected_rows($con);
                if ($rows >= 1) {
                    echo "<p style='color: #0000ff;'>Colaborador deletado com sucesso</p>";
                }else{
                    echo "<p style='color: #ff0000;'>Erro ao deletar um colaborador</p>";
                }
            }     
        ?>
    </section>
</body>
</html>