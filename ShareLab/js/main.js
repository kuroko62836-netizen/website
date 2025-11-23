// Smooth button animations
document.querySelectorAll("button").forEach(btn => {
    btn.addEventListener("mousedown", () => btn.style.transform = "scale(0.95)");
    btn.addEventListener("mouseup", () => btn.style.transform = "scale(1)");
});
