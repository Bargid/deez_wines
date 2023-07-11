function openModal(nom, id) {
    var modal = document.getElementById("modal");
    var modalTitle = document.getElementById("modal-title");
    var form = document.getElementById("modal-form");
    var bouteilleIdInput = document.getElementById("bouteille-id");
    var quantityInput = document.getElementById("quantity");

    modalTitle.innerText = nom;
    bouteilleIdInput.value = id;
    quantityInput.value = 1;

    form.reset();

    modal.style.display = "block";
}

function closeModal() {
    var modal = document.getElementById("modal");
    var form = document.getElementById("modal-form");
    
    form.reset();

    modal.style.display = "none";
}

function decrementQuantity() {
    var quantityInput = document.getElementById("quantity");
    var currentQuantity = parseInt(quantityInput.value);

    if (currentQuantity > 1) {
        quantityInput.value = currentQuantity - 1;
    }
}

function incrementQuantity() {
    var quantityInput = document.getElementById("quantity");
    var currentQuantity = parseInt(quantityInput.value);

    quantityInput.value = currentQuantity + 1;
}

