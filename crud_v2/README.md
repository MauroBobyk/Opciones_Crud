# CRUD Productos — Versión 2

> Sistema de gestión de productos (CRUD) desarrollado en **PHP** con **PDO** y **MariaDB/MySQL**, con una interfaz tipo **panel de administración**: barra lateral de navegación con degradado y área de contenido central.

---

## 1. Descripción del proyecto

Aplicación web de tipo **CRUD** (Crear, Leer, Actualizar, Eliminar) para administrar el inventario de una tienda. Permite:

- Registrar nuevos productos con su descripción y stock disponible.
- Consultar el listado completo de productos.
- Editar los datos de un producto existente.
- Eliminar productos (con confirmación previa).

A diferencia de la versión 1, la interfaz se organiza como un **panel de administración**: el menú lateral (`sidebar`) agrupa todas las secciones del sistema (Inicio, Crear producto, Ver productos, Crear BD) y el contenido se despliega en el área principal.

El proyecto incluye un mecanismo de **creación automática de la base de datos** (archivo `setup.php`): crea la base y la tabla si no existen.

---

## 2. Tecnologías utilizadas

| Componente | Tecnología |
|---|---|
| Lenguaje | PHP 8 (orientado a objetos, con PDO) |
| Base de datos | MariaDB / MySQL (XAMPP) |
| Acceso a datos | PDO (PHP Data Objects) |
| Frontend | HTML5 + CSS3 + Bootstrap 5.3 + CSS propio (layout de panel) |
| Entorno de ejecución | XAMPP (Apache + MySQL) |

---

## 3. Estructura del proyecto

```
crud_v2/
├── index.php        → Panel de inicio con el menú lateral y accesos a cada módulo.
├── setup.php        → Crea la base de datos y la tabla automáticamente (migración básica).
├── tienda.sql       → Script SQL tradicional con la estructura de la base de datos.
├── config.php       → Configuración central de la base de datos (credenciales).
├── conexion.php     → Conexión a la base de datos mediante PDO.
├── crear.php        → Alta (INSERT) de productos.
├── ver.php          → Listado (SELECT) de productos.
├── modificar.php    → Edición (UPDATE) de productos.
├── eliminar.php     → Baja (DELETE) de productos.
└── styles.css       → Estilos propios (sidebar, layout y componentes del panel).
```

### Qué hace cada archivo

| Archivo | Función |
|---|---|
| `index.php` | Pantalla principal del panel. Presenta la bienvenida y el acceso a *Crear BD* para la primera puesta en marcha. |
| `setup.php` | Conecta al servidor MySQL, crea la base `tienda` y la tabla `productos` si no existen, e inserta un registro de ejemplo cuando la tabla está vacía. |
| `tienda.sql` | Definición SQL clásica de la base y la tabla. Alternativa manual al `setup.php`. |
| `config.php` | Centraliza las credenciales de la base de datos; lo incluyen `conexion.php` y `setup.php` para evitar repetirlas. |
| `conexion.php` | Centraliza la conexión PDO y configura el modo de errores (`ERRMODE_EXCEPTION`). |
| `crear.php` | Valida los datos del formulario y ejecuta un `INSERT` con consulta preparada. |
| `ver.php` | Consulta todos los productos y los muestra en una tabla ordenada del más reciente al más antiguo. |
| `modificar.php` | Precarga el formulario con los datos del producto y ejecuta un `UPDATE` al guardar. |
| `eliminar.php` | Elimina un producto únicamente mediante `POST` (nunca por `GET`). |
| `styles.css` | Define el layout flexible (sidebar + main), la barra de navegación lateral y los estilos de los componentes. |

---

## 4. Base de datos

- **Base de datos:** `tienda`
- **Tabla:** `productos`

### Campos de la tabla `productos`

| Campo | Tipo | Descripción |
|---|---|---|
| `id` | `INT AUTO_INCREMENT` | Clave primaria. |
| `articulo` | `VARCHAR(50) NOT NULL` | Nombre del artículo. |
| `descripcion` | `TEXT NOT NULL` | Descripción del producto. |
| `unidades_disponibles` | `INT NOT NULL DEFAULT 0` | Cantidad de unidades en stock. |

### Formas de crear la base de datos

