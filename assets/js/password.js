document.addEventListener('DOMContentLoaded', function() {

    const checkbox = document.getElementById('showPassword');
    const passwordField = document.getElementById('form-password'); 
    checkbox.addEventListener('change', function() {
        if (this.checked) {
            passwordField.type = 'text';
        } else {
            passwordField.type = 'password';
        }
    });
});
