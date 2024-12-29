<?php

class Pedido {
    // Propiedades del pedido
    private $descripcion;
    private $tipo_pedido;
    private $producto;
    private $unidades;
    private $observaciones;

    // Constructor para inicializar el pedido
    public function __construct($descripcion, $tipo_pedido, $producto, $unidades, $observaciones = "") {
        $this->descripcion = $descripcion;
        $this->tipo_pedido = $tipo_pedido;
        $this->producto = $producto;
        $this->unidades = $unidades;
        $this->observaciones = $observaciones;
    }

    // Métodos getter
    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getTipoPedido() {
        return $this->tipo_pedido;
    }

    public function getProducto() {
        return $this->producto;
    }

    public function getUnidades() {
        return $this->unidades;
    }

    public function getObservaciones() {
        return $this->observaciones;
    }

    // Métodos setter
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setTipoPedido($tipo_pedido) {
        $this->tipo_pedido = $tipo_pedido;
    }

    public function setProducto($producto) {
        $this->producto = $producto;
    }

    public function setUnidades($unidades) {
        $this->unidades = $unidades;
    }

    public function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    // Método para mostrar detalles del pedido
    public function mostrarDetalles() {
        echo "Descripción del pedido: " . $this->descripcion . "<br>";
        echo "Tipo de pedido: " . $this->tipo_pedido . "<br>";
        echo "Producto: " . $this->producto . "<br>";
        echo "Unidades: " . $this->unidades . "<br>";
        echo "Observaciones: " . $this->observaciones . "<br>";
    }

    // Método estático para buscar pedidos por tipo
    public static function buscarPorTipo($pedidos, $tipo) {
        $resultados = [];
        foreach ($pedidos as $pedido) {
            if ($pedido->getTipoPedido() == $tipo) {
                $resultados[] = $pedido;
            }
        }
        return $resultados;
    }

    // Método estático para buscar pedidos por producto
    public static function buscarPorProducto($pedidos, $producto) {
        $resultados = [];
        foreach ($pedidos as $pedido) {
            if ($pedido->getProducto() == $producto) {
                $resultados[] = $pedido;
            }
        }
        return $resultados;
    }
}

// Crear algunos pedidos de ejemplo
$pedido1 = new Pedido("Pedido de prueba 1", "Envío", "Laptop", 2, "Entregar entre 9am y 12pm");
$pedido2 = new Pedido("Pedido urgente", "Recogida", "Smartphone", 1, "Recoger en tienda");
$pedido3 = new Pedido("Pedido regular", "Envío", "Teclado", 3, "Sin observaciones");

// Almacenar los pedidos en un arreglo
$pedidos = [$pedido1, $pedido2, $pedido3];

// Buscar pedidos por tipo
$pedidos_en_envio = Pedido::buscarPorTipo($pedidos, "Envío");

// Mostrar los resultados de búsqueda
echo "<h3>Pedidos con tipo 'Envío':</h3>";
foreach ($pedidos_en_envio as $pedido) {
    $pedido->mostrarDetalles();
    echo "<hr>";
}

// Buscar pedidos por producto
$pedidos_teclado = Pedido::buscarPorProducto($pedidos, "Teclado");

// Mostrar los resultados de búsqueda
echo "<h3>Pedidos con producto 'Teclado':</h3>";
foreach ($pedidos_teclado as $pedido) {
    $pedido->mostrarDetalles();
    echo "<hr>";
}



// Verificar que el método de envío sea POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $description = htmlspecialchars($_POST['description']);
    $order_type = htmlspecialchars($_POST['order_type']);
    $product = htmlspecialchars($_POST['product']);
    $units = intval($_POST['units']);
    $observations = htmlspecialchars($_POST['observations']);

    // Validación básica
    if (!empty($description) && !empty($order_type) && !empty($product) && $units > 0) {
        // Simulación de almacenamiento en base de datos
        echo "<h2>Pedido registrado exitosamente:</h2>";
        echo "<p><strong>Descripción:</strong> $description</p>";
        echo "<p><strong>Tipo de pedido:</strong> $order_type</p>";
        echo "<p><strong>Producto:</strong> $product</p>";
        echo "<p><strong>Unidades:</strong> $units</p>";
        echo "<p><strong>Observaciones:</strong> $observations</p>";
    } else {
        echo "<h2>Error:</h2>";
        echo "<p>Por favor, complete todos los campos correctamente.</p>";
    }
} else {
    echo "<h2>Error:</h2>";
    echo "<p>Acceso no válido. Utilice el formulario para enviar datos.</p>";
}
?>
