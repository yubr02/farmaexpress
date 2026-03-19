<?php
$servername = "localhost"; // ou o endereço do seu servidor
$username = "root"; // seu usuário do MySQL
$password = ""; // sua senha do MySQL
$dbname = "farmaexpress"; // nome do seu banco de dados

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificar se o ID do pedido foi passado
if (isset($_GET['pedido_id'])) {
    $pedido_id = intval($_GET['pedido_id']); // Garantir que seja um número inteiro

    // Atualizar o status do pedido para "Entregue"
    $sql = "UPDATE pedidos SET status = 'Entregue' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $pedido_id);

    if ($stmt->execute()) {
        // Redirecionar para a página de pedidos após a confirmação
        header("Location: pedidos.php?status=sucesso");
        exit();
    } else {
        echo "Erro ao confirmar a entrega: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID do pedido não especificado.";
}

$conn->close();
?>
