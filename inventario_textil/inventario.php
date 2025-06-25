<?php include 'db.php';

$orden = isset($_GET['orden']) ? $_GET['orden'] : 'fecha_ingreso';
$orden = in_array($orden, ['fecha_ingreso', 'largo']) ? $orden : 'fecha_ingreso';

$telas = $conn->query("SELECT * FROM telas ORDER BY $orden DESC");
?>

<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Inventario actual</title></head>
<body>
<h2>Inventario</h2>
<a href="?orden=fecha_ingreso">Ordenar por fecha</a> | 
<a href="?orden=largo">Ordenar por stock</a><br><br>

<table border="1">
  <tr><th>Tipo</th><th>Color</th><th>Largo (m)</th><th>Fecha</th></tr>
  <?php while($row = $telas->fetch_assoc()): ?>
    <tr>
      <td><?= $row['tipo'] ?></td>
      <td><?= $row['color'] ?></td>
      <td><?= $row['largo'] ?></td>
      <td><?= $row['fecha_ingreso'] ?></td>
    </tr>
  <?php endwhile; ?>
</table>
<a href="index.php">Volver</a>
</body>
</html>
