<?php include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo'];
    $color = $_POST['color'];
    $largo = floatval($_POST['largo']);
    $fecha = $_POST['fecha'];

    $stmt = $conn->prepare("INSERT INTO telas (tipo, color, largo, fecha_ingreso) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $tipo, $color, $largo, $fecha);
    $stmt->execute();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Agregar tela</title></head>
<body>
<h2>Agregar nuevo rollo</h2>
<form method="POST">
  Tipo de tela: <input type="text" name="tipo" required><br>
  Color: <input type="text" name="color" required><br>
  Largo (m): <input type="number" name="largo" step="0.1" required><br>
  Fecha de ingreso: <input type="date" name="fecha" required><br>
  <input type="submit" value="Guardar">
</form>
<a href="index.php">Volver</a>
</body>
</html>
