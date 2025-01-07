<?php
    include "./conexaoDB.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./main.css">
    <title>Visualizar Motos</title>
</head>
<body>
    <header>
        <?php include "./topo.php"; ?>
    </header>

    <section class="main">
        <h1>Visualizar Motos Cadastradas</h1>

        <?php
            // Consulta para pegar todos os dados das motos
            $sql = "SELECT * FROM tb_motos";
            $resultado = mysqli_query($con, $sql);

            // Verifica se a consulta teve sucesso
            if (!$resultado) {
                echo "Erro na consulta: " . mysqli_error($con);
                exit;
            }

            // Verifica se há resultados
            if (mysqli_num_rows($resultado) == 0) {
                echo "Nenhuma moto cadastrada.";
            } else {
                // Loop para exibir todas as motos cadastradas
                while ($exibir = mysqli_fetch_assoc($resultado)) {
                    echo "<div class='moto-info'>";
                    echo "<p><strong>ID Moto:</strong> " . $exibir['id_moto_motos'] . "</p>".
                    "<p><strong>ID Marca:</strong> " . $exibir['id_marca_motos'] . "</p>".
                    "<p><strong>ID Modelo:</strong> " . $exibir['id_modelo_motos'] . "</p>".
                    "<p><strong>Versão:</strong> " . $exibir['versao_moto_motos'] . "</p>".
                    "<p><strong>Ano de Fabricação:</strong> " . $exibir['ano_fabricacao_motos'] . "</p>".
                    "<p><strong>Ano Modelo:</strong> " . $exibir['ano_modelo_motos'] . "</p>".
                    "<p><strong>Observação:</strong> " . $exibir['observacao_motos'] . "</p>".
                    "<p><strong>Versão da Moto:</strong> " . $exibir['versao_moto_motos'] . "</p>".
                    "<p><strong>Valor da Moto:</strong> " . "R$".number_format($exibir['valor_motos_motos'], 2, ',', '.') . "</p>".
                    "<p><strong>Foto 01:</strong> <img src='" . $exibir['foto01_moto_motos'] . "' alt='Foto 1' /></p>".
                    "<p><strong>Foto 02:</strong> <img src='" . $exibir['foto02_moto_motos'] . "' alt='Foto 2' /></p>".
                    "<p><strong>Miniatura Moto 01:</strong> <img src='" . $exibir['miniatura01_moto_motos'] . "' alt='Miniatura 1' /></p>".
                    "<p><strong>Miniatura Moto 02:</strong> <img src='" . $exibir['miniatura02_moto_motos'] . "' alt='Miniatura 2' /></p>".
                    "<p><strong>Opcionais 01:</strong> " . $exibir['opcional01_moto_motos'] . "</p>".
                    "<p><strong>Opcionais 02:</strong> " . $exibir['opcional02_moto_motos'] . "</p>".
                    "<p><strong>Opcionais 03:</strong> " . $exibir['opcional03_moto_motos'] . "</p>".
                    "<p><strong>Moto Vendida:</strong> " . $exibir['vendido_moto_motos'] . "</p>".
                    "<p><strong>Moto Bloqueada:</strong> " . $exibir['bloqueada_moto_motos'] . "</p>"."<br>"."<hr>".
                    "</div>";
                }
            }
        ?>
    </section>

    <footer id="rodape" class="rodape">
        <?php include "./rodape.html"; ?>
    </footer>
</body>
</html>
