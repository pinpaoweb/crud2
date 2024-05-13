<?php
//print("Modelo");
class ProductoModelo {
    private PDO $conexion;

    public function __construct() {
        global $conexion;
        $this->conexion = $conexion;
    }
// Modelo para consultar productos en la BD
    public function obtenerProductos(): array {
        $statement = $this->conexion->query("SELECT * FROM productos");
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
// Modelo para agregar productos en la BD
public function agregarProducto(string $nombre, int $stock, float $precio): bool {
    try {
        $statement = $this->conexion->prepare("INSERT INTO productos (nombre, stock, precio) VALUES (?, ?, ?)");
        return $statement->execute([$nombre, $stock, $precio]);
    } catch (PDOException $e) {
        exit("Error al agregar el producto: " . $e->getMessage());
    }
}

// Modelo para consultar UN producto en la BD por su ID
public function obtenerProductoPorId(int $id): array {
    $statement = $this->conexion->prepare("SELECT * FROM productos WHERE id = ?");
    $statement->execute([$id]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}

// Modelo para Actualizar UN producto en la BD por su ID
public function actualizarProducto(int $id, string $nombre, int $stock, float $precio): bool {
    try {
        $statement = $this->conexion->prepare("UPDATE productos SET nombre = ?, stock = ?, precio = ? WHERE id = ?");
        return $statement->execute([$nombre, $stock, $precio, $id]);
    } catch (PDOException $e) {
        exit("Error al actualizar el producto: " . $e->getMessage());
    }
}

// Modelo para Eliminar UN producto en la BD por su ID
public function eliminarProducto(int $id): bool {
    try {
        $statement = $this->conexion->prepare("DELETE FROM productos WHERE id = ?");
        return $statement->execute([$id]);
    } catch (PDOException $e) {
        exit("Error al eliminar el producto: " . $e->getMessage());
    }
}



}
?>
