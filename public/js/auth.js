document.addEventListener("DOMContentLoaded", function () {
    // Toggle untuk password input
    const togglePassword = document.querySelector("#togglePassword");
    const passwordInput = document.querySelector("#passwordInput");

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener("click", function () {
            // Cek tipe saat ini (password atau text)
            const type =
                passwordInput.getAttribute("type") === "password"
                    ? "text"
                    : "password";

            passwordInput.setAttribute("type", type);

            this.style.opacity = type === "text" ? "0.5" : "1";
        });
    }

    // Toggle untuk confirm password input (register page)
    const toggleConfirmPassword = document.querySelector(
        "#toggleConfirmPassword",
    );
    const confirmPasswordInput = document.querySelector(
        "#confirmPasswordInput",
    );

    if (toggleConfirmPassword && confirmPasswordInput) {
        toggleConfirmPassword.addEventListener("click", function () {
            const type =
                confirmPasswordInput.getAttribute("type") === "password"
                    ? "text"
                    : "password";

            confirmPasswordInput.setAttribute("type", type);

            this.style.opacity = type === "text" ? "0.5" : "1";
        });
    }
});
