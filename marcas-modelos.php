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
    <title>Marcas e Modelos</title>
</head>
<body>
    
    <header>
        <?php
            include "topo.php";
        ?>
    </header>
    
    <section id="main" class="main">
        
        <a href="gerenciamento.php?num=<?php echo $n1; ?>" target="_self" class="botao-menu">Voltar</a>
        <h1>Marca e Modelo</h1>

        <!-- Adicionar uma marca ou um modelo -->
        <div id="f_adicionar">
            <form action="marcas-modelos.php" method="get" name="form_add_brand">
                <input type="hidden" name="num" value="<?php echo $n1; ?>">
                <input type="hidden" name="codigo" value="1">
                <label>Nova marca</label>
                <input type="text" name="f_brand" maxlength="50" size="50" required="required" class="text">
                <input type="submit" class="menu-style" name="b_add_brand" value="Adicionar marca"></input>
            </form>

            <form action="marcas-modelos.php" method="get" name="form_add_model">
                <input type="hidden" name="num" value="<?php echo $n1; ?>">
                <input type="hidden" name="codigo" value="2">
                <label>Selecione uma nova marca</label>
                <select name="brands_options" size="10" required="required">
                    <?php
                        $sql = "SELECT * FROM tb_marcas";
                        $col = mysqli_query($con, $sql);

                        while ($exibe = mysqli_fetch_array($col)) {
                            echo "<option value='".$exibe['id_marca']."'>".$exibe['s_marca']."</option>";
                        }
                    ?>
                </select>
                <label>Novo medelo</label>
                <input type="text" name="f_model" maxlength="50" size="50" required="required" class="text">
                <input type="submit" class="menu-style" name="b_add_model" value="Adicionar modelo"></input>
            </form>
        </div>
        
        <!-- Excluir uma marca ou um modelo -->
        <div id="f_excluir_marca">
            <form action="marcas-modelos.php" method="get" name="form_delete_brand">
                <input type="hidden" name="num" value="<?php echo $n1; ?>">
                <input type="hidden" name="codigo" value="2">
                <label>Selecione uma marca</label>
                <select name="brands_options" size="10" required="required">
                    <?php
                        $sql = "SELECT * FROM tb_marcas";
                        $col = mysqli_query($con, $sql);

                        while ($exibe = mysqli_fetch_array($col)) {
                            echo "<option value='".$exibe['id_marca']."'>".$exibe['s_marca']."</option>";
                        }
                    ?>
                </select>
                <label>Novo medelo</label>
                <input type="submit" class="menu-style" name="b_delete_model" value="Excluir marca">Excluir</input>
            </form>
        </div>
       
    </section>

</body>
</html>