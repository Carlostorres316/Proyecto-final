document.getElementById('categoria_id').addEventListener('change', function() {
    const categoriaId = this.value;
    const subcategoriaSelect = document.getElementById('subcategoria_id');
    
    subcategoriaSelect.innerHTML = '<option value="">-- Selecciona una subcategoría --</option>';
    
    if (categoriaId) {
        const subcategoriasFiltradas = subcategoriasData.filter(s => s.categoria_id == categoriaId);
        
        subcategoriasFiltradas.forEach(sub => {
            const option = document.createElement('option');
            option.value = sub.id;
            option.textContent = sub.nombre;
            subcategoriaSelect.appendChild(option);
        });
        
        subcategoriaSelect.disabled = false;
    } else {
        subcategoriaSelect.disabled = true;
    }
});