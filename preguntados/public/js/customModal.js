function initializeCustomModal() {
    // Abrir el modal al hacer clic en el botón
    $('#openCustomExitModal').click(function (e) {
        e.preventDefault();
        $('#customExitModal').show();
    });

    // Cerrar el modal al hacer clic en el botón de cierre o en el botón de cancelar
    $('#closeCustomExitModal, #customCancelButton').click(function () {
        $('#customExitModal').hide();
    });
}

// Cuando el documento esté listo, inicializar el modal
$(document).ready(function () {
    initializeCustomModal();
});

function abrirModalAyuda() {
    document.getElementById('modalAyuda').style.display = 'flex';
}

function cerrarModalAyuda() {
    document.getElementById('modalAyuda').style.display = 'none';
}
function mostrarModalPregunta() {
    document.getElementById('modalPregunta').style.display = 'flex';
}

function cerrarModalPregunta() {
    document.getElementById('modalPregunta').style.display = 'none';
}




function abrirModalEditor() {
    document.getElementById('modalEditor').style.display = 'flex';
}

function cerrarModalEditor() {
    document.getElementById('modalEditor').style.display = 'none';
}

function abrirModalReporte() {
    document.getElementById('reportModal').style.display = 'block';
}

function cerrarModalReporte() {
    document.getElementById('reportModal').style.display = 'none';
}