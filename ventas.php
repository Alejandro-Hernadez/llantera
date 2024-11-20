<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Venta de Llantas</title>
    <link rel="stylesheet" href="ventas.css">
</head>
<body>
    <div class="contenedor">
        <img src="recursos/logo-DinoWheels.ico" alt="Llantas" class="logo">
        <h1>Venta de Llantas</h1>
        <form action="" method="POST">
            <div class="input-group">
                <input type="number" id="id_cliente" name="id_cliente" required>
                <label for="id_cliente">ID Cliente</label>
            </div>

            <div class="input-group">
                <input type="number" id="cantidad" name="cantidad" required>
                <label for="cantidad">Cantidad Vendida</label>
            </div>

            <div class="input-group">
                <input type="number" step="0.01" id="precio_total" name="precio_total" required>
                <label for="precio_total">Precio Total</label>
            </div>

            <div class="input-group">
                <input type="number" id="id_producto" name="id_producto" required>
                <label for="id_producto">ID Producto</label>
            </div>

            <input type="submit" value="Registrar Venta" name="reg_vent" class="button">
        </form>

        <?php
        include 'php/conexion/abrirCon.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['reg_vent']))  {
                $id_cliente = $_POST['id_cliente'];
                $cantidad = $_POST['cantidad'];
                $precio_total = $_POST['precio_total'];
                $id_producto = $_POST['id_producto'];
                $fecha_hora = date('Y-m-d H:i:s');  

                $sql = "INSERT INTO ventas (ID_Clientes, Can_Venta, Fecha_Hora, ID_Producto, precio_total) 
                        VALUES (?, ?, ?, ?, ?)";

                if ($stmt = $conectar->prepare($sql)) {
                    $stmt->bind_param("iisss", $id_cliente, $cantidad, $fecha_hora, $id_producto, $precio_total);

                    if ($stmt->execute()) {
                        $id_venta = $conectar->insert_id;

                        echo "<div class='ticket'>";
                        echo "<h2>Ticket de Venta</h2>";
                        echo "<p><strong>ID Venta:</strong> " . htmlspecialchars($id_venta) . "</p>";
                        echo "<p><strong>ID Cliente:</strong> " . htmlspecialchars($id_cliente) . "</p>";
                        echo "<p><strong>Cantidad Vendida:</strong> " . htmlspecialchars($cantidad) . "</p>";
                        echo "<p><strong>Precio Total:</strong> $" . number_format($precio_total, 2) . "</p>";
                        echo "<p><strong>ID Producto:</strong> " . htmlspecialchars($id_producto) . "</p>";
                        echo "<p><strong>Fecha y Hora:</strong> " . $fecha_hora . "</p>";
                        echo "<p><strong>Venta Registrada Exitosamente</strong></p>";
                        echo "</div>";
                    } else {
                        echo "Error al registrar la venta: " . $stmt->error;
                    }

                    $stmt->close();
                } else {
                    echo "Error al preparar la consulta: " . $conectar->error;
                }
            } else {
                echo "Por favor, complete todos los campos del formulario.";
            }
        }

        include 'php/conexion/cierraCon.php';
        ?>

        <div class="imagenes">
            <img src="recursos/m726-ela-2.png" alt="Llanta" class="img-llanta">
            <img src="recursos/img card.webp" alt="Llanta" class="img-llanta">
        </div>
    </div>
</body>
</html>
