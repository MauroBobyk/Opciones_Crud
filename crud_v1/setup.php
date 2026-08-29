<?php
// =============================================================
// setup.php - Creación automática de la base de datos (V1)
// -------------------------------------------------------------
// Crea la base de datos y la tabla si no existen, e inserta un
// registro de ejemplo.
// NOTA: no incluye conexion.php al inicio porque la base de datos
// podría no existir todavía; por eso conecta primero al servidor y,
// una vez creada la BD, reutiliza la conexión estándar (conexion.php).
// =============================================================

require __DIR__ . '/config.php'; // credenciales definidas en un solo lugar

$mensajes = [];   // lista de pasos realizados
$exito    = false; // si todo salió bien

try {
    // 1) Conectar solo al servidor MySQL (sin seleccionar ninguna BD)
    $pdo = new PDO("mysql:host=$db_host", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 2) Crear la base de datos si no existe
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $mensajes[] = "Base de datos <code>`$db_name`</code> creada (o ya existía).";

    // 3) La BD ya existe → reutilizar la conexión estándar de conexion.php
    require __DIR__ . '/conexion.php';
    if (!isset($conexionbd)) {
        throw new RuntimeException('No se pudo conectar a la base de datos.');
    }

    // 4) Crear la tabla productos si no existe
    $conexionbd->exec("CREATE TABLE IF NOT EXISTS productos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        articulo VARCHAR(50) NOT NULL,
        descripcion TEXT NOT NULL,
        unidades_disponibles INT NOT NULL DEFAULT 0
    )");
    $mensajes[] = "Tabla <code>productos</code> creada (o ya existía).";

    // 5) Insertar un registro de ejemplo solo si la tabla está vacía
    $count = (int) $conexionbd->query("SELECT COUNT(*) FROM productos")->fetchColumn();
    if ($count === 0) {
        $conexionbd->exec("INSERT INTO productos (articulo, descripcion, unidades_disponibles)
                    VALUES ('Producto de ejemplo', 'Este es un producto de prueba', 10)");
        $mensajes[] = "Registro de ejemplo insertado.";
    } else {
        $mensajes[] = "La tabla ya tiene registros, no se insertó nada.";
    }

    $exito = true;
} catch (Exception $e) {
    $error = "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Base de Datos - V1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a href="index.php" class="navbar-brand">Ejemplo CRUD</a>
    </div>
</nav>
<main class="container crud-form-container">
    <h1 class="mb-3">Crear base de datos</h1>
    <div class="card shadow-sm">
        <div class="card-body">
            <?php if ($exito): ?>
                <div class="alert alert-success">
                    <h2 class="h5 mb-2">✅ Base de datos lista</h2>
                    <ul class="mb-0">
                        <?php foreach ($mensajes as $m): ?>
                            <li><?= $m ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <p class="text-muted mb-3">
                    Ya podés usar el CRUD normalmente. Este botón crea la BD y la
                    tabla si no existen, sin necesidad de ejecutar SQL a mano.
                </p>
            <?php else: ?>
                <div class="alert alert-danger mb-3">
                    <strong>No se pudo crear la base de datos.</strong><br>
                    <?= htmlspecialchars($error) ?>
                </div>
                <p class="text-muted mb-3">
                    Comprobá que Apache y MySQL estén iniciados en XAMPP y que las
                    credenciales de <code>conexion.php</code> sean correctas.
                </p>
            <?php endif; ?>
            <a href="index.php" class="btn btn-primary">Volver al inicio</a>
            <a href="ver.php" class="btn btn-success">Ir al listado</a>
        </div>
    </div>
</main>
<footer class="crud-footer">
    Aplicación realizada por el profesor Mauro Andrés Bobyk
</footer>
</body>
</html>
