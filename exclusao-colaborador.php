<!-- coloque aqui o script php que pega os dados de cadastro de usuário número 1 -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <header>
        <?php
            include "topo.php";
        ?>
    </header>
    
    <section id="main" class="main">
        
        <a href="gerenciamento.php?num=<?php echo $n1; ?>" target="_self" class="botao-menu">Voltar</a>
        <h1>Excluir colaborador</h1>

        <?php

            if (isset($_GET["f_excluir_colaborador"])) {}
                
        ?>

        <form action="inclusao-colaborador.php" name="campo-novo-colaborador" method="get" class="f-nome-colaborador">
            <input type="hidden" name="num" value="<?php echo $n1; ?>">
            <label>Selecione um colaborador</label>
            <select name="colaboradores" size="10">
                <option value="id_colaborador">Nome colaborador</option>
            </select>
            <input type="submit" class="botao-menu" name="f_excluir_colaborador" value="excluir">
        </form>
    </section>
</body>
</html>