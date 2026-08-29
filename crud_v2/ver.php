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
    <title>CRUD Productos - Versión 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="crud-layout">
    <aside class="crud-sidebar">
        <h2 class="crud-logo">CRUD<br>Productos</h2>
        <nav class="crud-nav">
            <a href="index.php" class="crud-nav-link<?php if(basename($_SERVER['PHP_SELF'])==='index.php') echo ' active'; ?>">🏠 Inicio</a>
            <a href="crear.php" class="crud-nav-link<?php if(basename($_SERVER['PHP_SELF'])==='crear.php') echo ' active'; ?>">➕ Crear producto</a>
            <a href="ver.php" class="crud-nav-link<?php if(basename($_SERVER['PHP_SELF'])==='ver.php') echo ' active'; ?>">📋 Ver productos</a>
        </nav>
    </aside>
    <main class="crud-main">

        <header class="crud-header d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h4 mb-0">Listado de productos</h1>
                <p class="text-muted mb-0">Consulta general del stock.</p>
            </div>
            <a href="crear.php" class="btn btn-success btn-sm">+ Nuevo</a>
        </header>
        <section class="crud-main-content">
            <?php if ($mensaje): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($mensaje) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <table class="table table-sm table-hover align-middle">
                <thead>
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
                        <td class="text-center crud-actions">
                            <a href="modificar.php?id=<?= $producto['id'] ?>" class="btn btn-outline-warning btn-sm">Editar</a>
                            <form action="eliminar.php" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar producto?');">
                                <input type="hidden" name="id" value="<?= $producto['id'] ?>">
                                <button type="submit" class="btn btn-outline-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <footer class="crud-footer">
            Aplicación realizada por el profesor Mauro Andrés Bobyk
        </footer>
    </main>
</div>
</body>
</html>
