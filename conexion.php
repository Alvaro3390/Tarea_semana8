<?php
$host = 'localhost'; // Cambia si tu servidor no es local
$user = 'Alvaro';      // Usuario de MySQL
$pass = '12345678';          // Contraseña de MySQL
$dbname = 'tienda';  // Nombre de la base de datos

// Crear conexión usando MySQLi
$conn = new mysqli($host, $user, $pass, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
} else {
    echo "Conexión exitosa a la base de datos TIENDA.";
}
?>
