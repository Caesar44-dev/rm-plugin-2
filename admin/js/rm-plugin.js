function openModalCreate(modalId) {
    var modal = document.getElementById(modalId);
    var bsModal = new bootstrap.Modal(modal);
    bsModal.show();
}

function openModalDelete(modalId, id, rmid, buscar, sustituir) {
    var modal = document.getElementById(modalId);
    var idInput = modal.querySelector('input[name="id"]');
    var idInput2 = modal.querySelector('input[name="rmid"]');
    var idInput3 = modal.querySelector('input[name="buscar"]');
    var idInput4 = modal.querySelector('input[name="sustituir"]');
    idInput.value = id;
    idInput2.value = rmid;
    idInput3.value = buscar;
    idInput4.value = sustituir;
    var bsModal = new bootstrap.Modal(modal);
    bsModal.show();
}