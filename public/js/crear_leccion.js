document.addEventListener('DOMContentLoaded', function() {
    const tipoSelect = document.getElementById('tipoSelect');
    const contenidoDiv = document.getElementById('contenidoDiv');
    const videoDiv = document.getElementById('videoDiv');
    
    if (tipoSelect) {
        // Función para actualizar la visibilidad
        function actualizarCampos() {
            const tipo = tipoSelect.value;
            
            if (tipo === 'video') {
                contenidoDiv.classList.add('d-none');
                videoDiv.classList.remove('d-none');
                document.querySelector('[name="contenido"]').required = false;
            } else {
                contenidoDiv.classList.remove('d-none');
                videoDiv.classList.add('d-none');

                if (tipo === 'material' || tipo === 'pregunta') {
                    document.querySelector('[name="contenido"]').required = true;
                }
            }
        }
        
        actualizarCampos();
        
        tipoSelect.addEventListener('change', actualizarCampos);
    }
});