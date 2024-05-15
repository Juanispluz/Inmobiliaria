// Login - register
// Mostrar la contraseña
function togglePasswordVisibility(inputId) {
    var passwordInput = document.getElementById(inputId);
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}

// register
// Mostrar universidades
function toggleUniversidad() {
    var checkbox = document.getElementById('es_universitario');
    var select = document.getElementById('select_universidad');
    select.style.display = checkbox.checked ? 'block' : 'none';
}

// Mostrar el correo de confirmación
function toggleEmailVisibility() {
    var emailInput = document.getElementById('correo');
    if (emailInput.type === "email") {
        emailInput.type = "text";
    } else {
        emailInput.type = "email";
    }
}