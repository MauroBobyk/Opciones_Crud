<?php
// modificar.php - Actualización (UPDATE) de productos
// Muestra el formulario con los datos actuales y guarda los cambios.
require 'conexion.php';

// Si no viene ningún id (ni por GET ni por POST), no se puede continuar
if (!isset($_GET['id']) && !isset($_POST['id'])) {
    header('Location: ver.php?mensaje=ID+no+proporcionado');
    exit;
}

// ---------- Si el usuario envió el formulario (POST) ----------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1) Recuperar datos del formulario
    $id = (int) ($_POST['id'] ?? 0);
    $articulo   = $_POST['articulo'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $unidades   = $_POST['unidades_disponibles'] ?? 0;

    // 2) Actualizar el registro con consulta preparada (anti inyección SQL)
    $consulta = $conexionbd->prepare("UPDATE productos SET articulo = :articulo, descripcion = :descripcion, unidades_disponibles = :unidades WHERE id = :id");
    $consulta->bindParam(':articulo', $articulo);
    $consulta->bindParam(':descripcion', $descripcion);
    $consulta->bindParam(':unidades', $unidades, PDO::PARAM_INT);
    $consulta->bindParam(':id', $id, PDO::PARAM_INT);
    $consulta->execute();

    header('Location: ver.php?mensaje=Producto+modificado+con+éxito');
    exit;
}

// ---------- Si vino por GET (click en "Editar") ----------
$id = (int) ($_GET['id'] ?? 0);

// Buscar el producto para precargar el formulario
$consulta = $conexionbd->prepare("SELECT * FROM productos WHERE id = :id");
$consulta->bindParam(':id', $id, PDO::PARAM_INT);
$consulta->execute();
$producto = $consulta->fetch(PDO::FETCH_ASSOC);

// Si el producto no existe, volver al listado con un mensaje
if (!$producto) {
    header('Location: ver.php?mensaje=Producto+no+encontrado');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar - V3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body class="dark-body">
<header class="dark-header">
    <div class="dark-header-inner">
        <a href="index.php" class="text-decoration-none text-light"><h1 class="mb-0">CRUD Productos</h1></a>
        <span class="dark-badge">Editar</span>
    </div>
</header>
<main class="dark-main container">
    <div class="dark-form">
        <h2 class="mb-3">Modificar producto</h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $producto['id'] ?>">
            <div class="mb-3">
                <label class="form-label">Artículo</label>
                <input type="text" name="articulo" class="form-control" required value="<?= htmlspecialchars($producto['articulo']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" required><?= htmlspecialchars($producto['descripcion']) ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Unidades Disponibles</label>
                <input type="number" name="unidades_disponibles" class="form-control" required min="0" value="<?= $producto['unidades_disponibles'] ?>">
            </div>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
            <a href="ver.php" class="btn btn-outline-light">Cancelar</a>
        </form>
    </div>
</main>
<footer class="dark-footer">
    Aplicación realizada por el profesor Mauro Andrés Bobyk
</footer>
</body>
</html>
