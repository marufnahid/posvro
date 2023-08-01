
function successToast(message) {
    Toastify({
        text: message,
        duration: 2000,
        close: true,
        gravity: "top",
        position: "right",
        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
        stopOnFocus: true,
    }).showToast();
}

function errorToast(message) {
    Toastify({
        text: message,
        duration: 2000,
        close: true,
        gravity: "top",
        position: "right",
        backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
        stopOnFocus: true,
    }).showToast();
}
