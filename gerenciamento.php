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
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="./main.css">
    <title>Gerenciamento</title>
</head>
<body>
    <header>
        <?php include "./topo.php"; ?>
    </header>
    
    <h2 class="gerenciamento_titulo">Menu principal de gerenciamento</h2>

    <nav class="gerenciamento">
        <div class="menu-gerenciamento">
                <button id="menu1" class="menu_style">Motos</button>
                <div id="menudrop1" class="menu-drop">
                    <a href="inclusao-colaborador.php?num=<?php echo $n1; ?>" target="_self">Novo</a>
                    <a href="editar-colaborador.php?num=<?php echo $n1?>" target="_self">Editar</a>
                    <a href="exclusao-colaborador.phpnum=<?php echo $n1?>" target="_self">Excluir</a>
                    <a href="marcas-modelos.php?num=<?php echo $n1; ?>" target="_self">Marca <br>Modelos</a>
                </div>
        </div>

        <div class="menu-gerenciamento">
            <button id="menu2" class="menu_style">Slider</button>
            <div id="menudrop2" class="menu-drop">
                <a href="#" target="_self">Configurar</a>
            </div>
        </div>

        <!-- Acesso condicional ao menu de colaboradores -->
        <?php
            if (!$_SESSION['_acesso']) { // Verifica se o usuário tem permissão 0 não tem permissão e 1 tem permissão
        ?>
            <div class="menu-gerenciamento">
                <button id="menu3" class="menu_style">Usuários</button>
                <div id="menudrop3" class="menu-drop">
                    <a href="inclusao-colaborador.php?num=<?php echo $n1; ?>" target="_self">Novo</a>
                    <a href="editar-colaborador.php?num=<?php echo $n1; ?>" target="_self">Editar</a>
                    <a href="exclusao-colaborador.php?num=<?php echo $n1;?>" target="_self">Excluir</a>
                    <a href="marcas-modelos.php?num=<?php echo $n1; ?>" target="_self">Marcas e Modelos</a>
                </div>
            </div>

        <?php
            } // fecha a estrutura condicional aberta
        ?>

        <div class="menu-gerenciamento">
            <button id="menu4" class="menu_style">LogOff</button>
            <div id="menudrop4" class="menu-drop">
                <a href="login.php" target="_self">Sair</a>
            </div>
        </div>

    </nav>

    <script>
        $(document).ready(function () {
            $(".menu_style").on("click", function () {
                $(".menu-drop").css("visibility", "hidden");
                $(this).next(".menu-drop").css("visibility", "visible");
            });

            $(".menu-drop").hover(
                function () {
                    $(this).css("visibility", "visible");
                },
                function () {
                    $(this).css("visibility", "hidden");
                },
            );
        });
    </script>
</body>
</html>
