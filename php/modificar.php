<?php
require_once("Conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $imagen = $_POST['imagen'];

    try {
        $conn = CConexion::ConexionDB();

        $sql = "UPDATE productos SET 
                    nombre = COALESCE(NULLIF(:nombre, ''), nombre),
                    descripcion = COALESCE(NULLIF(:descripcion, ''), descripcion),
                    precio = COALESCE(:precio, precio),
                    stock = COALESCE(:stock, stock),
                    imagen = COALESCE(NULLIF(:imagen, ''), imagen)
                WHERE id_productoS = :id";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':nombre' => $nombre,
            ':descripcion' => $descripcion,
            ':precio' => $precio !== "" ? $precio : null,
            ':stock' => $stock !== "" ? $stock : null,
            ':imagen' => $imagen
        ]);

        echo "✅ Producto modificado correctamente.";
    } catch (PDOException $e) {
        echo "❌ Error al modificar: " . $e->getMessage();
    }
}
?>