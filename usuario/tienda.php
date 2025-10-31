<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Tienda - Minimarket</title>
    <link rel="stylesheet" href="../Css/tienda.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-beige">

    <div class="container mt-4">
        <h1 class="text-orange text-center mb-4">🛍️ Productos Disponibles</h1>

        <div class="row" id="contenedor-productos">
            <!-- Aquí se insertarán los productos con PHP -->
            <?php
        require_once("../php/Conexion.php");
        $conn = CConexion::ConexionDB();
        $sql = "SELECT * FROM productos";
        $stmt = $conn->query($sql);
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($productos as $p) {
          echo '
          <div class="col-md-4 mb-4">
            <div class="card producto-card">
              <img src="../Image/' . $p['imagen'] . '" class="card-img-top" alt="' . $p['nombre'] . '">
              <div class="card-body">
                <h5 class="card-title">' . $p['nombre'] . '</h5>
                <p class="card-text">' . $p['descripcion'] . '</p>
                <p class="precio">S/ ' . $p['precio'] . '</p>
                <form action="carrito.php" method="POST">
                  <input type="hidden" name="id" value="' . $p['id_productos'] . '">
                  <button type="submit" class="btn btn-orange w-100">Agregar al carrito</button>
                </form>
              </div>
            </div>
          </div>';
        }
      ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>