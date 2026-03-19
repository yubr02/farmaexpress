<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farmaexpress";

$conn = new mysqli($servername, $username, $password, $dbname);

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$sql = "SELECT * FROM notificacoes WHERE usuario_id = '$usuario_id' AND lida = 0 ORDER BY data_notificacao DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificações</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Notificações</h2>
    <ul>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<li>" . $row['mensagem'] . " - " . $row['data_notificacao'] . "</li>";
                
                $sql = "UPDATE notificacoes SET lida = 1 WHERE id = " . $row['id'];
                $conn->query($sql);
            }
        } else {
            echo "<li>Sem notificações</li>";
        }
        ?>
    </ul>
</body>
</html>

<?php
$conn->close();
?>