1. **Automática:** desde el panel de inicio, pulsar **"⚙️ Crear BD"** (o usar la opción del menú lateral). El archivo `setup.php` se encarga de todo.
2. **Manual:** importar el archivo `tienda.sql` desde phpMyAdmin.

> Nota: `setup.php` y `tienda.sql` definen el mismo esquema. La columna `articulo` es `VARCHAR(50)` en ambos para mantener la consistencia.

---

## 5. Puesta en marcha (XAMPP)

1. Iniciar **Apache** y **MySQL** desde el panel de control de XAMPP.
2. Copiar la carpeta `crud_v2` dentro del directorio `htdocs` de XAMPP.
3. Abrir el navegador y acceder a:

   ```
   http://localhost/crud_v2/
   ```

4. La primera vez, pulsar **"⚙️ Crear BD"** para generar la base de datos y la tabla.
5. A partir de ahí se puede utilizar el CRUD normalmente.

> Si la base de datos ya existe, el `setup.php` la detecta y no duplica nada.

---

## 6. Uso de la aplicación

La navegación se realiza desde la **barra lateral**:

1. **Crear:** opción *➕ Crear producto* → completar los campos → enviar.
2. **Ver:** opción *📋 Ver productos* → listado completo.
3. **Editar:** pulsar *Editar* sobre el producto deseado, modificar y guardar.
4. **Eliminar:** pulsar *Eliminar* y confirmar la acción.
5. **Base de datos:** opción *⚙️ Crear BD* → creación automática de la base y la tabla.

---

## 7. Flujo del CRUD

```mermaid
flowchart TD
    A[Panel principal index.php] --> B[Crear producto crear.php]
    A --> C[Listado ver.php]
    A --> D[Crear BD setup.php]
    B -->|INSERT| C
    C -->|Editar| E[Modificar modificar.php]
    C -->|Eliminar| F[Borrar eliminar.php]
    E -->|UPDATE| C
    F -->|DELETE| C
```

- **Crear:** formulario → `crear.php` → `INSERT` → vuelve al listado con mensaje de éxito.
- **Leer:** `ver.php` → `SELECT` → tabla con los productos.
- **Actualizar:** `modificar.php?id=N` → `UPDATE` → vuelve al listado.
- **Eliminar:** formulario `POST` en `ver.php` → `eliminar.php` → `DELETE` → vuelve al listado.

---

## 8. Aspectos técnicos y buenas prácticas

- **Consultas preparadas (PDO):** todas las operaciones que reciben datos del usuario utilizan sentencias preparadas con parámetros vinculados, lo que previene la **inyección SQL**.
- **Salida segura:** los valores que provienen de la base de datos se muestran con `htmlspecialchars()` para evitar ataques de tipo **XSS**.
- **Eliminación segura:** el borrado solo se acepta por `POST` y con confirmación en el navegador.
- **Validación de datos:** el formulario de alta valida que el artículo y la descripción no estén vacíos, mostrando mensajes de error claros.
- **Estado activo en el menú:** el enlace lateral resalta la sección actual mediante `basename($_SERVER['PHP_SELF'])`.
- **Configuración centralizada:** las credenciales están definidas una sola vez en `config.php`, y `conexion.php` y `setup.php` la reutilizan.
- **Layout con Flexbox:** la estructura `sidebar + main` se implementa con `display: flex`, separando navegación y contenido.

---

## 9. Notas de cátedra (docente de informática)

Este proyecto se plantea como una **práctica integral de programación web** con los siguientes objetivos de aprendizaje:

- Comprender el ciclo completo de un **CRUD** sobre una base de datos relacional.
- Aplicar el patrón **conectar → consultar → renderizar** con la extensión **PDO**.
- Reconocer la diferencia entre métodos HTTP `GET` y `POST` y cuándo corresponde usar cada uno.
- Incorporar buenas prácticas de seguridad básica (consultas preparadas y escape de salida).
- Trabajar con **layout por Flexbox** y navegación por estado activo en una interfaz de panel.
- Interpretar un modelo de datos simple: clave primaria, tipos de datos y restricciones `NOT NULL`.

**Consigna sugerida de trabajo:** incorporar una nueva sección al panel lateral (por ejemplo, "Reportes") y una página asociada, manteniendo el esquema de navegación y las buenas prácticas ya aplicadas.
