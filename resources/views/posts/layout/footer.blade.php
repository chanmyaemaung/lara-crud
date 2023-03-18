<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'CL Web Innovatioins'
    });

    function imagePreview() {
        const image = document.getElementById('image');
        const previewImageContainer = document.getElementById('previewImageContainer');

        image.addEventListener('change', function() {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                previewImageContainer.style.display = "block";

                reader.addEventListener('load', function() {
                    const image = new Image();
                    image.src = this.result;
                    image.className = "img-thumbnail";
                    image.style.width = "150px";
                    previewImageContainer.innerHTML = "";
                    previewImageContainer.appendChild(image);
                });

                reader.readAsDataURL(file);
            }

        });
    }

    imagePreview();
</script>

</body>

</html>
