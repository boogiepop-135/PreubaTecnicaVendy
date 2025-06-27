<?php
include 'db.php';  // Base de datos

// Procesar nuevo ingreso
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Datos del formulario
    $tipo = $_POST['tipo'];   // Nombre/tipo de tela
    $color = $_POST['color']; // Color
    $largo = floatval($_POST['largo']); // Metros
    $fecha = $_POST['fecha']; // Fecha ingreso

    // Insertar usando prepared statement
    $stmt = $conn->prepare("INSERT INTO telas (tipo, color, largo, fecha_ingreso) VALUES (?, ?, ?, ?)");
    // s=string, d=decimal
    $stmt->bind_param("ssds", $tipo, $color, $largo, $fecha);
    $stmt->execute();
    
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agregar Tela</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="form-container">
    <h2>Agregar nuevo rollo</h2>
    <form method="POST">
      <label>Tipo de tela:</label>
      <input type="text" name="tipo" required>

      <label>Color:</label>
      <input type="text" name="color" required>

      <label>Largo (m):</label>
      <input type="number" name="largo" step="0.1" required>

      <label>Fecha de ingreso:</label>
      <input type="date" name="fecha" required>

      <input type="submit" value="Guardar">
    </form>
    <a class="volver" href="index.php">← Volver</a>
  </div>
</body>
</html>
