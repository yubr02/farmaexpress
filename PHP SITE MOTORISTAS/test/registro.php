<?php
// Configurações de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farmaexpress";

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Verificando se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $data_nascimento = $_POST['data_nascimento'];
    $email = $_POST['email'];
    $cnh = $_POST['cnh'];

    // Preparando a instrução SQL
    $sql = "INSERT INTO entregadores (nome, cpf, rg, data_nascimento, email, cnh) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $nome, $cpf, $rg, $data_nascimento, $email, $cnh);

    // Executando a instrução
    if ($stmt->execute()) {
        $message = "Registro concluído";
    } else {
        $message = "Erro ao registrar: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farma Express - Registro de Entregador</title>
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

        input[type="text"],
        input[type="email"],
        input[type="date"] {
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

        .register-button {
            background-color: #132666;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            width: 100%; /* Largura total do botão */
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .register-button:hover {
            background-color: #0e1a4b; /* Escurece um pouco o botão ao passar o mouse */
        }

        .message {
            margin-top: 10px;
            color: green; /* Cor da mensagem */
            font-weight: bold;
        }

        /* Estilo para a picture box */
        .picture-box {
            width: 150px; /* Largura da picture box */
            height: 200px; /* Altura da picture box */
            background-image: url('C:/Users/muril/Downloads/png-clipart-computer-icons-icon-design-material-design-user-avatar-add-icon-rectangle-logo-removebg-preview.png'); /* Imagem de fundo */
            background-size: 70%; /* Ajusta a imagem para 70% do tamanho da picture box */
            background-repeat: no-repeat; /* Não repete a imagem */
            background-position: center; /* Centraliza a imagem */
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Incluindo jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#cnh').mask('000.00000.00'); 
            $('#cpf').mask('000.000.000-00');
            $('#rg') .mask('00.000.000-00')
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
            <a href="index.php"><button>Início</button></a>
            <a href="sobre.php"><button>Sobre</button></a>
            <a href="login.php"><button>ja sou um motorista</button></a>
            <a href="contato.php"><button>Contato</button></a>
        </div>
    </div>

    <div class="form-container">
        <div class="container">
            <h1>Registro de Entregador</h1>
            <form method="POST" action="">
                <input type="text" name="nome" placeholder="Nome" maxlength="50" required>
                <input type="text" name="cpf" id="cpf" placeholder="CPF" maxlength="14" required>
                <input type="text" name="rg" id="rg"placeholder="RG" maxlength="14" required>
                <input type="date" name="data_nascimento" required>
                <input type="email" name="email" placeholder="Email" maxlength="50" required>
                <input type="text" name="cnh" id="cnh" placeholder="CNH" id="cnh" maxlength="14" required oninput="applyCNHMask(this)">
                <div class="button-group">
                    <button type="submit" class="register-button">Registrar</button>
                </div>
            </form>
            <div id="registrationMessage" class="message"><?php echo isset($message) ? $message : ''; ?></div>
        </div>
    </div>
</body>
</html>
