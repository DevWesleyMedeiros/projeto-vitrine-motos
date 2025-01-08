<?php
    session_start();
    
    // Verificação da sessão de login
    if (isset($_SESSION['numlogin'])) {
        $n1 = (int)$_GET['num'];  // Garantir que o número seja um inteiro
        $n2 = (int)$_SESSION['numlogin']; // Garantir que o número da sessão seja um inteiro
        if ($n1 !== $n2) {
            echo "<p>O login não foi efetuado</p>";
            exit;
        }
    } else {
        echo "<p>Página não encontrada</p>";
        exit;
    }

    // Inclusão do arquivo de conexão com o banco de dados
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
        <a href="gerenciamento.php?num=<?php echo $n1; ?>" class="botao-voltar" role="button">Voltar</a>
        <h1>Marca e Modelo</h1>

        <?php
            if (isset($_GET['codigo'])) {
                // Validar o código para garantir que seja um valor esperado
                $codigo = filter_var($_GET['codigo'], FILTER_VALIDATE_INT);
                if (!$codigo) {
                    echo "<script>alert('Código inválido');</script>";
                    exit;
                }
                // Inserir nova marca
                if ($codigo == 1) {
                    if (isset($_GET['f_brand']) && !empty($_GET['f_brand'])) {
                        $marca = mysqli_real_escape_string($con, $_GET['f_brand']);
                        // Não precisamos definir o id_marca, pois o MySQL vai auto-incrementá-lo
                        $sql = "INSERT INTO tb_marcas (str_nome_marca_marcas) VALUES (?)";
                        $stmt = mysqli_prepare($con, $sql);
                        mysqli_stmt_bind_param($stmt, 's', $marca);
                        if (mysqli_stmt_execute($stmt)) {
                            echo "<script>alert('Nova marca adicionada com sucesso');</script>";
                        } else {
                            echo "<script>alert('Erro ao adicionar nova marca');</script>";
                        }
                    }
                }
                // Inserir novo modelo
                elseif ($codigo == 2) {
                    if (isset($_GET['f_model'], $_GET['f_brand']) && !empty($_GET['f_model'])) {
                        $modelo = mysqli_real_escape_string($con, $_GET['f_model']);
                        $id_marca = (int)$_GET['f_brand'];
                        $sql = "INSERT INTO tb_modelos (str_nome_modelo_modelos, id_marca_modelos) VALUES (?, ?)";
                        $stmt = mysqli_prepare($con, $sql);
                        mysqli_stmt_bind_param($stmt, 'si', $modelo, $id_marca);
                        if (mysqli_stmt_execute($stmt)) {
                            echo "<script>alert('Novo modelo adicionado com sucesso');</script>";
                        } else {
                            echo "<script>alert('Erro ao adicionar novo modelo');</script>";
                        }
                    }
                }
                // Excluir marca
                elseif ($codigo == 3) {
                    if (isset($_GET['delete_brands_options'])) {
                        $id_marca = (int)$_GET['delete_brands_options'];
                        $sql = "DELETE FROM tb_marcas WHERE id_marca_marcas = ?";
                        $stmt = mysqli_prepare($con, $sql);
                        mysqli_stmt_bind_param($stmt, 'i', $id_marca);
                        if (mysqli_stmt_execute($stmt)) {
                            echo "<script>alert('Marca deletada com sucesso');</script>";
                        } else {
                            echo "<script>alert('Erro ao deletar marca');</script>";
                        }
                    }
                }
                // Excluir modelo
                elseif ($codigo == 4) {
                    if (isset($_GET['delete_model_options'])) {
                        $id_modelo = (int)$_GET['delete_model_options'];
                        $sql = "DELETE FROM tb_modelos WHERE id_modelo_modelos = ?";
                        $stmt = mysqli_prepare($con, $sql);
                        mysqli_stmt_bind_param($stmt, 'i', $id_modelo);
                        if (mysqli_stmt_execute($stmt)) {
                            echo "<script>alert('Modelo deletado com sucesso');</script>";
                        } else {
                            echo "<script>alert('Erro ao deletar modelo');</script>";
                        }
                    }
                }
            }
        ?>

        <button class="show-add-form buttons" id="show-add-form">Adicionar</button>
        <button class="id show-del-form buttons" id="show-del-form">Deletar</button>
        
        <div class="add-form" id="add-form">

            <!-- Formulários para Adicionar Marca -->
            <div id="f_adicionar_marca" class="f_adicionar_marca">
                <form action="marcas-modelos.php" method="get" name="form_add_brand" class="adicionar">
                    <input type="hidden" name="num" value="<?php echo $n1; ?>">
                    <input type="hidden" name="codigo" value="1">
                    <label>Nova marca</label>
                    <input type="text" name="f_brand" maxlength="50" size="50" required="required" class="global-input-style">
                    <input type="submit" class="global-submitButtons-style" name="b_add_brand" value="Adicionar">
                </form>
            </div>

            <!-- Adicionar um modelo -->
            <div class="f_adicionar_modelo" id="f_adicionar_modelo">
                <form action="marcas-modelos.php" method="get" name="form_add_model" class="adicionar">
                    <input type="hidden" name="num" value="<?php echo $n1; ?>">
                    <input type="hidden" name="codigo" value="2">
                    <label>Selecione uma nova marca</label>
                    <select name="f_brand" size="10" required="required">
                        <?php
                            $sql = "SELECT * FROM tb_marcas";
                            $col = mysqli_query($con, $sql);
                            while ($exibe = mysqli_fetch_array($col)) {
                                echo "<option value='".$exibe['id_marca_marcas']."'>".$exibe['str_nome_marca_marcas']."</option>";
                            }
                        ?>
                    </select>
                    <label>Novo modelo</label>
                    <input type="text" name="f_model" maxlength="50" size="50" required="required" class="global-input-style">
                    <input type="submit" class="global-submitButtons-style" name="b_add_model" value="Adicionar">
                </form>
            </div>

        </div>

        <div class="del-form" id="del-form">

            <!-- Formulários para Deletar Marca -->
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
                                echo "<option value='".$exibe['id_marca_marcas']."'>".$exibe['str_nome_marca_marcas']."</option>";
                            }
                        ?>
                    </select>
                    <br/>
                    <input type="submit" class="global-submitButtons-style" name="b_delete_brand" value="Excluir marca">
                </form>
            </div>

            <!-- Formulário para Deletar um modelo -->
            <div class="f_deletar_modelo" id="f_deletar_modelo">
                <form action="marcas-modelos.php" method="get" name="form_delete_model" class="deletar">
                    <input type="hidden" name="num" value="<?php echo $n1; ?>">
                    <input type="hidden" name="codigo" value="4">
                    <label>Selecione um modelo</label>
                    <select name="delete_model_options" size="10" required="required">
                        <?php
                            $sql = "SELECT tb_modelos.id_modelo_modelos, tb_modelos.str_nome_modelo_modelos, tb_marcas.str_nome_marca_marcas 
                                    FROM tb_modelos 
                                    JOIN tb_marcas ON tb_modelos.id_marca_modelos = tb_marcas.id_marca_marcas";
                            $col = mysqli_query($con, $sql);
                            while ($exibe = mysqli_fetch_array($col)) {
                                echo "<option value='".$exibe['id_modelo_modelos']."'>".$exibe['str_nome_modelo_modelos']." - ".$exibe['str_nome_marca_marcas']."</option>";
                            }
                        ?>
                    </select>
                    <br/>
                    <input type="submit" class="global-submitButtons-style" name="b_delete_model" value="Excluir modelo">
                </form>
            </div>
        </div>

    </section>
    <script src="./main.js"></script>
</body>
</html>
