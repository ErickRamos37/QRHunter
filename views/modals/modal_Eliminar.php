<div id="modalEliminar" class="modal">
    <div class="modal-content" style="max-width: 400px;">
        <span class="close" onclick="cerrarModalEliminar()">&times;</span>

        <h3>Confirmar Eliminación</h3>

        <p id="mensaje-eliminar">¿Estás seguro de que quieres eliminar este administrador?</p>

        <form id="formEliminar" action="../GRUD/Eliminar/eliminarAdmin.php" method="POST">
            <input type="hidden" name="id_a_eliminar" id="id_a_eliminar">

            <button type="submit" class="buttonEliminar">Sí, Eliminar Permanentemente</button>
            <button type="button" class="buttonNormal" onclick="cerrarModalEliminar()">Cancelar</button>
        </form>
    </div>
</div>