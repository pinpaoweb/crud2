<!DOCTYPE html>
<html>
<head>
    <title>CRUD de Productos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <?php
    require_once 'configuracion/conexion.php';
    require_once 'controladores/ProductoControlador.php';

    $controladorProducto = new ProductoControlador();

    // Acciones GET
    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        $accion = $_GET['accion'] ?? '';

        switch ($accion) {
            case 'modalAdd':
                include './vistas/modaladdproducto.php';
                break;
            case 'modalActualizar':
                if (isset($_GET['id'])) {
                    $controladorProducto->mostrarFormularioActualizarProducto($_GET['id']);
                }
                break;
            case 'eliminarProducto':
                if (isset($_GET['id'])) {
                    $controladorProducto->eliminarProducto($_GET['id']);
                }
                break;
        }

        // Mostrar productos y agregar clases
        $controladorProducto->mostrarProductos();
    }

    // Acciones POST
    elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
        $accion = $_POST['accion'] ?? '';

        switch ($accion) {
            case 'agregar_producto':
                $controladorProducto->agregarProducto();
                break;
            case 'actualizar_producto':
                $controladorProducto->actualizarProducto();
                break;
        }

        header("Location: index.php");
        exit();
    }

    // Redireccionamiento por defecto
    else {
        header("Location: index.php");
        exit();
    }
    ?>

    <!-- Script para resaltar fila al hacer clic -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var rows = document.querySelectorAll('.table tbody tr');

            rows.forEach(function(row) {
                row.addEventListener('click', function() {
                    // Remueve la clase 'clicked' de todas las filas
                    rows.forEach(function(row) {
                        row.classList.remove('clicked');
                    });

                    // Agrega la clase 'clicked' a la fila clicada
                    this.classList.add('clicked');
                });
            });
        });
    </script>
</body>
</html>

