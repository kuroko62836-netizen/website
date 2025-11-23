// Small animation on input focus
document.querySelectorAll("input").forEach(input => {
    input.addEventListener("focus", () => {
        input.style.background = "rgba(255,255,255,0.55)";
    });

    input.addEventListener("blur", () => {
        input.style.background = "rgba(255,255,255,0.4)";
    });
});
