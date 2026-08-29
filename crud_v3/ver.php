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
    <title>Listado - V3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body class="dark-body">
<header class="dark-header">
    <div class="dark-header-inner">
        <a href="index.php" class="text-decoration-none text-light"><h1 class="mb-0">CRUD Productos</h1></a>
        <span class="dark-badge">Listado</span>
    </div>
</header>
<main class="dark-main container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Listado de productos</h2>
        <a href="crear.php" class="btn btn-success btn-sm">+ Nuevo producto</a>
    </div>

    <?php if ($mensaje): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($mensaje) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="dark-table-container">
        <table class="dark-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Artículo</th>
                    <th>Descripción</th>
                    <th>Unidades</th>
                    <th style="text-align:center;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?= $producto['id'] ?></td>
                    <td><?= htmlspecialchars($producto['articulo']) ?></td>
                    <td><?= htmlspecialchars($producto['descripcion']) ?></td>
                    <td><?= $producto['unidades_disponibles'] ?></td>
                    <td style="text-align:center;">
                        <a href="modificar.php?id=<?= $producto['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        <form action="eliminar.php" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar este producto?');">
                            <input type="hidden" name="id" value="<?= $producto['id'] ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<footer class="dark-footer">
    Aplicación realizada por el profesor Mauro Andrés Bobyk
</footer>
</body>
</html>
