import './bootstrap';
import Alpine from 'alpinejs';

document.addEventListener("DOMContentLoaded", () => {
  const langBtn = document.getElementById("langBtn");
  const langMenu = document.getElementById("langMenu");
  const langIcon = document.getElementById("langIcon");

  // Check if elements exist before adding event listeners
  if (langBtn && langMenu && langIcon) {
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
  }
});

window.Alpine = Alpine;

Alpine.data('companyForm', () => ({
    logo: null,
    name: '',
    brandName: '',
    brandEdited: false, // cek apakah brand sudah diubah manual
    employees: '',
    industry: '',
    province: '',
    city: '',
    address: '',

    init() {
        this.$watch('name', (val) => {
            if (!this.brandEdited) {
                this.brandName = val;
            }
        });
    },

    isValid() {
        return this.name.trim() !== '' &&
               this.employees.trim() !== '' &&
               this.industry.trim() !== '' &&
               this.province.trim() !== '' &&
               this.city.trim() !== '' &&
               this.address.trim() !== '';
    }
}));

Alpine.start();
