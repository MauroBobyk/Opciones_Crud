<?php
// index.php - Menú principal (Versión 2)
// Página de inicio con acceso a crear, ver y crear la base de datos.
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
            <a href="setup.php" class="crud-nav-link<?php if(basename($_SERVER['PHP_SELF'])==='setup.php') echo ' active'; ?>">⚙️ Crear BD</a>
        </nav>
    </aside>
    <main class="crud-main">

        <header class="crud-header">
            <h1>Bienvenido al panel de productos</h1>
            <p class="text-muted mb-0">Desde aquí podés crear, ver, editar y eliminar artículos.</p>
        </header>
        <section class="crud-main-content">
            <div class="alert alert-info">
                Elegí una opción del menú lateral para comenzar.
            </div>
            <div class="alert alert-light border d-flex flex-wrap align-items-center justify-content-between">
                <div>
                    <strong>¿Primera vez?</strong> Creá la base de datos y la tabla automáticamente.
                </div>
                <a href="setup.php" class="btn btn-sm btn-primary">⚙️ Crear BD</a>
            </div>
        </section>

        <footer class="crud-footer">
            Aplicación realizada por el profesor Mauro Andrés Bobyk
        </footer>
    </main>
</div>
</body>
</html>
