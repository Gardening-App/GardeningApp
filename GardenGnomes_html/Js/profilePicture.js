(function (window, document, undefined) {

    // code that should be taken care of right away

    window.onload = init;

    function init() {
        // the code to be called when the dom has loaded
        // #document has its nodes

        const form = document.getElementById("uploadPicture");
        const input = document.getElementById("changePicture");
        const choose = document.getElementById("chooseFile");
        const upload = document.getElementById("upload");

        console.log(input);

        input.addEventListener("click", updatePicture);
        
        choose.addEventListener("click", updateUpload);

        function updatePicture(e) {
            input.style.opacity = "0.0";
            form.style.display = "block"
        }

        function updateUpload(e) {
            upload.style.display = "inherit";
        }
    }

})(window, document, undefined);