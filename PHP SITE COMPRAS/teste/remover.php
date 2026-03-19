<?php
session_start();
include 'db.php'; 

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove'])) {
    $produto_id = $_POST['produto_id'];
    $query = "DELETE FROM carrinho WHERE usuario_id = ? AND produto_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $usuario_id, $produto_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $_SESSION['message'] = "Produto removido do carrinho com sucesso.";
    } else {
        $_SESSION['message'] = "Erro ao remover o produto do carrinho.";
    }
}

header("Location: cart.php");
exit();
?>
