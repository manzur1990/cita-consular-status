function printTable() {
    document.querySelector('.navbar').style.display = 'none';
    document.querySelector('.col-md-6').style.display = 'none';

    window.print();

    document.querySelector('.navbar').style.display = 'block';
    document.querySelector('.col-md-6').style.display = 'block';
}

function validateForm() {
    var identidadInput = document.getElementById('identidad');
    var identidadValue = identidadInput.value.trim();

    // Remove non-numeric characters
    identidadValue = identidadValue.replace(/\D/g, '');
    identidadInput.value = identidadValue;

    // Validate length
    if (identidadValue.length !== 13) {
        identidadInput.classList.add('is-invalid');
        return false;
    }

    identidadInput.classList.remove('is-invalid');
    return true;
}

// Allow only numeric input (including 10-key number pad) and limit to 12 characters
document
    .getElementById('identidad')
    .addEventListener('keydown', function (event) {
        var allowedKeys = [8, 9, 37, 39, 46]; // Backspace, Tab, Left Arrow, Right Arrow, Delete

        // Allow numeric keys from 10-key number pad
        var numberPadKeys = [96, 97, 98, 99, 100, 101, 102, 103, 104, 105];
        allowedKeys = allowedKeys.concat(numberPadKeys);

        if (event.altKey || event.metaKey) {
            return; // Allow keyboard shortcuts
        }

        if (allowedKeys.indexOf(event.keyCode) !== -1) {
            return; // Allow navigation and deletion keys
        }

        if (event.keyCode < 48 || event.keyCode > 57) {
            event.preventDefault(); // Prevent input of non-numeric characters
        }

        var identidadInput = document.getElementById('identidad');
        var identidadValue = identidadInput.value.trim();

        // Limit to 13 characters
        if (identidadValue.length >= 13) {
            event.preventDefault();
        }
    });

// Prevent pasting non-numeric characters
document
    .getElementById('identidad')
    .addEventListener('input', function (event) {
        var identidadInput = event.target;
        var identidadValue = identidadInput.value.trim();
        identidadValue = identidadValue.replace(/\D/g, '');
        identidadInput.value = identidadValue;

        // Limit to 13 characters
        if (identidadValue.length > 13) {
            identidadInput.value = identidadValue.slice(0, 13);
        }
    });
