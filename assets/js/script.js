document.addEventListener('DOMContentLoaded', function () {
    const formularios = document.querySelectorAll('[data-confirmar]');
    formularios.forEach(function (formulario) {
        formulario.addEventListener('submit', function (evento) {
            const mensagem = formulario.getAttribute('data-confirmar');
            if (!confirm(mensagem)) {
                evento.preventDefault();
            }
        });
    });
});
