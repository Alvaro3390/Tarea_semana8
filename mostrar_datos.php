<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "TIENDA";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

echo "<h2>Productos</h2>";
$result = $conn->query("SELECT * FROM PRODUCTO");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: {$row['id_producto']} | Nombre: {$row['nombre']} | Precio: {$row['precio']} | Stock: {$row['stock']}<br>";
    }
} else {
    echo "No hay productos registrados.";
}

echo "<h2>Clientes</h2>";
$result = $conn->query("SELECT * FROM CLIENTE");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: {$row['id_cliente']} | Nombre: {$row['nombre']} | Email: {$row['email']}<br>";
    }
} else {
    echo "No hay clientes registrados.";
}

$conn->close();
?>
