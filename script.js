// Definición de la clase Producto
class Producto {
    constructor(id, nombre, categoria, precio) {
      this.id = id; // Identificador único del producto
      this.nombre = nombre; // Nombre del producto
      this.categoria = categoria; // Categoría del producto
      this.precio = precio; // Precio del producto
    }
  
    // Método para mostrar la información del producto
    obtenerDetalles() {
      return `Producto: ${this.nombre}\nCategoría: ${this.categoria}\nPrecio: $${this.precio.toFixed(
        2
      )}`;
    }
  
    // Método para aplicar un descuento al producto
    aplicarDescuento(porcentaje) {
      if (porcentaje > 0 && porcentaje <= 100) {
        this.precio = this.precio - (this.precio * porcentaje) / 100;
        return `Se aplicó un descuento del ${porcentaje}%. El nuevo precio es $${this.precio.toFixed(
          2
        )}`;
      } else {
        return "Porcentaje de descuento inválido.";
      }
    }
  
    // Método para generar una representación HTML del producto
    generarHTML() {
      return `
        <div class="product">
          <h3>${this.nombre}</h3>
          <p>Categoría: ${this.categoria}</p>
          <p>Precio: $${this.precio.toFixed(2)}</p>
        </div>
      `;
    }
  }
  
  // Lista de productos simulados
  const productos = [
    new Producto(1, "Laptop", "Electrónica", 1200),
    new Producto(2, "Auriculares", "Accesorios", 50),
    new Producto(3, "Cámara", "Electrónica", 600),
    new Producto(4, "Silla Gamer", "Muebles", 200),
    new Producto(5, "Escritorio", "Muebles", 150),
    new Producto(6, "Smartphone", "Electrónica", 800),
  ];
  
  // Elementos del DOM
  const searchInput = document.getElementById("product-search");
  const searchButton = document.getElementById("search-button");
  const resultsContainer = document.getElementById("results-container");
  
  // Función para buscar productos
  function searchProducts() {
    // Obtener el valor del cuadro de búsqueda
    const query = searchInput.value.toLowerCase();
  
    // Filtrar productos por nombre o categoría
    const resultados = productos.filter(
      (producto) =>
        producto.nombre.toLowerCase().includes(query) ||
        producto.categoria.toLowerCase().includes(query)
    );
  
    // Mostrar resultados en la página
    displayResults(resultados);
  }
  
  // Función para mostrar los resultados en el DOM
  function displayResults(resultados) {
    // Limpiar resultados anteriores
    resultsContainer.innerHTML = "";
  
    if (resultados.length > 0) {
      resultados.forEach((producto) => {
        resultsContainer.innerHTML += producto.generarHTML();
      });
    } else {
      resultsContainer.innerHTML = "<p>No se encontraron productos.</p>";
    }
  }
  
  // Función para mostrar todos los productos al cargar la página
  function mostrarTodosLosProductos() {
    displayResults(productos);
  }
  
  // Asociar el botón de búsqueda con la función
  searchButton.addEventListener("click", searchProducts);
  
  // Permitir buscar al presionar "Enter"
  searchInput.addEventListener("keypress", (event) => {
    if (event.key === "Enter") {
      searchProducts();
    }
  });
  
  // Mostrar todos los productos al cargar la página
  window.addEventListener("load", mostrarTodosLosProductos);
  
// Elementos del DOM para notificaciones y carrito
const notificationContainer = document.createElement("div");
notificationContainer.id = "notification-container";
document.body.appendChild(notificationContainer);

const cartContainer = document.getElementById("cart-container");
const cartCount = document.getElementById("cart-count");
let carrito = []; // Array para almacenar los productos en el carrito

// Función para mostrar notificaciones
function mostrarNotificacion(mensaje, tipo = "info") {
  const notification = document.createElement("div");
  notification.className = `notification ${tipo}`;
  notification.textContent = mensaje;

  // Agregar la notificación al contenedor
  notificationContainer.appendChild(notification);

  // Eliminar la notificación automáticamente después de 3 segundos
  setTimeout(() => {
    notification.remove();
  }, 3000);
}

// Función para agregar un producto al carrito
function agregarAlCarrito(productoId) {
  const producto = productos.find((p) => p.id === productoId);

  if (producto) {
    carrito.push(producto);
    actualizarCarrito();
    mostrarNotificacion(
      `¡${producto.nombre} se agregó al carrito!`,
      "success"
    );
  } else {
    mostrarNotificacion("Error: Producto no encontrado.", "error");
  }
}

// Función para actualizar el estado del carrito en tiempo real
function actualizarCarrito() {
  cartCount.textContent = carrito.length;

  // Opcional: Mostrar productos en el carrito
  cartContainer.innerHTML = carrito
    .map(
      (producto) =>
        `<div class="cart-item">
          <p>${producto.nombre} - $${producto.precio.toFixed(2)}</p>
        </div>`
    )
    .join("");
}

// Mostrar una notificación promocional al cargar la página
window.addEventListener("load", () => {
  mostrarNotificacion(
    "¡Promoción especial! 20% de descuento en Electrónica hasta mañana.",
    "promo"
  );
});

// Función para asociar eventos "Agregar al carrito" a los productos
function habilitarBotonesCarrito() {
  const botonesAgregar = document.querySelectorAll(".add-to-cart");
  botonesAgregar.forEach((boton) => {
    boton.addEventListener("click", () => {
      const productoId = parseInt(boton.dataset.id);
      agregarAlCarrito(productoId);
    });
  });
}

// Modificar la función de mostrar productos para incluir botones "Agregar al carrito"
function displayResults(resultados) {
  // Limpiar resultados anteriores
  resultsContainer.innerHTML = "";

  if (resultados.length > 0) {
    resultados.forEach((producto) => {
      resultsContainer.innerHTML += `
        <div class="product">
          <h3>${producto.nombre}</h3>
          <p>Categoría: ${producto.categoria}</p>
          <p>Precio: $${producto.precio.toFixed(2)}</p>
          <button class="add-to-cart" data-id="${producto.id}">Agregar al carrito</button>
        </div>
      `;
    });
    // Habilitar los botones después de renderizar
    habilitarBotonesCarrito();
  } else {
    resultsContainer.innerHTML = "<p>No se encontraron productos.</p>";
  }
}

// Mostrar todos los productos al cargar la página
window.addEventListener("load", mostrarTodosLosProductos);











