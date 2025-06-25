<?php include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $metros = floatval($_POST['metros']);

    $query = $conn->query("SELECT largo FROM telas WHERE id = $id");
    $tela = $query->fetch_assoc();

    if ($tela && $tela['largo'] >= $metros) {
        $nuevo_largo = $tela['largo'] - $metros;
        $conn->query("UPDATE telas SET largo = $nuevo_largo WHERE id = $id");
        $mensaje = "Venta registrada con éxito.";
    } else {
        $mensaje = "Error: no hay suficiente tela disponible.";
    }
}
$telas = $conn->query("SELECT * FROM telas WHERE largo > 0");
?>

<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Venta parcial</title></head>
<body>
<h2>Registrar venta parcial</h2>
<?php if (isset($mensaje)) echo "<p>$mensaje</p>"; ?>
<form method="POST">
  <label>Selecciona tela:</label>
  <select name="id" required>
    <?php while($row = $telas->fetch_assoc()): ?>
      <option value="<?= $row['id'] ?>">
        <?= "{$row['tipo']} - {$row['color']} ({$row['largo']} m)" ?>
      </option>
    <?php endwhile; ?>
  </select><br>
  Metros a vender: <input type="number" name="metros" step="0.1" required><br>
  <input type="submit" value="Vender">
</form>
<a href="index.php">Volver</a>
</body>
</html>
