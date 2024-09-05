document.addEventListener('DOMContentLoaded', () => {
    // Obtiene los botones
    const toggleButtons = document.querySelectorAll('.show-btn');

    toggleButtons.forEach(button => {
        button.addEventListener('click', () => {
            // obtiene el indice del boton seleccionado
            const index = button.getAttribute('data-index');
            const tableContainer = document.getElementById('tableContainer' + index);

            if (tableContainer.style.display === 'none' || tableContainer.style.display === '') {
                tableContainer.style.display = 'block';
                button.textContent = 'Ocultar detalle';
            } else {
                tableContainer.style.display = 'none';
                button.textContent = 'Ver detalle';
            }
        });
    });
});