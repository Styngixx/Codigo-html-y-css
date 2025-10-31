<?php
require_once("../php/Conexion.php");
$conn = CConexion::ConexionDB();

if (!isset($_GET['id'])) {
    echo "❌ No se especificó el ID del pedido.";
    exit();
}
$id_pedido = $_GET['id'];

$sql = "SELECT p.id_pedido, p.fecha, u.nombre AS cliente, d.cantidad, d.precio_unitario,
               pr.nombre AS producto
        FROM pedidos p
        JOIN usuarios u ON p.id_usuarios = u.id_usuarios
        JOIN detalle_pedido d ON p.id_pedido = d.id_pedido
        JOIN productos pr ON d.id_producto = pr.id_productos
        WHERE p.id_pedido = :id";

$stmt = $conn->prepare($sql);
$stmt->execute([':id' => $id_pedido]);
$detalles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Detalle del Pedido</title>
  <link rel="stylesheet" href="../Css/detalle.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-beige">
  <div class="container mt-5">
    <h2 class="text-orange text-center mb-4">📦 Detalle del Pedido #<?= htmlspecialchars($id_pedido) ?></h2>

    <?php if ($detalles): ?>
      <div class="card shadow-lg border-0">
        <div class="card-body bg-light-beige">
          <p><strong>Cliente:</strong> <?= htmlspecialchars($detalles[0]['cliente']) ?></p>
          <p><strong>Fecha:</strong> <?= htmlspecialchars($detalles[0]['fecha']) ?></p>

          <table class="table table-bordered table-striped mt-3">
            <thead class="table-orange text-white">
              <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $total = 0;
              foreach ($detalles as $item):
                $subtotal = $item['cantidad'] * $item['precio_unitario'];
                $total += $subtotal;
              ?>
              <tr>
                <td><?= htmlspecialchars($item['producto']) ?></td>
                <td><?= $item['cantidad'] ?></td>
                <td>S/. <?= $item['precio_unitario'] ?></td>
                <td>S/. <?= number_format($subtotal, 2) ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

          <h4 class="text-end text-dark-emphasis">Total: <strong>S/. <?= number_format($total, 2) ?></strong></h4>
        </div>
      </div>
    <?php else: ?>
      <p class="text-center">❌ No se encontró información para este pedido.</p>
    <?php endif; ?>
  </div>
</body>
</html>