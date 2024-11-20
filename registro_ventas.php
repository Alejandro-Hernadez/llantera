<?php
$id_cliente = $_POST['id_cliente'];
$cantidad = $_POST['cantidad'];
$fecha_hora = $_POST['fecha_hora'];
$precio_total = $_POST['precio_total'];
$id_producto = $_POST['id_producto'];

$sql = "INSERT INTO ventas (id_cliente, cantidad, fecha_hora, precio_total, id_producto) 
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iisss", $id_cliente, $cantidad, $fecha_hora, $precio_total, $id_producto);

if ($stmt->execute()) {
    echo "Venta registrada exitosamente.";
} else {
    echo "Error al registrar la venta: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
?>