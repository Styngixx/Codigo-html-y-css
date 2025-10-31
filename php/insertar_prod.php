<?php
include("Conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $imagen = $_POST['imagen']; // solo el nombre del archivo

    try {
        require_once("Conexion.php");
        $cxx = new CConexion();
        $conn = $cxx->ConexionDB();
        $sql = "INSERT INTO productos (nombre, descripcion, precio, stock, imagen)
                VALUES (:nombre, :descripcion, :precio, :stock, :imagen)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':descripcion' => $descripcion,
            ':precio' => $precio,
            ':stock' => $stock,
            ':imagen' => $imagen
        ]);
        echo "Producto insertado correctamente.";
    } catch (PDOException $e) {
        echo "Error al insertar: " . $e->getMessage();
    }
}
?>