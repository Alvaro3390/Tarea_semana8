<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "TIENDA";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Validar datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre_cliente"];
    $email = $_POST["email_cliente"];
    $direccion = $_POST["direccion_cliente"];

    // Validación básica en el servidor
    if (!empty($nombre) && !empty($email) && !empty($direccion)) {
        // Insertar cliente en la base de datos
        $sql = "INSERT INTO CLIENTE (nombre, email, direccion) 
                VALUES ('$nombre', '$email', '$direccion')";

        if ($conn->query($sql) === TRUE) {
            echo "Cliente agregado correctamente.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Por favor, complete todos los campos.";
    }
}

$conn->close();
?>
