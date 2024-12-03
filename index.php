<!-- Página de entrada do projeto -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./main.css">
    <title>Show Bikes</title>
</head>
<body>
    <header>
        <?php include "./topo.php"; ?>
    </header>

    <section id="slider" class="slider">
        <?php include "./slider.html"; ?>
    </section>
    
    <section id="search" class="search">
        <?php include "./search.php"; ?>
    </section>

    <section id="destaques" class="destaques">
        <?php include "./destaques.html"; ?>
    </section>

    <footer id="rodape" class="rodape">
        <?php include "./rodape.html"; ?>
    </footer>
</body>
</html>
