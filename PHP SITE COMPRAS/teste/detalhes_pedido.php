<?php
session_start();
include 'db.php'; 

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$pedido_id = $_GET['pedido_id']; // Pegando o ID do pedido da URL

// Busca os detalhes do pedido na tabela detalhes_pedido
$query = "SELECT p.nome, p.preco, p.imagem, dp.quantidade 
          FROM detalhes_pedido dp 
          JOIN produtos p ON dp.produto_id = p.id 
          WHERE dp.pedido_id = ?"; // Usando a coluna correta

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $pedido_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Pedido</title>
    <link rel="stylesheet" href="detalhes_pedido.css">
</head>
<body>

<header>
    <h1>Detalhes do Pedido</h1>
    <nav>
    <a href="index.php">Quem Somos</a>
    <a href="historico.php">Histórico de Pedidos</a>
   
    
    <!-- Verifica se o usuário está logado -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <!-- Se o usuário estiver logado, mostra a opção 'Sair' -->
        <a href="logout.php">Sair</a>
    <?php else: ?>
        <!-- Se o usuário não estiver logado, mostra a opção 'Entrar' -->
        <a href="login.php">Entrar</a>
    <?php endif; ?>
    
    <a href="cart.php">Carrinho (<?php echo isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : '0'; ?>)</a>
</nav>
</header>

<div class="container">
    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Imagem</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                while ($row = $result->fetch_assoc()) {
                    $subtotal = $row['preco'] * $row['quantidade'];
                    $total += $subtotal;
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['nome']) . '</td>';
                    echo '<td><img src="' . htmlspecialchars($row['imagem']) . '" alt="' . htmlspecialchars($row['nome']) . '" style="width: 50px; height: auto;"></td>'; 
                    echo '<td>R$ ' . number_format($row['preco'], 2, ',', '.') . '</td>';
                    echo '<td>' . $row['quantidade'] . '</td>';
                    echo '<td>R$ ' . number_format($subtotal, 2, ',', '.') . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        <div class="total">
            <strong>Total do Pedido: R$ <?php echo number_format($total, 2, ',', '.'); ?></strong>
        </div>
    <?php else: ?>
        <p>Nenhum item encontrado para este pedido.</p>
    <?php endif; ?>
</div>



<?php
$conn->close();
?>

<footer>
    <p>&copy; 2024 Farma Express</p>
</footer>
</body>
</html>