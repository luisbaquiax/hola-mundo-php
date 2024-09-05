const cantidadInput = document.getElementById('cantidad');
const totalPagar = document.getElementById('totalPagar');
const  precio = document.getElementById('precioProducto').value;

cantidadInput.addEventListener('input', function () {
    const cantidad = parseInt(cantidadInput.value);
    const total = cantidad * parseInt(precio);
    totalPagar.textContent = 'Q.' + total.toFixed(2);
});