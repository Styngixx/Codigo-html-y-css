<?php
session_start();
require_once("Conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    try {
        $conn = CConexion::ConexionDB();
        $sql = "SELECT * FROM productos WHERE id_productos = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($producto) {
            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito'] = [];
            }

            if (isset($_SESSION['carrito'][$id])) {
                $_SESSION['carrito'][$id]['cantidad'] += 1;
            } else {
                $_SESSION['carrito'][$id] = [
                    'nombre' => $producto['nombre'],
                    'precio' => $producto['precio'],
                    'cantidad' => 1
                ];
            }
        }

        header("Location: ../usuario/carrito.php");
        exit();
    } catch (PDOException $e) {
        echo "❌ Error al agregar al carrito: " . $e->getMessage();
    }
}
?>