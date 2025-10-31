<?php
session_start();
require_once("../php/Conexion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Carrito de Compras</title>
  <link rel="stylesheet" href="../Css/carrito.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-beige">

  <div class="container mt-5">
    <h1 class="text-orange text-center mb-4">🛒 Tu Carrito</h1>

    <div class="card shadow-lg border-0">
      <div class="card-body bg-light-beige">
        <?php
        if (!empty($_SESSION['carrito'])) {
          echo '<table class="table table-bordered table-striped">';
          echo '<thead class="table-orange text-white"><tr>
                  <th>Producto</th>
                  <th>Precio</th>
                  <th>Cantidad</th>
                  <th>Subtotal</th>
                </tr></thead><tbody>';

          $total = 0;
          foreach ($_SESSION['carrito'] as $id => $item) {
            $subtotal = $item['precio'] * $item['cantidad'];
            $total += $subtotal;
            echo "<tr>
                    <td>{$item['nombre']}</td>
                    <td>S/. {$item['precio']}</td>
                    <td>{$item['cantidad']}</td>
                    <td>S/. {$subtotal}</td>
                  </tr>";
          }

          echo "</tbody></table>";
          echo "<h4 class='text-end text-dark-emphasis'>Total: <strong>S/. {$total}</strong></h4>";
          echo '<form action="detalle_pedido.php" method="POST">
                  <button type="submit" class="btn btn-orange w-100 mt-3">✅ Confirmar Pedido</button>
                </form>';
        } else {
          echo "<p class='text-center'>🛒 Tu carrito está vacío.</p>";
        }
        ?>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>