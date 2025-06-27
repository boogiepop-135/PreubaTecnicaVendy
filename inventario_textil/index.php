<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario Textil</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        .dashboard {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2.5rem;
        }

        .actions {
            margin-bottom: 2rem;
            text-align: center;
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            min-width: 150px;
            text-align: center;
        }

        .btn-primary {
            background-color: #3b82f6;
            color: white;
        }

        .btn-secondary {
            background-color: #10b981;
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        th {
            background-color: #f8fafc;
            font-weight: 600;
            color: #475569;
        }

        tr:hover {
            background-color: #f1f5f9;
        }

        .empty-message {
            text-align: center;
            padding: 2rem;
            color: #64748b;
            font-style: italic;
        }

        .stock-warning {
            color: #dc2626;
            font-weight: 500;
        }

        .stock-ok {
            color: #16a34a;
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

        .order-options {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin: 1rem 0;
        }

        .btn-order {
            padding: 0.5rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 5px;
            color: #4a5568;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-order:hover, .btn-order.active {
            background-color: #f1f5f9;
            color: #1e40af;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <h1>Inventario de Telas</h1>
        
        <div class="actions">
            <a href="agregar.php" class="btn btn-primary">Agregar Tela</a>
            <a href="vender.php" class="btn btn-secondary">Vender</a>
        </div>

        <div class="order-options">
            <a href="?orden=fecha" class="btn-order <?= $_GET['orden'] === 'fecha' ? 'active' : '' ?>">Ordenar por fecha</a>
            <a href="?orden=stock" class="btn-order <?= $_GET['orden'] === 'stock' ? 'active' : '' ?>">Ordenar por stock</a>
        </div>

        <?php
        $orden = isset($_GET['orden']) ? $_GET['orden'] : 'id';
        $sql = "SELECT * FROM telas ORDER BY ";
        $sql .= $orden === 'fecha' ? 'fecha_ingreso DESC' : ($orden === 'stock' ? 'largo DESC' : 'id DESC');
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0):
        ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Color</th>
                        <th>Largo (m)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['tipo']) ?></td>
                        <td><?= htmlspecialchars($row['color']) ?></td>
                        <td class="<?= $row['largo'] < 5 ? 'stock-warning' : 'stock-ok' ?>">
                            <?= number_format($row['largo'], 1) ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="empty-message">No hay telas registradas en el inventario.</p>
        <?php endif; ?>
        
        <div class="footer">
            Hecho con <span>♥</span> por boogiepop-135
        </div>
    </div>
</body>
</html>
