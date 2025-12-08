// ==================== FUNCIONES MODAL EDICIÓN (FETCH) ====================

function cargarFormularioEdicion(id) {
    const modal = document.getElementById("modalEditar");
    const contentContainer = document.getElementById("modal-body-content");
    
    // Muestra el botón de cierre y mensaje de carga inicial
    contentContainer.innerHTML = '<span class="close" onclick="cerrarModal()">&times;</span><h3>Cargando formulario...</h3>'; 
    modal.style.display = 'block';

    // Se usa la ruta que confirmó ser funcional
    fetch('../GRUD/editarAdmin.php?id=' + id) 
        .then(response => {
            if (!response.ok) {
              
                throw new Error('Error al cargar los datos. Código: ' + response.status);
            }
            return response.text();
        })
        .then(html => {
            // Inyecta el contenido HTML devuelto por el servidor
            contentContainer.innerHTML = html;
        })
        .catch(error => {
            // Manejo de errores de red o del servidor
            console.error('Fetch error:', error);
            contentContainer.innerHTML = '<span class="close" onclick="cerrarModal()">&times;</span><h3>Error</h3><p>No se pudo cargar el formulario. Revise la Consola.</p>';
        });
}

function cerrarModal() {
    document.getElementById("modalEditar").style.display = "none";
}

// ==================== FUNCIONES MODAL ELIMINAR ====================

function abrirModalEliminar(id, usuario) {
    document.getElementById("id_a_eliminar").value = id; 
    document.getElementById("mensaje-eliminar").innerHTML = 
        'Estás a punto de eliminar al administrador **' + usuario + '**. ¿Deseas continuar?';
    document.getElementById("modalEliminar").style.display = "block";
}

function cerrarModalEliminar() {
    document.getElementById("modalEliminar").style.display = "none";
}

// ==================== CIERRE GLOBAL AL HACER CLICK FUERA ====================

window.onclick = function(event) {
    var modalEditar = document.getElementById("modalEditar");
    var modalEliminar = document.getElementById("modalEliminar");
    
    // Cierra el modal de edición
    if (event.target == modalEditar) {
        cerrarModal(); 
    } 
    // Cierra el modal de eliminación
    else if (event.target == modalEliminar) {
        cerrarModalEliminar();
    }
}