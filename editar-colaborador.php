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
    <title>Editar colaborador</title>
</head>
<body>
    
    <header>
        <?php include "./topo.php"; ?>
    </header>
    
    <section id="main" class="main">
        
        <a href="gerenciamento.php?num=<?php echo $n1; ?>" target="_self" class="botao-voltar">Voltar</a>
        <h1>Editar colaborador</h1>

        <form action="editar-colaborador.php" name="editar-colaborador" method="get" class="f-editar-colaborador">
            <input type="hidden" name="num" value="<?php echo $n1; ?>">
            <label>Selecione um colaborador</label>
            <select name="colaboradores" size="10">
                <?php
                    $sql = "SELECT * FROM tb_colaboradores";
                    $colaboradores = mysqli_query($con, $sql);
                    while ($exiber = mysqli_fetch_array($colaboradores)) {
                        echo "<option value='".$exiber['int_id_colaborador_colaboradores']."'>".$exiber['str_nome_colaboradores']."</option>";
                    }
                ?>
            </select>
            <input type="submit" class="global-submitButtons-style" name="f_editar_colaborador" value="Editar">
        </form>

        <?php
        if (isset($_GET["f_editar_colaborador"])) {
            $colaboradorID = $_GET["colaboradores"];
            $sql = "SELECT * FROM tb_colaboradores WHERE int_id_colaborador_colaboradores = $colaboradorID";
            $col = mysqli_query($con, $sql);
            $exibe = mysqli_fetch_array($col);
            if ($exibe) {
                echo "
                <form name='f_editar_colaborador' action='editar-colaborador.php' class='f-nome-colaborador' method='get'>
                    <input type='hidden' name='num' value='$n1'>
                    <input type='hidden' name='id' value='".$exibe['int_id_colaborador_colaboradores']."'>

                    <label>Nome</br>
                    <input type='text' name='_nome' size='50' maxlength='50' required='required' value='".$exibe['str_nome_colaboradores']."'></label>

                    <label>Nome de usuário</br>
                    <input type='text' name='_username' size='50' maxlength='50' required='required' value='".$exibe['str_username_colaboradores']."'></label>

                    <label>Senha</br>
                    <input type='password' name='_userpassword' size='50' maxlength='50' required='required' value='".$exibe['str_senha_colaboradores']."'></label>

                    <label>Acesso</br>
                    <input type='text' name='_useracesso' size='50' maxlength='50' required='required' value='".$exibe['int_acesso_colaboradores']."' pattern='[0-1]+$' placeholder='0 ou 1' title='0 ou 1'></label>

                    <input type='submit' name='f_editarColaborador' value='Gravar'>
                </form>";
            }
        }

        if (isset($_GET["f_editarColaborador"])) {
            $id = $_GET['id']; // ID do colaborador
            $name = $_GET['_nome'];
            $user_name = $_GET['_username'];
            $user_password = $_GET['_userpassword'];
            $user_access = $_GET['_useracesso'];

            $sql = "UPDATE tb_colaboradores SET $id, $name, $user_name, $user_password, $user_access WHERE i_id_colaborador = $id";

            $res = mysqli_query($con, $sql);
            $linhas = mysqli_affected_rows($res);
            if ($linhas >= 1) {
                header('location: editar-colaborador.php?num'.$n1);
            }else{
                echo "<p style='color: red;'>Erro ao atualizar colaborador</p>";
            }
        }
            
        ?>
        <?php

            if (isset($_GET["f_editarColaborador"])) {
                $colaboradorID = $_GET["id"];
                // Aqui deveria ser uma operação de atualização, não exclusão
                $sql = "UPDATE tb_colaboradores SET s_nome = '".$_GET['_nome']."', s_user_name = '".$_GET['_username']."', s_user_password = '".$_GET['_userpassword']."', i_user_acesso = '".$_GET['_useracesso']."' WHERE i_id_colaborador = $colaboradorID";
                mysqli_query($con, $sql);
                $rows = mysqli_affected_rows($con);
                if ($rows >= 1) {
                    echo "<p style='color: #0000ff;'>Colaborador atualizado com sucesso</p>";
                }else{
                    echo "<p style='color: #ff0000;'>Erro ao atualizar um colaborador</p>";
                }
            }     
        ?>
    </section>
</body>
</html>
