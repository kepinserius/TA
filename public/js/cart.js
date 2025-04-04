function updateTotalPrice() {
    let total = 0;
    document.querySelectorAll(".product").forEach(product => {
        let checkbox = product.querySelector(".product-checkbox");
        if (checkbox.checked) {
            let quantity = parseInt(product.querySelector(".quantity").textContent);
            let price = parseInt(product.querySelector(".item-price").getAttribute("data-price"));
            total += quantity * price;
        }
    });
    document.getElementById("total-price").textContent = `Rp${total.toLocaleString()}`;
}

function checkIfEmpty() {
    if (document.querySelectorAll(".product").length === 0) {
        document.getElementById("checkAll").checked = false;
        document.getElementById("total-price").textContent = "Rp0";
    }
}

document.getElementById("checkAll").addEventListener("change", function () {
    let checkboxes = document.querySelectorAll(".product-checkbox");
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
    updateTotalPrice();
});

document.querySelectorAll(".product-checkbox").forEach(checkbox => {
    checkbox.addEventListener("change", updateTotalPrice);
});

document.getElementById("hapusSemua").addEventListener("click", function () {
    document.getElementById("product-list").innerHTML = "";
    checkIfEmpty();
});

updateTotalPrice();

document.querySelectorAll(".increase").forEach((button, index) => {
    button.addEventListener("click", function () {
        let product = button.closest(".product");
        let quantityElement = product.querySelector(".quantity");
        let quantity = parseInt(quantityElement.textContent);
        let dataId = this.getAttribute('data-id')
        console.log(dataId)
        quantity++;
        $.ajax({
            url: `/cart/${dataId}`,
            type: 'PUT',
            dataType: 'json',
            cache: false,
            data: {
                'qty': quantity,
                '_token': "{{csrf_token()}}"
            },
        })
        quantityElement.textContent = quantity;
        updateTotalPrice();
        });
    });
// Saat halaman dimuat, checklist otomatis produk yang jumlahnya 1 atau lebih
document.addEventListener("DOMContentLoaded", function () {
document.querySelectorAll(".product").forEach(product => {
let quantity = parseInt(product.querySelector(".quantity").textContent);
let checkbox = product.querySelector(".product-checkbox");

if (quantity >= 1) {
    checkbox.checked = true;
}
});

updateTotalPrice(); // Perbarui total harga setelah checkbox diatur
});