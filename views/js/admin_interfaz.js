// ==================== FUNCIONES MODAL EDICIÓN (FETCH) ====================

function cargarFormularioEdicion(id) {
    const modal = document.getElementById("modalEditar");
    const contentContainer = document.getElementById("modal-body-content");
    
    // Muestra el botón de cierre y mensaje de carga inicial
    contentContainer.innerHTML = '<span class="close" onclick="cerrarModal()">&times;</span><h3>Cargando formulario...</h3>'; 
    modal.style.display = 'block';

    fetch('../GRUD/Actualizar/editarAdmin.php?id=' + id) 
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

// ==================== VALIDACIÓN DE CONTRASEÑAS EN CREACIÓN ====================
function validarCreacion() {
    //console.log("Validación de creación iniciada.");
    // Obtener los valores de los campos 
    const pass = document.getElementById('crear_password').value;
    const passConfirm = document.getElementById('crear_password_confirm').value;

    // Realizar la comparación
    if (pass !== passConfirm) {
        // Mostrar un mensaje de error y bloquear el envío
        alert('ADVERTENCIA: Las contraseñas no coinciden. Por favor, revísalas.');
        
        // Limpiar los campos y poner el foco para corrección
        document.getElementById('crear_password').value = '';
        document.getElementById('crear_password_confirm').value = '';
        document.getElementById('crear_password').focus();

        return false;
    }
    return true;
}