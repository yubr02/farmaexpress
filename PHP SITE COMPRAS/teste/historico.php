<?php
session_start();
include 'db.php'; 

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Prepara e executa a consulta para buscar os pedidos do usuário
$query = "SELECT id, data_pedido, total, status, forma_pagamento FROM pedidos WHERE usuario_id = ? ORDER BY data_pedido DESC";
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
    <title>Histórico de Pedidos</title>
    <link rel="stylesheet" href="historico.css">
</head>
<body>

<header>
    <h1>Histórico de Pedidos</h1>
    <nav>
            <a href="home.php">Home</a>
            <a href="historico.php">Histórico de Pedidos</a>
            
            <a href="login.php">Entrar</a>
            <a href="cart.php">Carrinho (<?php echo isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : '0'; ?>)</a>
        </nav>
</header>

<div class="container">
    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Data do Pedido</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Forma de Pagamento</th>
                    <th>Detalhes</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($pedido = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo date('d/m/Y H:i', strtotime($pedido['data_pedido'])); ?></td>
                        <td>R$ <?php echo number_format($pedido['total'], 2, ',', '.'); ?></td>
                        <td><?php echo htmlspecialchars($pedido['status']); ?></td>
                        <td><?php echo htmlspecialchars($pedido['forma_pagamento']); ?></td>
                        <td><a href="detalhes_pedido.php?pedido_id=<?php echo $pedido['id']; ?>">Ver Detalhes</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum pedido encontrado.</p>
    <?php endif; ?>
</div>

</body>
</html>

<?php
$conn->close();
?>
