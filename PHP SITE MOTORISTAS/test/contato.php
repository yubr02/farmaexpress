<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato - Farma Express</title>
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

        form {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background-color: #132666;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
            width: 100%;
        }

        button:hover {
            background-color: #0f1a3c; /* Cor ao passar o mouse */
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #132666;
            padding: 10px 20px;
        }

        .header-buttons {
            display: flex;
            gap: 10px;
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
        <a href="pedidos.php"><button>Pedidos</button></a>
        <a href="sobre.php"><button>Sobre</button></a>
        <a href="login.php"><button>Sair</button></a>
    </div>
</div>

<h1>Contato</h1>

<form action="enviar_contato.php" method="POST">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required>

    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email" required>

    <label for="mensagem">Mensagem:</label>
    <textarea id="mensagem" name="mensagem" rows="5" required></textarea>

    <button type="submit">Enviar Mensagem</button>
</form>

</body>
</html>
