document.addEventListener("DOMContentLoaded", function() {
    // Función para mostrar el modal
    function showModal() {
        var modal = document.getElementById("modalVerPartidas");
        modal.style.display = "block";
    }

    // Función para cerrar el modal
    function closeModal() {
        var modal = document.getElementById("modalVerPartidas");
        modal.style.display = "none";
    }

    // Obtener el botón y agregar evento de clic para mostrar el modal
    var btnVerPartidas = document.getElementById("btnVerPartidas");
    btnVerPartidas.addEventListener("click", showModal);

    // Obtener el botón de cerrar y agregar evento de clic para cerrar el modal
    var closeButton = document.getElementsByClassName("close")[0];
    closeButton.addEventListener("click", closeModal);

    // También cerrar el modal si se hace clic fuera de él
    window.addEventListener("click", function(event) {
        var modal = document.getElementById("modalVerPartidas");
        if (event.target === modal) {
            closeModal();
        }
    });
});


