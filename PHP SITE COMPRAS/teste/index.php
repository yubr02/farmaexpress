<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="quemsomos.css">
    <title>Farma Express - Quem Somos</title>
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

<main>
    <section id="about-us">
        <div class="container">
            <h2>Quem Somos</h2>
            <div class="about-content">
                <p>
                    Bem-vindo à <strong>Farma Express</strong>, sua farmácia online de confiança. Nosso objetivo é oferecer um serviço de entrega rápida e acessível, garantindo que seus medicamentos e produtos de saúde cheguem até você com praticidade e segurança.
                </p>
                <p>
                    Com uma vasta experiência no setor farmacêutico, trabalhamos todos os dias para garantir a melhor qualidade e o melhor atendimento aos nossos clientes. Acreditamos que a saúde não pode esperar, por isso, investimos constantemente em tecnologia para tornar o processo de compra mais ágil e eficiente.
                </p>
                <p>
                    Nossa equipe é formada por profissionais qualificados, prontos para atendê-lo da melhor forma possível. Se você tiver dúvidas, nosso serviço de atendimento ao cliente está à disposição para ajudá-lo.
                </p>
                <p>
                    Obrigado por confiar na Farma Express. Estamos aqui para cuidar de você e da sua família.
                </p>
            </div>

            <div class="team">
                <h3>Nossa Equipe</h3>
                <div class="team-members">
                    <div class="team-member">
                        <img src="images/team1.jpg" alt="Membro da equipe 1">
                        <h4>João Silva</h4>
                        <p>CEO & Fundador</p>
                    </div>
                    <div class="team-member">
                        <img src="images/team2.jpg" alt="Membro da equipe 2">
                        <h4>Maria Souza</h4>
                        <p>Farmacêutica Chefe</p>
                    </div>
                    <div class="team-member">
                        <img src="images/team3.jpg" alt="Membro da equipe 3">
                        <h4>Carlos Pereira</h4>
                        <p>Diretor de Logística</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<footer>
    <p>&copy; 2024 Farma Express</p>
</footer>

</body>
</html>
