<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "AlvariT0.3390";
$database = "tienda";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Validar datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre_producto"];
    $descripcion = $_POST["descripcion_producto"];
    $precio = $_POST["precio_producto"];
    $stock = $_POST["stock_producto"];

    // Validación básica en el servidor
    if (!empty($nombre) && !empty($descripcion) && $precio > 0 && $stock > 0) {
        // Insertar producto en la base de datos
        $sql = "INSERT INTO PRODUCTO (nombre, descripcion, precio, stock) 
                VALUES ('$nombre', '$descripcion', $precio, $stock)";

        if ($conn->query($sql) === TRUE) {
            echo "Producto agregado correctamente.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Por favor, complete todos los campos correctamente.";
    }
}

$conn->close();
?>
