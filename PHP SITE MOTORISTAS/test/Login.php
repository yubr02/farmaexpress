<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farmaexpress";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Variável para mensagem de resultado do login
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $cnh = $_POST['cnh'];

    // Consulta SQL para verificar o email e a CNH
    $sql = "SELECT * FROM entregadores WHERE email = '$email' AND cnh = '$cnh'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Acesso bem-sucedido, redireciona para a página de pedidos
        header('Location: pedidos.php');
        exit(); // Importante para garantir que o script não continue
    } else {
        $message = "Email ou CNH incorretos";
    }
}

// Fecha a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farma Express - Login do Entregador</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #132666;
            padding: 20px;
        }

        .logo-secondary {
            max-width: 100px; /* Ajuste conforme necessário */
        }

        .back-button {
            background-color: #132666;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
            color: white;
        }

        .back-button:hover {
            background-color: #132666;
        }

        .header-buttons a {
            margin-left: 10px;
        }

        .header-buttons button {
            background-color: #132666;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
            color: white;
        }

        .header-buttons button:hover {
            background-color: #132666;
        }

        .form-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 80vh; /* Ajusta a altura do contêiner */
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px; /* Largura do formulário */
            text-align: center;
        }

        .container h1 {
            margin-bottom: 20px;
            color: #132666;
        }

        input[type="email"],
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .button-group {
            margin-top: 10px;
        }

        .access-button {
            background-color: #132666;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            width: 100%; /* Largura total do botão */
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .access-button:hover {
            background-color: #0e1a4b; /* Escurece um pouco o botão ao passar o mouse */
        }

        .message {
            margin-top: 10px;
            color: red; /* Cor da mensagem de erro */
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Incluindo jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#cnh').mask('000.00000.00'); 
        });

        function applyCNHMask(input) {
            // Adiciona máscara se necessário
            $(input).mask('000.00000.00');
        }
    </script>
</head>
<body>
    <div class="header-container">
        <img src="images/logo.jpeg" alt="Logo" class="logo-secondary">
        <button class="back-button" onclick="history.back()">Voltar</button>
        <div class="header-buttons">
            <a href="sobre.php"><button>Sobre</button></a>
            <a href="registro.php"><button>Se torne um motorista</button></a>
            <a href="contato.php"><button>Contato</button></a>
        </div>
    </div>

    <div class="form-container">
        <div class="container">
            <h1>Acesso de Entregador</h1>
            <form method="POST" action="">
                <input type="email" name="email" placeholder="Email" maxlength="50" required>
                <input type="text" name="cnh" placeholder="CNH" id="cnh" maxlength="14" required>
                <div class="button-group">
                    <button type="submit" class="access-button">Acessar</button>
                </div>
            </form>
            <div id="registrationMessage" class="message"><?php echo $message; ?></div>
        </div>
    </div>
</body>
</html>
