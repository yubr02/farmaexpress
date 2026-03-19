<?php
session_start();
include 'db.php'; 

// Processo de Registro
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $nascimento = $_POST['nascimento'];
    $endereco = $_POST['endereco']; // Novo campo Endereço
    $cep = $_POST['cep']; // Novo campo CEP
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    // Verifica se o e-mail já está registrado
    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<script>alert('E-mail já registrado.');</script>";
    } else {
        // Insere o novo usuário com os novos campos
        $sql = "INSERT INTO usuarios (nome, cpf, telefone, nascimento, endereco, cep, email, senha) 
                VALUES ('$nome', '$cpf', '$telefone', '$nascimento', '$endereco', '$cep', '$email', '$senha')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Registro realizado com sucesso!');</script>";
        } else {
            echo "<script>alert('Erro: " . $sql . "<br>" . $conn->error . "');</script>";
        }
    }
}

// Processo de Login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Busca o usuário pelo e-mail
    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($senha, $user['senha'])) {
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario'] = $user['nome'];
            header("Location: home.php"); 
            exit();
        } else {
            echo "<script>alert('Senha incorreta!');</script>";
        }
    } else {
        echo "<script>alert('Usuário não encontrado!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Página de Cadastro e Login</title>
</head>
<body>

<header>
    <div class="header-content">
        <img src="images/logo.jpeg" alt="Farma Express Logo" class="logo">
        <h1>Farma Express</h1>
        <nav>
            <a href="home.php">Home</a>
            <a href="historico.php">Histórico de Pedidos</a>
            
            <a href="login.php">Entrar</a>
            <a href="cart.php">Carrinho (<?php echo isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : '0'; ?>)</a>
        </nav>
    </div>
</header>

<div class="container">
    <!-- Sessão de Cadastro -->
    <div class="form-section">
        <div class="form-container sign-up">
            <h2>Nova Conta</h2>
            <form action="" method="POST">
                <h3>Dados Pessoais</h3>
                <input type="text" name="nome" placeholder="Nome Completo" required>
                <input type="text" name="cpf" id="cpf" placeholder="CPF" required>
                <input type="text" name="telefone" id="telefone" placeholder="Telefone" required>
                <input type="date" name="nascimento" placeholder="Data de Nascimento" required>
                <input type="text" name="endereco" placeholder="Endereço" required> <!-- Campo Endereço -->
                <input type="text" name="cep" id="cep" placeholder="CEP" required> <!-- Campo CEP -->
                <h3>Dados de Acesso</h3>
                <input type="email" name="email" placeholder="E-mail" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <input type="password" name="confirmar_senha" placeholder="Confirmar Senha" required>
                <button type="submit" name="register">Criar Conta</button>
            </form>
        </div>
    </div>

    <!-- Sessão de Login -->
    <div class="form-section">
        <div class="form-container sign-in">
            <h2>Já sou cliente</h2>
            <form action="" method="POST">
                <input type="email" name="email" placeholder="E-mail ou CPF" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <button type="submit" name="login">Entrar</button>
            </form>
            <a href="#">Esqueceu sua senha?</a>
        </div>
    </div>
</div>

<!-- Script para aplicar as máscaras -->
<script>
    $(document).ready(function(){
        $('#cpf').mask('000.000.000-00');
        $('#telefone').mask('(00) 00000-0000');
        $('#cep').mask('00000-000'); // Máscara para o CEP
    });
</script>
</body>

<footer>
    <p>&copy; 2024 Farma Express</p>
</footer>

</body>
</html>
