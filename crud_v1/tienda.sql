-- =============================================================
-- tienda.sql - Estructura SQL tradicional
-- Forma clásica de crear la base de datos y la tabla.
-- (También se puede crear automáticamente desde setup.php)
-- =============================================================

-- 1) Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS tienda
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE tienda;

-- 2) Crear la tabla productos si no existe
CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    articulo VARCHAR(50) NOT NULL,
    descripcion TEXT NOT NULL,
    unidades_disponibles INT NOT NULL DEFAULT 0
);

-- 3) Insertar un registro de ejemplo solo si la tabla está vacía
INSERT INTO productos (articulo, descripcion, unidades_disponibles)
SELECT 'Producto de ejemplo', 'Este es un producto de prueba', 10
WHERE NOT EXISTS (SELECT 1 FROM productos);
