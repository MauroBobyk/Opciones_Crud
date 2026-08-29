# Opciones CRUD

> Carpeta contenedora del proyecto **Opciones CRUD**: tres versiones de la misma aplicación de gestión de productos (CRUD en PHP + PDO + MariaDB) con interfaces distintas, más un **lanzador** que permite acceder a cada versión desde un único punto de entrada.

---

## 1. ¿Qué se encuentra en esta carpeta?

Esta carpeta reúne **tres implementaciones del mismo sistema** con diferentes diseños de interfaz, de modo que se pueda comparar el impacto visual y de usabilidad de cada una sobre la misma lógica de negocio.

```
Opciones_Crud/
├── index.php        → Lanzador: tarjetas-botón para acceder a cada versión.
├── README.md        → Este documento (descripción general de la carpeta).
├── crud_v1/         → Versión 1: interfaz clara (navbar + tarjetas, Bootstrap).
├── crud_v2/         → Versión 2: interfaz tipo panel con barra lateral.
└── crud_v3/         → Versión 3: interfaz oscura (dark mode).
```

---

## 2. Las tres versiones

| Versión | Característica visual | Acceso |
|---|---|---|
| **crud_v1** | Estilo clásico: barra de navegación superior azul y tarjetas de acceso, sobre fondo claro. | `crud_v1/index.php` |
| **crud_v2** | Panel de administración: menú lateral con degradado azul → violeta y área de contenido central. | `crud_v2/index.php` |
| **crud_v3** | Dark mode: encabezado con blur, tarjetas con degradado, tabla y formularios oscuros. | `crud_v3/index.php` |

Las tres versiones comparten **el mismo sistema** y solo difieren en la interfaz:

- Alta, listado, edición y eliminación de productos (CRUD completo).
- Creación automática de la base de datos desde la propia aplicación (botón **"⚙️ Crear BD"**).
- Conexión PDO con consultas preparadas, salida escapada con `htmlspecialchars()` y borrado únicamente por `POST`.
- Credenciales centralizadas en `config.php`.
- Comentarios explicativos en cada archivo.

---

## 3. Estructura común de cada versión

Cada subcarpeta (`crud_v1`, `crud_v2`, `crud_v3`) contiene la misma estructura:

```
crud_vX/
├── index.php        → Menú principal de la versión.
├── setup.php        → Crea la base de datos y la tabla automáticamente.
├── tienda.sql       → Script SQL tradicional con la estructura de la base de datos.
├── config.php       → Configuración central de la base de datos (credenciales).
├── conexion.php     → Conexión a la base de datos mediante PDO.
├── crear.php        → Alta (INSERT) de productos.
├── ver.php          → Listado (SELECT) de productos.
├── modificar.php    → Edición (UPDATE) de productos.
├── eliminar.php     → Baja (DELETE) de productos.
├── styles.css       → Estilos propios de cada versión.
└── README.md        → Documentación detallada de la versión.
```

> Cada versión tiene su propio `README.md` con la documentación completa de esa implementación.

---

## 4. Puesta en marcha (XAMPP)

1. Iniciar **Apache** y **MySQL** desde el panel de control de XAMPP.
2. Copiar la carpeta `Opciones_Crud` dentro del directorio `htdocs` de XAMPP.
3. Abrir el navegador y acceder a:

   ```
   http://localhost/Opciones_Crud/
   ```

4. Se mostrará el **lanzador** con las tres tarjetas. Elegir una versión.
5. La primera vez en cada versión, pulsar **"⚙️ Crear BD"** para crear la base de datos y la tabla.
6. A partir de ahí se puede utilizar el CRUD normalmente.

---

## 5. Base de datos

Las tres versiones usan la misma base de datos:

- **Base de datos:** `tienda`
- **Tabla:** `productos`

| Campo | Tipo | Descripción |
|---|---|---|
| `id` | `INT AUTO_INCREMENT` | Clave primaria. |
| `articulo` | `VARCHAR(50) NOT NULL` | Nombre del artículo. |
| `descripcion` | `TEXT NOT NULL` | Descripción del producto. |
| `unidades_disponibles` | `INT NOT NULL DEFAULT 0` | Cantidad de unidades en stock. |

---

## 6. Tecnologías

| Componente | Tecnología |
|---|---|
| Lenguaje | PHP 8 (PDO) |
| Base de datos | MariaDB / MySQL (XAMPP) |
| Frontend | HTML5 + CSS3 + Bootstrap 5.3 |
| Entorno | XAMPP (Apache + MySQL) |

---

---

*Aplicación realizada por el profesor Mauro Andrés Bobyk.*
