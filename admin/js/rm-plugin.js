function openModalCreate(modalId) {
    var modal = document.getElementById(modalId);
    var bsModal = new bootstrap.Modal(modal);
    bsModal.show();
}

function openModalUpdate(modalId, id, buscar, sustituir) {
    var modal = document.getElementById(modalId);
    var idInput = modal.querySelector('input[name="id"]');
    var idInput2 = modal.querySelector('input[name="buscar"]');
    var idInput3 = modal.querySelector('input[name="sustituir"]');
    idInput.value = id;
    idInput2.value = buscar;
    idInput3.value = sustituir;
    var bsModal = new bootstrap.Modal(modal);
    bsModal.show();
}

function openModalDelete(modalId, id, buscar, sustituir) {
    var modal = document.getElementById(modalId);
    var idInput = modal.querySelector('input[name="id"]');
    var idInput2 = modal.querySelector('input[name="buscar"]');
    var idInput3 = modal.querySelector('input[name="sustituir"]');
    idInput.value = id;
    idInput2.value = buscar;
    idInput3.value = sustituir;
    var bsModal = new bootstrap.Modal(modal);
    bsModal.show();
}