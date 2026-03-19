<?php
session_start();
include 'db.php';

// Redireciona para o login se o usuário não estiver autenticado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Verifica se o formulário foi enviado
if (isset($_POST['finalizar'])) {
    // Obtém dados do pedido
    $forma_pagamento = $_POST['forma_pagamento'];
    $total = 0;
    $carrinho = [];

    // Busca os produtos no carrinho
    $query = "SELECT c.quantidade, p.preco, p.id AS produto_id 
              FROM carrinho c 
              JOIN produtos p ON c.produto_id = p.id 
              WHERE c.usuario_id = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se há itens no carrinho
    if ($result->num_rows > 0) {
        // Calcula o total e armazena os itens do carrinho
        while ($row = $result->fetch_assoc()) {
            $quantidade = $row['quantidade'];
            $preco = $row['preco'];
            $subtotal = $quantidade * $preco;
            $total += $subtotal;
            $carrinho[] = $row; // Armazena os itens do carrinho
        }

        // Busca o endereço do usuário
        $query = "SELECT endereco FROM usuarios WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $endereco = null; // Inicializa o endereço
        if ($row = $result->fetch_assoc()) {
            $endereco = $row['endereco']; // Obtém o endereço do usuário
        }

        // Insere o pedido
        $stmt = $conn->prepare("INSERT INTO pedidos (usuario_id, data_pedido, total, status, forma_pagamento, endereco) 
                                VALUES (?, NOW(), ?, 'A entregar', ?, ?)");
        $stmt->bind_param("idss", $usuario_id, $total, $forma_pagamento, $endereco);
        $stmt->execute();
        $pedido_id = $stmt->insert_id; // Obtém o ID do pedido inserido

        // Insere os detalhes do pedido
        $stmt = $conn->prepare("INSERT INTO detalhes_pedido (pedido_id, produto_id, quantidade) VALUES (?, ?, ?)");
        foreach ($carrinho as $item) {
            $stmt->bind_param("iii", $pedido_id, $item['produto_id'], $item['quantidade']);
            $stmt->execute();
        }

        // Limpa o carrinho
        $stmt = $conn->prepare("DELETE FROM carrinho WHERE usuario_id = ?");
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();

        // Redireciona para uma página de confirmação ou histórico de pedidos
        header("Location: historico.php");
        exit();
    } else {
        echo "<script>alert('Erro: Seu carrinho está vazio.');</script>";
    }
} else {
    echo "<script>alert('Erro: Finalização não realizada.');</script>";
}

$conn->close();
?>
