const menuBtn = document.getElementById('menuBtn');
const sidebar = document.getElementById('mySidebar');
const overlay = document.getElementById('overlay');
const dropdowns = document.getElementsByClassName('dropdown-btn');
const cursor = document.querySelector(".cursor");

// Open sidebar
function openSidebar() {
    sidebar.classList.add('open');
    sidebar.setAttribute('aria-hidden', 'false');
    overlay.classList.add('show');
}

// Close sidebar
function closeSidebar() {
    sidebar.classList.remove('open');
    sidebar.setAttribute('aria-hidden', 'true');
    overlay.classList.remove('show');
}

// Toggle sidebar
menuBtn.addEventListener('click', () => {
    sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
});

// Close when clicking overlay
overlay.addEventListener('click', closeSidebar);

// Dropdown logic
Array.from(dropdowns).forEach(btn => {
    btn.addEventListener('click', () => {
        const cont = btn.nextElementSibling;
        const arrow = btn.querySelector('.arrow');
        if (!cont) return;

        const isOpen = cont.style.display === 'block';
        cont.style.display = isOpen ? 'none' : 'block';
        arrow.textContent = isOpen ? '▼' : '▲';
    });
});

// Close sidebar with ESC
document.addEventListener('keydown', e => {
    if (e.key === 'Escape' && sidebar.classList.contains('open')) closeSidebar();
});

// Follow mouse
document.addEventListener("mousemove", (e) => {
    cursor.style.top = e.clientY + "px";
    cursor.style.left = e.clientX + "px";
});

// Grow when hovering clickable items
document.querySelectorAll("a, button, .dropdown-btn").forEach(el => {
    el.addEventListener("mouseenter", () => {
        cursor.style.width = "45px";
        cursor.style.height = "45px";
        cursor.style.borderColor = "#00a6ffff";
    });

    el.addEventListener("mouseleave", () => {
        cursor.style.width = "30px";
        cursor.style.height = "30px";
        cursor.style.borderColor = "#00a6ffff";
    });
});
