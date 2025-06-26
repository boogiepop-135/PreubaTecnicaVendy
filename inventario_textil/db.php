<?php
$host = getenv("DB_HOST") ?: "localhost";
$user = getenv("DB_USER") ?: "root";
$pass = getenv("DB_PASS") ?: "";  // Sin contraseña por defecto para desarrollo local
$db   = getenv("DB_NAME") ?: "inventario_textil";

try {
    $conn = new mysqli($host, $user, $pass);
    
    if ($conn->connect_error) {
        throw new Exception($conn->connect_error);
    }
    
    // Crear y seleccionar base de datos
    $conn->query("CREATE DATABASE IF NOT EXISTS $db");
    $conn->select_db($db);
    
} catch (Exception $e) {
    die("Error de conexión: " . $e->getMessage() . "<br><br>
        Configuración actual:<br>
        - Host: $host<br>
        - Usuario: $user<br>
        - BD: $db<br><br>
        Para desarrollo local:<br>
        1. Verifica que MySQL esté activo<br>
        2. Usuario root sin contraseña<br><br>
        Para Docker:<br>
        1. Ejecuta: docker-compose up -d<br>
        2. Espera 30 segundos");
}
?>
