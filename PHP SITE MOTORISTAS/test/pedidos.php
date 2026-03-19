<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos para Entrega</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #132666;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        a {
            color: #4CAF50;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .no-pedidos {
            text-align: center;
            margin-top: 20px;
            font-size: 1.2em;
            color: #666;
        }

        .confirmar-btn {
            background-color: #132666;
            color: white;
            border: none;
            padding: 10px 15px;
            text-decoration: none;
            cursor: pointer;
            display: inline-block; /* Mantém o botão na mesma linha se necessário */
            margin-bottom: 5px; /* Espaço entre os botões */
        }

        .confirmar-btn:hover {
            background-color: #132666;
        }

        .acao {
            display: flex; /* Utiliza flexbox para alinhar os itens */
            flex-direction: column; /* Coloca os itens em coluna */
        }

        .header-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #132666; /* Cor de fundo do cabeçalho */
    padding: 10px 20px; /* Espaçamento interno */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Sombra para dar profundidade */
}

.header-buttons {
    display: flex; /* Usando flexbox para alinhar os botões */
    gap: 10px; /* Espaço entre os botões */
}

.header-buttons button {
    background-color: #4CAF50; /* Cor de fundo dos botões */
    color: white; /* Cor do texto dos botões */
    border: none; /* Remove bordas padrão dos botões */
    padding: 10px 15px; /* Espaçamento interno dos botões */
    cursor: pointer; /* Cursor de ponteiro ao passar sobre o botão */
    border-radius: 5px; /* Bordas arredondadas */
    transition: background-color 0.3s; /* Efeito de transição ao passar o mouse */
}

.header-buttons button:hover {
    background-color: #45a049; /* Cor ao passar o mouse sobre os botões */
}

.logo-secondary {
            max-width: 100px; /* Ajuste conforme necessário */
        }
    </style>
</head>
<body>
<div class="header-container">
    <img src="images/logo.jpeg" alt="Logo" class="logo-secondary">
    <div class="header-buttons">
        <a href="sobre.php"><button>Sobre</button></a>
        <a href="login.php"><button>Sair</button></a>
        <a href="contato.php"><button>Contato</button></a>
    </div>
</div>



<h1>Pedidos para Entrega</h1>

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

// Consultar pedidos a serem entregues com detalhes do produto e cliente
$sql = "SELECT p.id, u.nome AS cliente, dp.produto_id, dp.quantidade, p.data_pedido, p.status, p.endereco
        FROM pedidos p
        JOIN usuarios u ON p.usuario_id = u.id
        JOIN detalhes_pedido dp ON p.id = dp.pedido_id
        WHERE p.status = 'A entregar'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Exibir dados em uma tabela
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Data</th>
                <th>Status</th>
                <th>Endereço</th>
                <th>Ação</th>
            </tr>";

    // Saída de dados de cada linha
    while ($row = $result->fetch_assoc()) {
        $endereco = urlencode($row["endereco"]); // Certifique-se de que o campo `endereco` existe na tabela
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . (isset($row["cliente"]) ? $row["cliente"] : 'N/A') . "</td>
                <td>" . (isset($row["produto_id"]) ? $row["produto_id"] : 'N/A') . "</td>
                <td>" . (isset($row["quantidade"]) ? $row["quantidade"] : 'N/A') . "</td>
                <td>" . $row["data_pedido"] . "</td>
                <td>" . $row["status"] . "</td>
                <td>" . $row["endereco"] . "</td>
                <td class='acao'>
                    <a class='confirmar-btn' href='confirmar_entrega.php?pedido_id=" . $row["id"] . "'>Confirmar Entrega</a>
                    <a href='https://www.google.com/maps/search/?api=1&query=$endereco' target='_blank'>Ver no Google Maps</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<div class='no-pedidos'>Nenhum pedido para entrega.</div>";
}
$conn->close();
?>

</body>
</html>


