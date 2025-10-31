<?php
require_once("Conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];

    try {
        $conn = CConexion::ConexionDB();

        $sql = "SELECT * FROM productos WHERE LOWER(nombre) LIKE LOWER(:nombre)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':nombre' => "%$nombre%"]);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($resultados) > 0) {
            echo "<h3>Resultados encontrados:</h3><ul>";
            foreach ($resultados as $producto) {
                echo "<li><strong>ID:</strong> {$producto['id_productos']} | 
                      <strong>Nombre:</strong> {$producto['nombre']} | 
                      <strong>Precio:</strong> S/.{$producto['precio']} | 
                      <strong>Stock:</strong> {$producto['stock']}</li>";
            }
            echo "</ul>";
        } else {
            echo "❌ No se encontraron productos con ese nombre.";
        }

    } catch (PDOException $e) {
        echo "❌ Error al buscar: " . $e->getMessage();
    }
}
?>