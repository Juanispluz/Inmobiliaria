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

