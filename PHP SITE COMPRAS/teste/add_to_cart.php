<?php
session_start();
include 'db.php';

$response = ['status' => '', 'message' => ''];

if (isset($_POST['item_id']) && isset($_POST['quantity'])) {
    $produto_id = $_POST['item_id'];
    $quantidade = $_POST['quantity'];

    if ($quantidade > 0) {
        // Verifica se o produto existe
        $stmt = $conn->prepare("SELECT * FROM produtos WHERE id = ?");
        $stmt->bind_param("i", $produto_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $usuario_id = $_SESSION['usuario_id'];

            // Adiciona o produto ao carrinho
            $stmt = $conn->prepare("INSERT INTO carrinho (usuario_id, produto_id, quantidade) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $usuario_id, $produto_id, $quantidade);

            if ($stmt->execute()) {
                // Consulta a quantidade total de itens no carrinho
                $stmt = $conn->prepare("SELECT SUM(quantidade) as total FROM carrinho WHERE usuario_id = ?");
                $stmt->bind_param("i", $usuario_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $totalItems = $result->fetch_assoc()['total'];

                // Atualiza a sessão com a quantidade total de itens
                $_SESSION['cart_count'] = $totalItems;
                $_SESSION['message'] = "Produto adicionado ao carrinho com sucesso!";
                header("Location: home.php");
                exit;
            } else {
                $_SESSION['message'] = "Erro ao adicionar produto ao carrinho: " . $stmt->error;
                header("Location: home.php");
                exit;
            }
        } else {
            $_SESSION['message'] = "Produto não encontrado.";
            header("Location: home.php");
            exit;
        }
    } else {
        $_SESSION['message'] = "Quantidade inválida.";
        header("Location: home.php");
        exit;
    }
} else {
    $_SESSION['message'] = "Dados inválidos enviados.";
    header("Location: home.php");
    exit;
}

$conn->close();
