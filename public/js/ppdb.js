document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("submitForm");
    if (!form) return;

    form.addEventListener("submit", () => {
        document.getElementById("loader").classList.remove("hidden");
        document.getElementById("text").textContent = "Mengirim...";
    });
});
