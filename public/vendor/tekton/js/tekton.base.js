// Validation
let cleaves = [];

$('.needs-validation').submit((event) => {
    $('.needs-validation').each((index, form) => {
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            cleaves.forEach((item) => {
                item.element.value = item.getRawValue();
            });
        }
        form.classList.add('was-validated');
    });
});