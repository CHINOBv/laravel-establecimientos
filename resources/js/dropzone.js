import axios from "axios";

document.addEventListener("DOMContentLoaded", () => {
    if (document.querySelector("#dropzone")) {
        Dropzone.autoDiscover = false;
        const dropzone = new Dropzone("div#dropzone", {
            url: "/imagenes/store",
            dictDefaultMessage: "Sube hasta 10 imagenes",
            maxFiles: 10,
            required: true,
            acceptedFiles: ".png,.jpg,.gif,.jpeg,.bmp",
            addRemoveLinks: true,
            dictRemoveFile: "Eliminar Imagen",
            headers: {
                "X-CSRF-TOKEN": document.querySelector("meta[name=csrf-token]")
                    .content
            },
            success: (file, res) => {
                file.nombreServe = res.archivo;
            },
            removedfile: (file, res) => {
                const params = {
                    imagen: file.nombreServe
                };
                axios.post("/imagenes/destroy", params).then(res => {
                    console.log(res);
                    file.previewElement.parentNode.removeChild(
                        file.previewElement
                    );
                });
            },
            sending: (file, xhr, formData) => {
                formData.append("uuid", document.querySelector("#uuid").value);
            }
        });
    }
    if (document.querySelector("button.dz-button")) {
        let btnDz = document.querySelector("button.dz-button");
        btnDz.classList.add("form-control");
    }
});
