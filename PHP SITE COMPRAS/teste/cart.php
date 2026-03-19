<?php
session_start();
include 'db.php'; 

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

$query = "SELECT c.produto_id, c.quantidade, p.nome, p.preco, p.imagem 
          FROM carrinho c 
          JOIN produtos p ON c.produto_id = p.id 
          WHERE c.usuario_id = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="cart.css">
</head>
<body>

<header>
<div class="header-content">
        <img src="images/logo.jpeg" alt="Farma Express Logo" class="logo">
        <h1>Farma Express</h1>
    <h1>Carrinho de Compras</h1>
    <nav>
            <a href="home.php">Home</a>
            <a href="historico.php">Histórico de Pedidos</a>
            
            <a href="login.php">Entrar</a>            
   </nav>
</header>

<div class="container">
    <div class="cart-items">
        <h2>Itens no Carrinho</h2>
        <?php
        if ($result->num_rows > 0) {
            $total = 0;
            while ($row = $result->fetch_assoc()) {
                $subtotal = $row["preco"] * $row["quantidade"];
                $total += $subtotal;
                echo '<div class="cart-item">';
                echo '<img src="' . $row["imagem"] . '" alt="' . $row["nome"] . '">';
                echo '<div>';
                echo '<h3>' . $row["nome"] . '</h3>';
                echo '<p>Quantidade: ' . $row["quantidade"] . '</p>';
                echo '</div>';
                echo '<span>R$ ' . number_format($subtotal, 2, ',', '.') . '</span>';

                // Formulário de remoção separado
                echo '<form action="remover.php" method="POST" style="display:inline;">';
                echo '<input type="hidden" name="produto_id" value="' . $row["produto_id"] . '">';
                echo '<button type="submit" name="remove" class="remove">Remover</button>';
                echo '</form>';

                echo '</div>';
            }
            echo '<div class="cart-total">Total: R$ ' . number_format($total, 2, ',', '.') . '</div>';
        } else {
            echo "<p>Carrinho vazio.</p>";
        }
        ?>
        
        <!-- Formulário de Finalização -->
        <form action="finalizar.php" method="POST">
            <div class="payment-method">
                <h3>Forma de Pagamento</h3>
                <select name="forma_pagamento" id="forma_pagamento" required>
                    <option value="">Selecione</option>
                    <option value="Dinheiro">Dinheiro</option>
                    <option value="Cartão de Crédito">Cartão de Crédito</option>
                </select>
            </div>

            <div id="detalhes_pagamento"></div>

            <button type="submit" name="finalizar">Finalizar Compra</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('forma_pagamento').addEventListener('change', function() {
        var detalhes = document.getElementById('detalhes_pagamento');
        detalhes.innerHTML = ''; // Limpa os detalhes anteriores

        if (this.value === 'Cartão de Crédito') {
            detalhes.innerHTML = `
                <div class="cartao-credito">
                    <label for="numero_cartao">Número do Cartão:</label>
                    <input type="text" name="numero_cartao" id="numero_cartao" pattern="\\d{16}" maxlength="16">
                    
                    <label for="validade_cartao">Validade (MM/AA):</label>
                    <input type="text" name="validade_cartao" id="validade_cartao" pattern="\\d{2}/\\d{2}" maxlength="5">
                    
                    <label for="cvv_cartao">CVV:</label>
                    <input type="text" name="cvv_cartao" id="cvv_cartao" pattern="\\d{3}" maxlength="3">
                </div>
            `;
        }
    });
</script>

<footer>
    <p>&copy; 2024 Farma Express</p>
</footer>


</body>
</html>

<?php
$conn->close();
?>
