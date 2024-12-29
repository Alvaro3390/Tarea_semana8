<?php
// Iniciar la sesión
session_start();

// Verificar si el carrito ya existe en la sesión; si no, inicializarlo como un arreglo vacío
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Manejar la adición de productos al carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $product_name = htmlspecialchars($_POST['product_name']);
    $quantity = intval($_POST['quantity']);

    // Validar datos
    if (!empty($product_name) && $quantity > 0) {
        // Agregar el producto al carrito (o actualizar si ya existe)
        $found = false;
        foreach ($_SESSION['cart'] as &$product) {
            if ($product['name'] === $product_name) {
                $product['quantity'] += $quantity; // Incrementar cantidad
                $found = true;
                break;
            }
        }

        if (!$found) {
            // Si el producto no existe, agregarlo como nuevo
            $_SESSION['cart'][] = [
                'name' => $product_name,
                'quantity' => $quantity,
            ];
        }
    }

    // Redirigir al HTML principal después de agregar al carrito
    header("Location: index.php"); // Asegúrate de que el archivo principal sea `index.php`
    exit();
}

// Mostrar los productos del carrito (opcional para depuración)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header("Content-Type: application/json");
    echo json_encode($_SESSION['cart']);
    exit();
}
?>
