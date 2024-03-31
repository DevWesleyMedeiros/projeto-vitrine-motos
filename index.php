<!-- Página de entrada do meu site -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show bikes</title>
</head>
<body>
    <header>
        <?php
            include "topo.php";
        ?>
    </header>

    <section id="slider" class="slider">
        <?php
            include "slider.html";
        ?>
    </section>
    
    <section id="search" class="search">
        <?php
            include "search.php";
        ?>
    </section>
    <section id="destaques" class="destaques">
        <?php
            include "destaques.html";
        ?>
    </section>
    <footer id="rodape" class="rodape">
        <?php
            include "rodape.html";
        ?>
    </footer>
</body>
</html>