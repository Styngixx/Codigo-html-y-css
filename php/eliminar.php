<?php
require_once("Conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    try {
        $conn = CConexion::ConexionDB();

        $sql = "DELETE FROM productos WHERE id_productos = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $id]);

        echo "✅ Producto eliminado correctamente.";
    } catch (PDOException $e) {
        echo "❌ Error al eliminar: " . $e->getMessage();
    }
}
?>