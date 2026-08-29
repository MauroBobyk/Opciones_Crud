<?php
// index.php - Menú principal (Versión 1)
// Página de inicio con acceso a crear, ver y crear la base de datos.
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD Productos - Versión 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <span class="navbar-brand">Ejemplo CRUD</span>
    </div>
</nav>

<main class="container">
    <h1 class="text-center mb-4">Gestión de productos</h1>

    <div class="row justify-content-center g-4">
        <div class="col-md-4">
            <a href="crear.php" class="text-decoration-none">
                <div class="card shadow-sm crud-card text-center">
                    <div class="card-body">
                        <h2 class="h4 mb-2">Crear producto</h2>
                        <p class="text-muted mb-3">Agregar un nuevo artículo al stock.</p>
                        <button class="btn btn-success w-100">Ir a Crear</button>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="ver.php" class="text-decoration-none">
                <div class="card shadow-sm crud-card text-center">
                    <div class="card-body">
                        <h2 class="h4 mb-2">Ver / Editar</h2>
                        <p class="text-muted mb-3">Listar, modificar o eliminar productos.</p>
                        <button class="btn btn-outline-primary w-100">Ir a la tabla</button>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="setup.php" class="text-decoration-none">
                <div class="card shadow-sm crud-card text-center">
                    <div class="card-body">
                        <h2 class="h4 mb-2">Base de datos</h2>
                        <p class="text-muted mb-3">Crear la BD y la tabla automáticamente.</p>
                        <button class="btn btn-outline-success w-100">⚙️ Crear BD</button>
                    </div>
                </div>
            </a>
        </div>
    </div>
</main>
<footer class="crud-footer">
    Aplicación realizada por el profesor Mauro Andrés Bobyk
</footer>
</body>
</html>
