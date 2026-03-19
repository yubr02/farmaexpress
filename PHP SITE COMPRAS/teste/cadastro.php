<?php
session_start();
include 'db.php'; 

// Processo de Registro
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $nascimento = $_POST['nascimento'];

    // Verifica se as senhas coincidem
    if ($senha !== $confirmar_senha) {
        echo "<script>alert('As senhas não coincidem!');</script>";
    } else {
        // Verifica se o e-mail já está registrado
        $sql = "SELECT * FROM usuarios WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<script>alert('E-mail já registrado.');</script>";
        } else {
            // Criptografa a senha
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

            // Insere os dados no banco
            $sql = "INSERT INTO usuarios (nome, email, senha, cpf, telefone, nascimento) 
                    VALUES ('$nome', '$email', '$senha_hash', '$cpf', '$telefone', '$nascimento')";
            
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Cadastro realizado com sucesso!');</script>";
                header("Location: login.php"); // Redireciona para a página de login
            } else {
                echo "<script>alert('Erro: " . $sql . "<br>" . $conn->error . "');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Página de Cadastro</title>
</head>
<body>
    <div class="container">
        <!-- Formulário de Cadastro -->
        <div class="form-container sign-up">
            <h2>Criar Nova Conta</h2>
            <form action="" method="POST">
                <h3>Dados Pessoais</h3>
                <input type="text" name="nome" placeholder="Nome Completo" required>
                <input type="text" name="cpf" placeholder="CPF" required>
                <input type="text" name="telefone" placeholder="Telefone" required>
                <input type="date" name="nascimento" placeholder="Data de Nascimento" required>
                <h3>Dados de Acesso</h3>
                <input type="email" name="email" placeholder="E-mail" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <input type="password" name="confirmar_senha" placeholder="Confirmar Senha" required>
                <button type="submit" name="register">Criar Conta</button>
            </form>
        </div>
    </div>
</body>
</html>
