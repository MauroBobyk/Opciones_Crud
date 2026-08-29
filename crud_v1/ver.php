<?php
// ver.php - Lectura (SELECT) de productos
// Lista todos los productos, del más nuevo al más antiguo.
require 'conexion.php';

// 1) Consultar todos los productos ordenados por id descendente
$consulta = $conexionbd->query("SELECT * FROM productos ORDER BY id DESC");
$productos = $consulta->fetchAll(PDO::FETCH_ASSOC);

// 2) Mensaje opcional que llega por la URL (ej: "Producto creado con éxito")
$mensaje = $_GET['mensaje'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Productos - V1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a href="index.php" class="navbar-brand">Ejemplo CRUD</a>
    </div>
</nav>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Listado de productos</h1>
        <a href="crear.php" class="btn btn-success btn-sm">+ Nuevo producto</a>
    </div>

    <?php if ($mensaje): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($mensaje) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <table class="table table-striped table-hover align-middle crud-table">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Artículo</th>
                <th>Descripción</th>
                <th>Unidades</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?= $producto['id'] ?></td>
                <td><?= htmlspecialchars($producto['articulo']) ?></td>
                <td><?= htmlspecialchars($producto['descripcion']) ?></td>
                <td><?= $producto['unidades_disponibles'] ?></td>
                <td class="text-center">
                    <a href="modificar.php?id=<?= $producto['id'] ?>" class="btn btn-warning btn-sm">✏ Editar</a>
                    <form action="eliminar.php" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este producto?');">
                        <input type="hidden" name="id" value="<?= $producto['id'] ?>">
                        <button type="submit" class="btn btn-danger btn-sm">🗑 Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<footer class="crud-footer">
    Aplicación realizada por el profesor Mauro Andrés Bobyk
</footer>
</body>
</html>
