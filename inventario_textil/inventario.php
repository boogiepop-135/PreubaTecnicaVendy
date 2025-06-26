<?php include 'db.php';

$orden = isset($_GET['orden']) ? $_GET['orden'] : 'fecha_ingreso';
$orden = in_array($orden, ['fecha_ingreso', 'largo']) ? $orden : 'fecha_ingreso';

$telas = $conn->query("SELECT * FROM telas ORDER BY $orden DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario actual</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="inventory-container">
        <h2 class="inventory-title">Inventario de Telas</h2>
        
        <div class="order-links">
            <a href="?orden=fecha_ingreso">Ordenar por fecha</a>
            <a href="?orden=largo">Ordenar por stock</a>
        </div>

        <table class="inventory-table">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Color</th>
                    <th>Largo (m)</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $telas->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['tipo']) ?></td>
                        <td><?= htmlspecialchars($row['color']) ?></td>
                        <td><?= htmlspecialchars($row['largo']) ?></td>
                        <td><?= htmlspecialchars($row['fecha_ingreso']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="index.php" class="volver">← Volver al inicio</a>
    </div>
</body>
</html>
