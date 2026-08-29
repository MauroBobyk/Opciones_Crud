<?php
// index.php - Selector de versiones del CRUD
// Página de acceso con tarjetas-botón para las 3 versiones del proyecto.
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opciones CRUD - Versiones</title>
    <style>
        :root { color-scheme: light; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: #1f2937;
        }
        header {
            text-align: center;
            padding: 3rem 1rem 1.5rem;
        }
        header h1 { font-size: 2.2rem; font-weight: 800; }
        header p { color: #4b5563; margin-top: .5rem; }
        .grid {
            max-width: 1080px;
            margin: 0 auto;
            padding: 1.5rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        .card {
            background: #fff;
            border-radius: 1rem;
            padding: 1.75rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
            display: flex;
            flex-direction: column;
            gap: 1rem;
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 30px rgba(0, 0, 0, .12);
        }
        .badge {
            align-self: flex-start;
            padding: .3rem .7rem;
            border-radius: 999px;
            font-size: .75rem;
            font-weight: 600;
            color: #fff;
        }
        .badge-v1 { background: #0d6efd; }
        .badge-v2 { background: linear-gradient(90deg, #0d6efd, #6610f2); }
        .badge-v3 { background: #212529; }
        .card h2 { font-size: 1.35rem; }
        .card p { color: #4b5563; font-size: .95rem; line-height: 1.5; flex: 1; }
        .btn {
            display: block;
            text-align: center;
            text-decoration: none;
            padding: .75rem 1rem;
            border-radius: .6rem;
            font-weight: 600;
            color: #fff;
        }
        .btn-v1 { background: #0d6efd; }
        .btn-v2 { background: linear-gradient(90deg, #0d6efd, #6610f2); }
        .btn-v3 { background: #212529; }
        footer {
            text-align: center;
            padding: 2rem 1rem;
            color: #6b7280;
            font-size: .85rem;
        }
    </style>
</head>
<body>
    <header>
        <h1>🗂️ Opciones CRUD</h1>
        <p>Mismo sistema (PHP + PDO + MariaDB) con tres interfaces diferentes. Elegí una versión para ingresar.</p>
    </header>

    <main class="grid">
        <article class="card">
            <span class="badge badge-v1">Versión 1</span>
            <h2>Estilo Clásico</h2>
            <p>Barra de navegación superior y tarjetas de acceso. Interfaz clara con Bootstrap 5.</p>
            <a class="btn btn-v1" href="crud_v1/index.php">Abrir versión 1 →</a>
        </article>

        <article class="card">
            <span class="badge badge-v2">Versión 2</span>
            <h2>Panel con Sidebar</h2>
            <p>Diseño tipo panel de administración con menú lateral degradado y área de contenido central.</p>
            <a class="btn btn-v2" href="crud_v2/index.php">Abrir versión 2 →</a>
        </article>

        <article class="card">
            <span class="badge badge-v3">Versión 3</span>
            <h2>Dark Mode</h2>
            <p>Interfaz oscura con tarjetas, tabla y formularios integrados en el mismo lenguaje visual.</p>
            <a class="btn btn-v3" href="crud_v3/index.php">Abrir versión 3 →</a>
        </article>
    </main>

    <footer>
        Requiere XAMPP (Apache + MySQL). En la primera visita a cada versión usá "⚙️ Crear BD" para crear la base de datos.
    </footer>
    <footer style="text-align:center; padding:0 1rem 2.5rem; color:#4b5563; font-size:.9rem; font-weight:600;">
        Aplicación realizada por el profesor Mauro Andrés Bobyk
    </footer>
</body>
</html>
