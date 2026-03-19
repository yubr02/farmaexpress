<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Compra</title>
    <link rel="stylesheet" href="confirmar.css"> <!-- Adicione seu CSS aqui -->
</head>
<body>

<header>
    <h1>Confirmação de Compra</h1>
</header>

<div class="container">
    <div class="message">
        <?php
        if (isset($_SESSION['message'])) {
            echo "<p>" . $_SESSION['message'] . "</p>";
            unset($_SESSION['message']);
        } else {
            echo "<p>Ocorreu um erro. Tente novamente.</p>";
        }
        ?>
        <a href="index.php" class="button">Voltar à Página Inicial</a>
    </div>
</div>

</body>
</html>
