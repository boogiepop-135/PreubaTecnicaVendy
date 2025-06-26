<?php
$host = '127.0.0.1';
$user = 'root';
$pass = '';

try {
    // Primero intentar conectar sin base de datos
    $conn = new mysqli($host, $user, $pass);
    
    if ($conn->connect_error) {
        throw new Exception($conn->connect_error);
    }
    
    echo "✅ Conexión a MySQL exitosa<br>";
    
    // Intentar crear la base de datos
    if ($conn->query("CREATE DATABASE IF NOT EXISTS inventario_textil")) {
        echo "✅ Base de datos inventario_textil verificada<br>";
    }
    
    // Seleccionar la base de datos
    $conn->select_db("inventario_textil");
    
    // Verificar tabla telas
    $result = $conn->query("SHOW TABLES LIKE 'telas'");
    if ($result->num_rows == 0) {
        echo "⚠️ La tabla 'telas' no existe. Ejecuta el archivo sql/esquema.sql<br>";
    } else {
        echo "✅ Tabla 'telas' existe<br>";
    }
    
} catch (Exception $e) {
    die("❌ Error de conexión: " . $e->getMessage());
}
?>
