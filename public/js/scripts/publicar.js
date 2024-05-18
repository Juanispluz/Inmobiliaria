// Dejar subir varias imagenes y mostralas
document.getElementById('imagenes').addEventListener('change', handleFileSelect);

function handleFileSelect(event) {
    var files = event.target.files;
    var preview = document.getElementById('preview');
    preview.innerHTML = '';
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();
        reader.onload = function(event) {
            var img = document.createElement('img');
            img.src = event.target.result;
            img.style.maxWidth = '200px';
            img.style.maxHeight = '200px';
            preview.appendChild(img);
        };
        reader.readAsDataURL(file);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.service-button');
    buttons.forEach(button => {
        button.addEventListener('click', function (event) {
            toggleService(button.dataset.serviceName, button);
        });
    });
});

function toggleService(serviceName, button) {
    event.preventDefault();

    const input = document.getElementById(serviceName);
    const isChecked = input.checked;

    input.checked = !isChecked;

    if (isChecked) {
        button.classList.remove('btn-primary');
        button.classList.add('btn-outline-primary');
    } else {
        button.classList.remove('btn-outline-primary');
        button.classList.add('btn-primary');
    }
}
