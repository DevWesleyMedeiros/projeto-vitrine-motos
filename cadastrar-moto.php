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
    <title>Cadastrar moto</title>
</head>
<body>
    <header>
        <?php include "./topo.php"; ?>
    </header>
    
    <section id="main" class="main">
        <a href="gerenciamento.php?num=<?php echo $n1; ?>" class="botao-voltar" role="button">Voltar</a>
        <h2>Cadastrar uma moto</h2>

        <div class="bikers_form container">
            <form action="cadastrar-moto.php" name="f_cadastrar-motos" method="post" enctype="" class="cadastrar-moto">
                <input type="hidden" name="num" value="<?php echo $n1; ?>">
                <label>Marca</label>
                <select name="marcas-motos">
                    <option value=""></option>
                        <?php
                            $sql = "SELECT * FROM tb_marcas";
                            $resultado = mysqli_query($con, $sql);
                            while($linha = mysqli_fetch_row($resultado)){
                                echo "<option value='".$linha[0]."'>".$linha[1]."></option>";
                            }
                        ?>
                </select>

                <select name="modelos-motos">
                    <option value=""></option>
                        <?php
                            $sql = "SELECT * FROM tb_modelos";
                            $resultado = mysqli_query($con, $sql);
                            while($linha = mysqli_fetch_row($resultado)){
                                echo "<option value='".$linha[0]."'>".$linha[1]."></option>";
                            }
                        ?>
                </select>
            
                <input type="submit" class="global-submitButtons-style" name="f_novo_colaborador" value="Gravar">
            </form>
        </div>
    </section>
</body>
</html>
