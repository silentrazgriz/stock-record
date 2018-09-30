let tektonImageUploads = Sizzle('.tekton-image-upload');
Array.prototype.filter.call(tektonImageUploads, (imageUpload) => {
    imageUpload.addEventListener('change', (e) => {
        let img = Sizzle(imageUpload.dataset.target)[0];
        let container = Sizzle(imageUpload.dataset.container)[0];

        let reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
        };
        reader.readAsDataURL(imageUpload.files[0]);

        if (!container.classList.contains('tekton-show-preview')) {
            container.classList.add('tekton-show-preview');
        }
    });
});