/**
 * contact.js
 * Handles client-side validation and AJAX submission for the contact form.
 */

document.addEventListener("DOMContentLoaded", function () {
    const contactForm = document.getElementById("contactForm");
    const feedbackMessageDiv = document.getElementById("contactFormMessage");
    const submitButton = document.getElementById("contactSubmitBtn");

    if (!contactForm) return;

    contactForm.addEventListener("submit", function (e) {
        e.preventDefault();

        // Clear any previous feedback
        feedbackMessageDiv.innerHTML = "";

        // Run native browser validation + Bootstrap classes
        if (!contactForm.checkValidity()) {
            contactForm.classList.add("was-validated");
            return;
        }

        contactForm.classList.add("was-validated");

        // Show loading state
        const originalButtonLabel = submitButton.textContent;
        submitButton.disabled = true;
        submitButton.textContent = "Sending...";

        const formData = new FormData(contactForm);

        fetch("../backend/saveMessage.php", {
            method: "POST",
            body: formData
        })
        .then(function (response) {
            if (!response.ok) {
                throw new Error("Server responded with status " + response.status);
            }
            return response.json();
        })
        .then(function (responseData) {
            if (responseData.success) {
                feedbackMessageDiv.innerHTML = `<div class="alert alert-success mt-3">${responseData.message}</div>`;
                contactForm.reset();
                contactForm.classList.remove("was-validated");
            } else {
                feedbackMessageDiv.innerHTML = `<div class="alert alert-danger mt-3">${responseData.message}</div>`;
            }
        })
        .catch(function (networkError) {
            feedbackMessageDiv.innerHTML = '<div class="alert alert-danger mt-3">Server error. Please try again later.</div>';
            console.error("Contact form submission error:", networkError);
        })
        .finally(function () {
            submitButton.disabled = false;
            submitButton.textContent = originalButtonLabel;
        });
    });
});