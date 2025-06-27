<?php
include 'db.php';  // Conectar a base de datos

// Procesar venta cuando se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Convertir inputs a números
    $id = intval($_POST['id']);        // ID de la tela
    $metros = floatval($_POST['metros']); // Cantidad a vender

    // Buscar tela en inventario
    $query = $conn->query("SELECT largo FROM telas WHERE id = $id");
    $tela = $query->fetch_assoc();

    // Verificar stock y actualizar
    if ($tela && $tela['largo'] >= $metros) {
        $nuevo_largo = $tela['largo'] - $metros;
        // Guardar nuevo stock
        $conn->query("UPDATE telas SET largo = $nuevo_largo WHERE id = $id");
        $mensaje = "Venta registrada con éxito.";
        $error = false;
    } else {
        $mensaje = "Error: no hay suficiente tela disponible.";
        $error = true;
    }
}

// Cargar telas disponibles
$telas = $conn->query("SELECT * FROM telas WHERE largo > 0");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Venta parcial</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        .main-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .form-container {
            padding: 2rem;
        }

        h2 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2rem;
        }

        .mensaje {
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1.5rem;
            text-align: center;
            font-weight: 500;
        }

        .mensaje.error {
            background-color: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .mensaje:not(.error) {
            background-color: #dcfce7;
            color: #16a34a;
            border: 1px solid #bbf7d0;
        }

        select, input[type="number"] {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 5px;
            margin-bottom: 1rem;
            font-size: 1rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #4a5568;
            font-weight: 500;
        }

        input[type="submit"] {
            width: 100%;
            padding: 0.75rem;
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #2563eb;
        }

        .volver {
            display: inline-block;
            margin-top: 1.5rem;
            color: #4a5568;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .volver:hover {
            color: #1e40af;
        }

        .footer {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 0.875rem;
        }

        .footer span {
            color: #ef4444;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="form-container">
            <h2>Registrar venta parcial</h2>

            <?php if (isset($mensaje)): ?>
                <div class="mensaje <?= $error ? 'error' : '' ?>">
                    <?= htmlspecialchars($mensaje) ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <label for="id">Selecciona tela:</label>
                <select name="id" id="id" required>
                    <?php while ($row = $telas->fetch_assoc()): ?>
                        <option value="<?= $row['id'] ?>">
                            <?= "{$row['tipo']} - {$row['color']} ({$row['largo']} m)" ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <label for="metros">Metros a vender:</label>
                <input type="number" name="metros" step="0.1" id="metros" required>

                <input type="submit" value="Vender">
            </form>

            <a class="volver" href="index.php">← Volver</a>
            <div class="footer">
                Hecho con <span>♥</span> por boogiepop-135
            </div>
        </div>
    </div>
</body>
</html>
