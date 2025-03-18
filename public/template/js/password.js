document.addEventListener("DOMContentLoaded", function () {    
    document.querySelectorAll("form.password").forEach(function (form) {
        form.addEventListener("submit", function (event) {
            event.preventDefault();

            Swal.fire({
                title: "Confirme sua Senha",
                input: "password",
                inputPlaceholder: "Digite sua senha",
                inputAttributes: {
                    maxlength: "100",
                    autocapitalize: "off",
                    autocorrect: "off"
                },
                showCancelButton: true,
                confirmButtonText: "Confirmar",
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#72E128",
                inputValidator: (value) => {
                    if (!value) {
                        return "Você precisa informar sua senha!";
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    let passwordField = document.createElement("input");
                    passwordField.type = "hidden";
                    passwordField.name = "password";
                    passwordField.value = result.value;
                    form.appendChild(passwordField);
                    form.submit();
                }
            });
        });
    });
});