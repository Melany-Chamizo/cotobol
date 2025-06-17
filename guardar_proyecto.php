<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Subir imagen
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["imagen"]["name"]);
move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file);

// Guardar en base de datos
$conn = new PDO("mysql:host=localhost;dbname=topografos_db", "usuario_db", "contraseña_segura");
$stmt = $conn->prepare("INSERT INTO proyectos (titulo, descripcion, tecnologias, imagen, user_id) VALUES (?, ?, ?, ?, ?)");
$stmt->execute([
    $_POST['titulo'],
    $_POST['descripcion'],
    $_POST['tecnologias'],
    $target_file,
    $_SESSION['user_id']
]);

header("Location: panel.php?success=1");
?>