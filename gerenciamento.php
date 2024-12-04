<?php
// Verifica se houve o login antes de fazer a ação
session_start();

if (isset($_SESSION['numlogin'])) {
    $n1 = $_GET['num'];
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
    <header></header>
    
    <section id="gerenciamento" class="gerenciamento">
        <p>Menu principal de gerenciamento</p>
    </section>

    <nav>
        <div class="menu-gerenciamento">
            <button id="menu1" class="menu-style">Motos</button>
            <div id="menudrop1" class="menu-drop">
                <a href="#" target="_self">Novo</a>
                <a href="#" target="_self">Editar</a>
                <a href="#" target="_self">Excluir</a>
                <a href="marcas-modelos.php?num=<?php echo $n1; ?>" target="_self">Marca <br>Modelos</a>
            </div>
        </div>
        <div class="menu-gerenciamento">
            <button id="menu2" class="menu-style">Slider</button>
            <div id="menudrop2" class="menu-drop">
                <a href="#" target="_self">Configurar</a>
            </div>
        </div>
        <?php
        if (isset($_SESSION['acesso']) && $_SESSION['acesso'] == 1) {
            echo "
            <div class='menu-gerenciamento'>
                <button id='menu3' class='menu-style'>Usuários</button>
                <div id='menudrop3' class='menu-drop'>
                    <a href='inclusao-colaborador.php?num=$n1' target='_self'>Novo</a>
                    <a href='editar-colaborador.php?num=$n1' target='_self'>Editar</a>
                    <a href='exclusao-colaborador.php?num=$n1' target='_self'>Excluir</a>
                </div>
            </div>";
        }
        ?>
        
        <div class="menu-gerenciamento">
            <button id="menu4" class="menu-style">LogOff</button>
            <div id="menudrop4" class="menu-drop">
                <a href="login.php" target="_self">Sair</a>
            </div>
        </div>
    </nav>

    <script>
        $(document).ready(function () {
            $("#menu1").click(function () {
                $("#menudrop1").css("visibility", "visible");
                $("#menudrop2, #menudrop3, #menudrop4").css("visibility", "hidden");
            });
            $("#menu2").click(function () {
                $("#menudrop2").css("visibility", "visible");
                $("#menudrop1, #menudrop3, #menudrop4").css("visibility", "hidden");
            });
            $("#menu3").click(function () {
                $("#menudrop3").css("visibility", "visible");
                $("#menudrop1, #menudrop2, #menudrop4").css("visibility", "hidden");
            });
            $("#menu4").click(function () {
                $("#menudrop4").css("visibility", "visible");
                $("#menudrop1, #menudrop2, #menudrop3").css("visibility", "hidden");
            });
            $("#menudrop1, #menudrop2, #menudrop3, #menudrop4").hover(
                function () {
                    $(this).css("visibility", "visible"); // Quando estiver dentro
                },
                function () {
                    $(this).css("visibility", "hidden"); // Quando estiver forea
                }
            );
        });
    </script>
</body>
</html>
