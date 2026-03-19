<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre - Farma Express</title>
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

        .sobre-conteudo {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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
        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #132666;
            padding: 10px 20px;
        }

        button:hover {
            background-color: #0f1a3c; /* Cor ao passar o mouse */
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
        <a href="login.php"><button>Sair</button></a>
        <a href="contato.php"><button>Contato</button></a>
    </div>
</div>

<h1>Sobre a Farma Express</h1>

<div class="sobre-conteudo">
    <p>A Farma Express é uma farmácia online dedicada a oferecer a melhor experiência de compra de medicamentos e produtos de saúde. Com um compromisso com a qualidade e o atendimento ao cliente, nossa missão é garantir que nossos clientes tenham acesso rápido e fácil a produtos essenciais.</p>

    <p>Oferecemos uma ampla gama de produtos, incluindo medicamentos, produtos de higiene pessoal, suplementos e muito mais. Nossa equipe é formada por profissionais qualificados, prontos para ajudar e garantir que você tenha a melhor experiência possível.</p>

    <p>Estamos localizados em [insira o endereço], e atendemos a todo o Brasil com entregas rápidas e seguras. Agradecemos por escolher a Farma Express como sua farmácia de confiança!</p>
</div>

</body>
</html>
