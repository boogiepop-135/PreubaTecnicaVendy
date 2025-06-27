<?php
// Obtener variables de conexión, si no están en el entorno usar valores por defecto
// getenv() busca variables de entorno, el operador ?: es como un if else más corto
$host = getenv("DB_HOST") ?: "localhost";  // Para Docker usa 'db', para local 'localhost'
$user = getenv("DB_USER") ?: "root";       // Usuario por defecto de MySQL
$pass = getenv("DB_PASS") ?: "";           // En local normalmente no tiene password
$db   = getenv("DB_NAME") ?: "inventario_textil";

try {
    // Crear conexión a MySQL (me costó entender que primero conecto sin base de datos)
    $conn = new mysqli($host, $user, $pass);
    
    if ($conn->connect_error) {
        throw new Exception($conn->connect_error);
    }
    
    // Esto es genial: si no existe la base de datos, la crea
    // Si existe, simplemente la selecciona y sigue
    $conn->query("CREATE DATABASE IF NOT EXISTS $db");
    $conn->select_db($db);
    
} catch (Exception $e) {
    // Este mensaje de error es muy útil, me ayudó mucho durante desarrollo
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
