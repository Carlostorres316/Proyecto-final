document.addEventListener('DOMContentLoaded', function() {
    const radios = document.querySelectorAll('input[name="tipo_precio"]');
    const precioContainer = document.getElementById('precioContainer');
    const precioInput = document.querySelector('input[name="precio"]');
    
    if (!radios.length || !precioContainer || !precioInput) return;
    
    function togglePrecioContainer() {
        const selectedRadio = document.querySelector('input[name="tipo_precio"]:checked');
        
        if (selectedRadio && selectedRadio.value === 'pago') {
            precioContainer.style.display = 'block';
            precioInput.required = true;  
        } else {
            precioContainer.style.display = 'none';
            precioInput.required = false; 
            precioInput.value = 0;
        }
    }
    
    togglePrecioContainer();
    
    radios.forEach(radio => {
        radio.addEventListener('change', togglePrecioContainer);
    });
});