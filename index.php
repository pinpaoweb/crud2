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

    }

    $controladorProducto->mostrarProductos();
}

// Acciones POST
elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $accion = $_POST['accion'] ?? '';

    switch ($accion) {
        case 'agregar_producto':
            $controladorProducto->agregarProducto();
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