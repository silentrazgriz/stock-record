let tektonPhones = Sizzle('.tekton-phone');
tektonPhones.forEach((phone) => {
    cleaves.push(new Cleave(phone, {
        phone: true
    }));

    phone.addEventListener('focus', (e) => {
        if (phone.value.length === 0 || phone.value[0] !== '+') {
            phone.value = '+62';
        }
    });
});