<!-- Página de entrada do projeto -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../frontend/styles/main.css">
    <title>Show Bikes</title>
</head>
<body>
    <header>
        <?php include "../frontend/layouts/topo.php"; ?>
    </header>

    <section id="slider" class="slider">
        <?php include "../frontend/pages/slider.html"; ?>
    </section>
    
    <section id="search" class="search">
        <?php include "../frontend/layouts/search.php"; ?>
    </section>

    <section id="destaques" class="destaques">
        <?php include "../frontend/pages/destaques.html"; ?>
    </section>

    <footer id="rodape" class="rodape">
        <?php include "../frontend/pages/rodape.html"; ?>
    </footer>
</body>
</html>
