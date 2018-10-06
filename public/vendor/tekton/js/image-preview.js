$('.tekton-image-upload').each((index, imageUpload) => {
    imageUpload.change((e) => {
        let img = $(imageUpload.dataset.target)[0];
        let container = $(imageUpload.dataset.container)[0];

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