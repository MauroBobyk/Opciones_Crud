<?php
// index.php - Menú principal (Versión 3)
// Página de inicio con acceso a crear, ver y crear la base de datos.
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD Productos - Versión 3 (Dark)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body class="dark-body">
<header class="dark-header">
    <div class="dark-header-inner">
        <h1 class="mb-0">CRUD Productos</h1>
        <span class="dark-badge">Dark mode</span>
    </div>
</header>
<main class="dark-main container">
    <div class="row g-4">
        <div class="col-md-6">
            <div class="dark-card">
                <h2>Crear producto</h2>
                <p>Alta de nuevos ítems en el sistema.</p>
                <a href="crear.php" class="btn btn-success w-100">➕ Crear</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="dark-card">
                <h2>Ver / gestionar</h2>
                <p>Consulta, edición y eliminación de registros.</p>
                <a href="ver.php" class="btn btn-primary w-100">📋 Ir al listado</a>
            </div>
        </div>
    </div>
    <div class="row g-4 mt-0">
        <div class="col-md-6">
            <div class="dark-card">
                <h2>Base de datos</h2>
                <p>Creá la BD y la tabla automáticamente, si no existen.</p>
                <a href="setup.php" class="btn btn-outline-info w-100">⚙️ Crear base de datos</a>
            </div>
        </div>
    </div>
</main>
<footer class="dark-footer">
    Aplicación realizada por el profesor Mauro Andrés Bobyk
</footer>
</body>
</html>
