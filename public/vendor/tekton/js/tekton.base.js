// Validation
let cleaves = [];

let forms = Sizzle('.needs-validation');
forms.forEach((form) => {
    form.addEventListener('submit', (event) => {
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