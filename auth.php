<?php
session_start();
$host = "localhost";
$dbname = "topografos_db";
$username = "root";
$password = "";

// Conexión a la base de datos
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
    
}

// Validar credenciales
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, nombre, password FROM colegiados WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nombre'];
        header("Location: panel.php");
        exit();
    } else {
        echo "<script>alert('Credenciales incorrectas'); window.location.href='panel.php';</script>"; //me esto arreglar
    }
}
?>