<?php
// conexion.php - Conexión a la base de datos con PDO
// Todos los archivos del CRUD incluyen este archivo para conectarse.
require __DIR__ . '/config.php'; // credenciales definidas en un solo lugar

try {
    // Crear la conexión PDO con la base de datos
    $conexionbd = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    // Configurar PDO para que lance excepciones ante errores
    $conexionbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
/*PDO (PHP Data Objects) es una extensión de PHP que proporciona una interfaz uniforme
 para conectarse y trabajar con diferentes sistemas de gestión de bases de datos (DBMS)*/
?>