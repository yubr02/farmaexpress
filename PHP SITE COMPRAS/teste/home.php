<?php
session_start();
include 'db.php'; 

// Inicializa a variável de pesquisa
$search_query = '';

// Verifica se há uma consulta de pesquisa
if (isset($_POST['search'])) {
    $search_query = $_POST['search'];
    $sql = "SELECT * FROM produtos WHERE nome LIKE '%$search_query%' OR descricao LIKE '%$search_query%'";
} else {
    $sql = "SELECT * FROM produtos";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="home.css">
    <title>Farma Express - Produtos em Destaque</title>
</head>
<body>

<header>
    <div class="header-content">
        <img src="images/logo.jpeg" alt="Farma Express Logo" class="logo">
        <h1>Farma Express</h1>
        <form class="search-form" action="" method="POST">
            <input type="text" name="search" placeholder="O que está buscando hoje?" value="<?php echo htmlspecialchars($search_query); ?>">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
        <nav>
            <a href="index.php">Quem Somos</a>
            <a href="historico.php">Histórico de Pedidos</a>
            

            <!-- Verifica se o usuário está logado -->
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="logout.php">Sair</a>
            <?php else: ?>
                <a href="login.php">Entrar</a>
            <?php endif; ?>
            
            <a href="cart.php">Carrinho (<?php echo isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : '0'; ?>)</a>
        </nav>
    </div>
</header>


<div class="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="images/1.png" alt="Imagem 1">
        </div>
        <div class="carousel-item">
            <img src="images/2.png" alt="Imagem 2">
        </div>
        <div class="carousel-item">
            <img src="images/3.png" alt="Imagem 3">
        </div>
        <div class="carousel-item">
            <img src="images/4.png" alt="Imagem 4">
        </div>
    </div>
    <a class="carousel-prev" href="#" onclick="prevSlide()">&#10094;</a>
    <a class="carousel-next" href="#" onclick="nextSlide()">&#10095;</a>
</div>

<!-- Formulário de Pesquisa abaixo do Carrossel -->


<script>
// Funções do carrossel
let currentSlide = 0;
const items = document.querySelectorAll('.carousel-item');
const intervalTime = 2000; 
let autoSlideInterval;

function showSlide(index) {
    items.forEach(item => item.classList.remove('active'));
    items[index].classList.add('active');
}

function nextSlide() {
    currentSlide = (currentSlide + 1) % items.length;
    showSlide(currentSlide);
}

function prevSlide() {
    currentSlide = (currentSlide - 1 + items.length) % items.length;
    showSlide(currentSlide);
}

function startCarousel() {
    autoSlideInterval = setInterval(nextSlide, intervalTime);
}

function pauseCarousel() {
    clearInterval(autoSlideInterval);
}

function resumeCarousel() {
    startCarousel();
}

document.querySelector('.carousel').addEventListener('mouseover', pauseCarousel);
document.querySelector('.carousel').addEventListener('mouseout', resumeCarousel);

window.onload = startCarousel;
</script>

<?php if (isset($_SESSION['message'])): ?>
    <div class="alert">
        <?php 
        echo $_SESSION['message']; 
        unset($_SESSION['message']); // Limpa a mensagem após exibição
        ?>
    </div>
<?php endif; ?>

<?php
if ($result->num_rows > 0) {
    ?>
    <section id="produtos">
        <div class="container">
            <h2>Produtos em Destaque</h2>
            <div class="product-list">
                <?php
                while ($produto = $result->fetch_assoc()) {
                    ?>
                    <div class="product">
                        <img src="<?php echo $produto['imagem']; ?>" alt="<?php echo $produto['nome']; ?>">
                        <h3><?php echo $produto['nome']; ?></h3>
                        <p><?php echo $produto['descricao']; ?></p>
                        <h3><?php echo 'R$ ' . number_format($produto['preco'], 2, ',', '.'); ?></h3>
                        <form action="add_to_cart.php" method="post" class="add-to-cart-form">
                            <input type="hidden" name="item_id" value="<?php echo $produto['id']; ?>">
                            <div class="quantity-select">
                                <label for="quantity-<?php echo $produto['id']; ?>">Quantidade:</label>
                                <select id="quantity-<?php echo $produto['id']; ?>" name="quantity">
                                    <?php for ($i = 1; $i <= 10; $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <button type="submit">Adicionar ao carrinho</button>
                        </form>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>
    <?php
} else {
    ?>
    <h2>Nenhum produto disponível</h2>
    <p>Não há produtos disponíveis no momento.</p>
    <?php
}

$conn->close();
?>

<footer>
    <p>&copy; 2024 Farma Express</p>
</footer>

</body>
</html>