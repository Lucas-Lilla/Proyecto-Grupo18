function mostrarVistaPrevia(event) {
    const input = event.target;
    const previewContainer = document.getElementById('fotoPerfilForm');
    previewContainer.innerHTML = '';

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.classList.add('imagen-previa');
            previewContainer.appendChild(img);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
