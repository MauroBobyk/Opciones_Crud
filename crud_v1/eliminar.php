<?php
// eliminar.php - Borrado (DELETE) de productos
// SOLO acepta POST (nunca se borra por GET), así el borrado es más seguro.
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) ($_POST['id'] ?? 0);

    // Solo borrar si el id es válido
    if ($id > 0) {
        // Consulta preparada: elimina el producto con ese id
        $consulta = $conexionbd->prepare("DELETE FROM productos WHERE id = :id");
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        header('Location: ver.php?mensaje=Producto+eliminado+con+éxito');
        exit;
    }
}

// Si no llegó por POST o el id es inválido, volver al listado
header('Location: ver.php?mensaje=ID+inválido');
exit;
