import './bootstrap';

document.addEventListener("DOMContentLoaded", () => {
  const langBtn = document.getElementById("langBtn");
  const langMenu = document.getElementById("langMenu");
  const langIcon = document.getElementById("langIcon");

  langBtn.addEventListener("click", () => {
    langMenu.classList.toggle("hidden");
    langIcon.classList.toggle("fa-chevron-down");
    langIcon.classList.toggle("fa-chevron-up");
  });

  // klik luar → tutup dropdown
  document.addEventListener("click", (e) => {
    if (!langBtn.contains(e.target) && !langMenu.contains(e.target)) {
      langMenu.classList.add("hidden");
      langIcon.classList.remove("fa-chevron-up");
      langIcon.classList.add("fa-chevron-down");
    }
  });
});
