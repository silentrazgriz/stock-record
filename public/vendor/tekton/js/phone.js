$('.tekton-phone').each((index, phone) => {
    cleaves.push(new Cleave(phone, {
        phone: true
    }));

    phone.focus((e) => {
        if (phone.value.length === 0 || phone.value[0] !== '+') {
            phone.value = '+62';
        }
    });
});