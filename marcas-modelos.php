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
    include "./conexaoDB.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./main.css">
    <title>Marcas e Modelos</title>
</head>
<body>
    
    <header>
        <?php
            include "./topo.php";
        ?>
    </header>
    
    <section id="main" class="main">
        
        <a href="gerenciamento.php?num=<?php echo $n1; ?>" target="_self" class="botao-menu">Voltar</a>
        <h1>Marca e Modelo</h1>

        <?php
            if (isset($_GET['codigo'])) {
                // Nova marca
                $codigo = $_GET['codigo'];
                if ($codigo == 1) {
                    $marca = $_GET['f_brand'];
                    $sql = "INSERT INTO tb_marcas (str_nome_marca_marcas) VALUE ('$marca')";
                    mysqli_query($con, $sql); 
                    $rows = mysqli_affected_rows($con);
                    if ($rows >= 1) {
                        echo "<script>alert('Nova marca adicionada com sucesso');</script>";
                    }else{
                        echo "<script>alert('ERRO ao adicionar nova marca');</script>";
                    }
                }else if ($codigo == 2) {
                    // Novo modelo
                    $modelo = $_GET['f_model'];
                    $id_marca = $_GET['f_brand'];
                    $sql = "INSERT INTO tb_modelos (str_nome_modelo_modelos, int_id_marca_modelos) VALUE ('$modelo', $id_marca)";
                    mysqli_query($con, $sql); 
                    $rows = mysqli_affected_rows($con);
                    if ($rows >= 1) {
                        echo "<script>alert('Novo modelo adicionado com sucesso');</script>";
                    }else{
                        echo "<script>alert('ERRO ao adicionar novo modelo');</script>";
                    }
                }else if ($codigo == 3) {
                    // Excluir marca
                    $id_marca = $_GET['delete_brands_options'];
                    $sql = "DELETE FROM tb_marcas WHERE int_id_marca_marcas = $id_marca";
                    mysqli_query($con, $sql);
                    $rows = mysqli_affected_rows($con);
                    if ($rows >= 1) {
                        echo "<script>alert('Marca deletada com sucesso');</script>";
                    }else{
                        echo "<script>alert('ERRO ao deletar nova marca');</script>";
                    }
                }else{
                    // excluir modelo
                    $id_modelo = $_GET['delete_model_options'];
                    $sql = "DELETE FROM tb_modelos WHERE int_id_modelo_modelos = $id_modelo";
                    mysqli_query($con, $sql);
                    $rows = mysqli_affected_rows($con);
                    if ($rows >= 1) {
                        echo "<script>alert('Modelo deletado com sucesso');</script>";
                    }else{
                        echo "<script>alert('ERRO ao deletar novo modelo');</script>";
                    }
                }
            }
        ?>
        
        <!-- Div para Adicionar uma marca -->
        <div id="f_adicionar" class="f_adicionar">
            <form action="marcas-modelos.php" method="get" name="form_add_brand" class="adicionar">
                <input type="hidden" name="num" value="<?php echo $n1; ?>">
                <input type="hidden" name="codigo" value="1">
                <label>Nova marca</label>
                <input type="text" name="f_brand" maxlength="50" size="50" required="required" class="global-input-style">
                <input type="submit" class="global-submitButtons-style" name="b_add_brand" value="Adicionar"></input>
            </form>

            <!-- Adicionar um modelo -->
            <form action="marcas-modelos.php" method="get" name="form_add_model" class="adicionar">
                <input type="hidden" name="num" value="<?php echo $n1; ?>">
                <input type="hidden" name="codigo" value="2">
                <label>Selecione uma nova marca</label>
                <select name="brands_options" size="10" required="required">
                    <?php
                        $sql = "SELECT * FROM tb_marcas";
                        $col = mysqli_query($con, $sql);

                        while ($exibe = mysqli_fetch_array($col)) {
                            echo "<option value='".$exibe['int_id_marca_marcas']."'>".$exibe['str_nome_marca_marcas']."</option>";
                        }
                    ?>
                </select>
                <label>Novo medelo</label>
                <input type="text" name="f_model" maxlength="50" size="50" required="required" class="global-input-style">
                <input type="submit" class="global-submitButtons-style" name="b_add_model" value="Adicionar"></input>
            </form>
        </div>

        <!-- Deletar marca -->
        <div id="f_excluir_marca" class="f_excluir_marca">
            <form action="marcas-modelos.php" method="get" name="form_delete_brand" class="deletar">
                <input type="hidden" name="num" value="<?php echo $n1; ?>">
                <input type="hidden" name="codigo" value="3">
                <label>Selecione uma marca</label>
                <select name="delete_brands_options" size="10" required="required">
                    <?php
                        $sql = "SELECT * FROM tb_marcas";
                        $col = mysqli_query($con, $sql);

                        while ($exibe = mysqli_fetch_array($col)) {
                            echo "<option value='".$exibe['int_id_marca_marcas']."'>".$exibe['str_nome_marca_marcas']."</option>";
                        }
                    ?>
                </select>
                <br/> 
                <input type="submit" class="global-submitButtons-style" name="b_delete_brand" value="Excluir marca"></input>
            </form>

            <!-- Deletar modelo -->
            <form action="marcas-modelos.php" method="get" name="form_delete_model" class="deletar">
                <input type="hidden" name="num" value="<?php echo $n1; ?>">
                <input type="hidden" name="codigo" value="4">
                <label>Selecione um modelo</label>
                <select name="delete_model_options" size="10" required="required">
                    <?php
                        $sql = "SELECT * FROM tb_modelos";
                        $col = mysqli_query($con, $sql);

                        while ($exibe = mysqli_fetch_array($col)) {
                            echo "<option value='".$exibe['int_id_modelo_modelos']."'>".$exibe['str_nome_modelo_modelos']."</option>";
                        }
                    ?>
                </select>
                <br/>  
                <input type="submit" class="global-submitButtons-style" name="b_delete_model" value="Excluir modelo"></input>
            </form>
        </div>
    </section>
</body>
</html>
<!-- 
 1 Adicionar / criar nova marca
 2 Adicionar / criar novo modelo
 3 Deletar marca
 4 Deletar modelo
 -->