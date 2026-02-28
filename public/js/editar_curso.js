document.addEventListener('DOMContentLoaded', function() {
    const categoriaSelect = document.getElementById('categoria_id');
    const subcategoriaSelect = document.getElementById('subcategoria_id');
    
    // Guardar el valor actual de la subcategoría
    const currentSubcategoriaId = subcategoriaSelect.value;
    const currentSubcategoriaText = subcategoriaSelect.options[subcategoriaSelect.selectedIndex]?.text || '';
    
    if (typeof subcategoriasData !== 'undefined') {
        categoriaSelect.addEventListener('change', function() {
            const categoriaId = this.value;
            
            subcategoriaSelect.innerHTML = '<option value="">-- Selecciona una subcategoría --</option>';
            
            if (categoriaId) {
                // Filtrar subcategorías por categoría
                const subcategoriasFiltradas = subcategoriasData.filter(s => s.categoria_id == categoriaId);
                
                subcategoriasFiltradas.forEach(sub => {
                    const option = document.createElement('option');
                    option.value = sub.id;
                    option.textContent = sub.nombre;
                    
                    if (sub.id == currentSubcategoriaId) {
                        option.selected = true;
                    }
                    
                    subcategoriaSelect.appendChild(option);
                });
                
                subcategoriaSelect.disabled = false;
            } else {
                subcategoriaSelect.disabled = true;
            }
        });
    }
});