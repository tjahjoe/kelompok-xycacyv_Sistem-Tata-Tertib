const eventTogglePassword = () => {
  const togglePassword = document.querySelector(".toggle-password-icon");
  const passwordInput = document.getElementById("password");

  if (togglePassword && passwordInput) {
    togglePassword.addEventListener("click", () => {
      const isPasswordVisible = passwordInput.getAttribute("type") === "text";
      passwordInput.setAttribute("type", isPasswordVisible ? "password" : "text");
      togglePassword.classList.toggle("fa-eye", isPasswordVisible);
      togglePassword.classList.toggle("fa-eye-slash", !isPasswordVisible);
    });
  }
}

const eventNavbarScroll = () => {
  const navbar = document.getElementById("navbar");
  const hamburger = document.getElementById('hamburger');
  const menu = document.getElementById("menu");

 
  if (navbar) {
    let lastScrollTop = 0;

    window.addEventListener("scroll", () => {
      const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
      navbar.classList.toggle("hidden", scrollTop > lastScrollTop);
      navbar.classList.toggle("scrolled", scrollTop > 0);
      lastScrollTop = Math.max(0, scrollTop);
    });
  }

  if (hamburger && menu) {
    const toggleMenu = () => {
      if (menu.classList.contains("active")) {
        setTimeout(() => {
          menu.classList.remove("active");
        }, 10);
      } else {
        menu.style.display = "flex";
        setTimeout(() => {
          menu.classList.add("active");
        }, 10); 
      }
    };

    const checkWindowSize = () => {
      if (window.innerWidth <= 768) {
        hamburger.addEventListener("click", toggleMenu);
      } else {
        hamburger.removeEventListener("click", toggleMenu);
      }
    };

    checkWindowSize();
    window.addEventListener("resize", checkWindowSize);
  }
}

const switchTab = () => {
  const tabLink = document.querySelectorAll('.tab-link');
  const tabContent = document.querySelectorAll('.tab-content');

  if (tabLink && tabContent) {
    tabLink.forEach(link => {
      link.addEventListener('click', function(event) {
        event.preventDefault();
        // delete semua class active pada class tab-link
        tabLink.forEach(tab => tab.classList.remove('active'));
        // delete semua class active pada class tab-content
        tabContent.forEach(content => content.classList.remove('active'));
        // menambahkan class active pada elemen yang di klik
        this.classList.add('active');
        // menemukan bagian konten tab yang sesuai dengan atribut href dari link yang diklik dan menambahkan kelas active
        document.querySelector(this.getAttribute('href')).classList.add('active');
      });
    });
  }
}

const updateBadge = () => {
  const badges = document.querySelectorAll('.badge-contain .badge');

  badges.forEach(badge => {

    badge.addEventListener("click", () => {
       // Reset semua badge ke badge-gray terlebih dahulu
       badges.forEach(b => {
        b.classList.remove("badge-green");
        b.classList.add("badge-gray");
      });

      // Hanya tambahkan badge-green ke badge yang diklik
      badge.classList.remove("badge-gray");
      badge.classList.add("badge-green");
    })
  });
}

const showAlert = () => {
  const alertOverlay = document.querySelector('.overlay');

  alertOverlay.classList.add('alert-active');
}

const closeAlert = () => {
  const alertOverlay = document.querySelector('.overlay');

  alertOverlay.classList.remove('alert-active');
}

document.getElementById('form-pelaporan').addEventListener('submit', (e) => {
  e.preventDefault();

  showAlert();
});

document.querySelector('.overlay').addEventListener('click', closeAlert);
document.querySelector('.alert-close-button').addEventListener('click', closeAlert);

const uploadFile = () => {
  const fileInput = document.getElementById('lampiran');
  const fileCountDisplay = document.getElementById('file-count');
  const fileListDisplay = document.getElementById('file-list');

  fileInput.addEventListener('change', () => {
    const files = fileInput.files;
    fileCountDisplay.textContent = `${files.length} file(s) uploaded`;

    // Clear the existing list
    fileListDisplay.innerHTML = '';

    // Loop through each file and add it to the list
    for (let i = 0; i < files.length; i++) {
      const listItem = document.createElement('li');
      listItem.textContent = files[i].name;
      fileListDisplay.appendChild(listItem);
    }
  });
}

document.addEventListener("DOMContentLoaded", () => {
  eventTogglePassword();
  eventNavbarScroll();
  switchTab();
  updateBadge();
  uploadFile()
});
