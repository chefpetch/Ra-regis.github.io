function readURL(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
document.querySelector('#blah').setAttribute('src',e.target.result )
        
        };

        reader.readAsDataURL(input.files[0]);
    }
}