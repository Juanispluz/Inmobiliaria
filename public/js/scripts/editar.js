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