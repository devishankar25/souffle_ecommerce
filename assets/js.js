document.addEventListener("DOMContentLoaded", function () {
    console.log("JavaScript Loaded");

    // Form validation for login and signup pages
    function validateForm(event, formId) {
        event.preventDefault(); // Prevent form submission
        let form = document.getElementById(formId);
        let inputs = form.querySelectorAll("input[required]");
        let isValid = true;

        inputs.forEach(input => {
            if (input.value.trim() === "") {
                isValid = false;
                input.classList.add("is-invalid");
            } else {
                input.classList.remove("is-invalid");
            }
        });

        if (isValid) {
            form.submit();
        }
    }

    // Attach validation to forms
    let loginForm = document.getElementById("loginForm");
    let signupForm = document.getElementById("signupForm");
    let adminLoginForm = document.getElementById("adminLoginForm");

    if (loginForm) {
        loginForm.addEventListener("submit", (event) => validateForm(event, "loginForm"));
    }
    if (signupForm) {
        signupForm.addEventListener("submit", (event) => validateForm(event, "signupForm"));
    }
    if (adminLoginForm) {
        adminLoginForm.addEventListener("submit", (event) => validateForm(event, "adminLoginForm"));
    }

    // Confirmation before deleting a product, user, or order
    let deleteButtons = document.querySelectorAll(".delete-btn");
    deleteButtons.forEach(button => {
        button.addEventListener("click", function (event) {
            if (!confirm("Are you sure you want to delete this item?")) {
                event.preventDefault();
            }
        });
    });

    // Smooth scrolling for navigation links
    document.querySelectorAll("a[href^='#']").forEach(anchor => {
        anchor.addEventListener("click", function (event) {
            event.preventDefault();
            let target = document.querySelector(this.getAttribute("href"));
            if (target) {
                target.scrollIntoView({ behavior: "smooth" });
            }
        });
    });
});
