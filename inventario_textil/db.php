<?php
$host = 'localhost';
$user = 'root';
$pass = 'root'; // o vacío '' si no tienes contraseña
$db = 'inventario_textil';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
