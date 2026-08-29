<?php
// crear.php - Alta (INSERT) de productos
// Recibe los datos del formulario por POST y los guarda en la tabla `productos`.
require 'conexion.php';

$errores = []; // lista de mensajes de error de validación

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1) Recuperar y limpiar los datos enviados por el formulario
    $articulo   = trim($_POST['articulo'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $unidades   = (int) ($_POST['unidades_disponibles'] ?? 0);

    // 2) Validación básica de datos
    if ($articulo === '') {
        $errores[] = 'El artículo no puede estar vacío.';
    }
    if ($descripcion === '') {
        $errores[] = 'La descripción no puede estar vacía.';
    }

    // 3) Solo se inserta si no hay errores
    if (empty($errores)) {
        // Consulta preparada: evita inyección SQL
        $consulta = $conexionbd->prepare("INSERT INTO productos (articulo, descripcion, unidades_disponibles) VALUES (:articulo, :descripcion, :unidades)");
        $consulta->bindParam(':articulo', $articulo);
        $consulta->bindParam(':descripcion', $descripcion);
        $consulta->bindParam(':unidades', $unidades, PDO::PARAM_INT);
        $consulta->execute();

        header('Location: ver.php?mensaje=Producto+creado+con+éxito');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Producto - V3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body class="dark-body">
<header class="dark-header">
    <div class="dark-header-inner">
        <a href="index.php" class="text-decoration-none text-light"><h1 class="mb-0">CRUD Productos</h1></a>
        <span class="dark-badge">Crear</span>
    </div>
</header>
<main class="dark-main container">
    <div class="dark-form">
        <h2 class="mb-3">Crear producto</h2>

        <?php if (!empty($errores)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($errores as $e): ?>
                        <li><?= htmlspecialchars($e) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Artículo</label>
                <input type="text" name="articulo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Unidades Disponibles</label>
                <input type="number" name="unidades_disponibles" class="form-control" required min="0">
            </div>
            <button type="submit" class="btn btn-success">Crear</button>
            <a href="ver.php" class="btn btn-outline-light">Volver al listado</a>
        </form>
    </div>
</main>
<footer class="dark-footer">
    Aplicación realizada por el profesor Mauro Andrés Bobyk
</footer>
</body>
</html>
