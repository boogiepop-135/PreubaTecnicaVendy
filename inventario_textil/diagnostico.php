<?php
echo "<h2>Diagnóstico de Conexión MySQL</h2>";

// Verificar si MySQL está instalado
if (!extension_loaded('mysqli')) {
    die("❌ Extensión mysqli no está instalada");
}

// Verificar servicios activos
if (PHP_OS === 'WINNT') {
    exec('sc query MySQL', $output);
    echo "Estado del servicio MySQL: <pre>" . implode("\n", $output) . "</pre>";
}

// Intentar conexiones
$configs = [
    ['127.0.0.1', 'root', ''],
    ['localhost', 'root', ''],
    ['::1', 'root', '']
];

foreach ($configs as $config) {
    try {
        $conn = new mysqli($config[0], $config[1], $config[2]);
        echo "✅ Conexión exitosa con: {$config[0]}<br>";
        $conn->close();
    } catch (Exception $e) {
        echo "❌ Error con {$config[0]}: {$e->getMessage()}<br>";
    }
}
?>
