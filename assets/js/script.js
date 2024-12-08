// UNTUK SHOW PASSWORD
const eventTogglePassword = () => {
  const togglePassword = document.querySelector(".toggle-password-icon");
  const passwordInput = document.getElementById("password");

  if (togglePassword && passwordInput) {
    togglePassword.addEventListener("click", () => {
      const isPasswordVisible = passwordInput.getAttribute("type") === "text";
      passwordInput.setAttribute(
        "type",
        isPasswordVisible ? "password" : "text"
      );
      togglePassword.classList.toggle("fa-eye", isPasswordVisible);
      togglePassword.classList.toggle("fa-eye-slash", !isPasswordVisible);
    });
  }
};

// UNTUK NAVBAR KETIKA DISCROLL
const eventNavbarScroll = () => {
  const navbar = document.getElementById("navbar");

  if (navbar) {
    let lastScrollTop = 0;

    window.addEventListener("scroll", () => {
      const scrollTop = window.scrollY; // untuk mendapatkan jarak scroll vertikal dari bagian atas halaman.
      navbar.classList.toggle("hidden", scrollTop > lastScrollTop); //jika user scroll
      navbar.classList.toggle("scrolled", scrollTop > 0); // jika user sudah mulai scroll
      lastScrollTop = scrollTop;
    });
  }
};

// UNTUK MENAMPILKAN MENU PADA SAAT DIKLIK
const toggleNavigationMenu = () => {
  const hamburger = document.getElementById("hamburger");
  const menu = document.getElementById("menu");

  if (hamburger && menu) {
    const toggleMenu = () => {
      if (menu.classList.contains("active")) {
        menu.classList.remove("active");
      } else {
        menu.style.display = "flex";
        menu.classList.add("active");
      }
    };

    hamburger.addEventListener("click", toggleMenu);
  }
};

// UNTUK SWITCH TAB SIDEBAR
const switchTab = () => {
  const tabLink = document.querySelectorAll(".tab-link");
  const logoutBtn = document.querySelector(".logout-btn");
  const tabContent = document.querySelectorAll(".tab-content");
  const profileForm = document.getElementById("edit-profile");

  if (tabLink && tabContent && logoutBtn && profileForm) {
    tabLink.forEach((link) => {
      link.addEventListener("click", function (event) {
        if (this === logoutBtn) {
          return;
        }

        profileForm.classList.remove("active");
        event.preventDefault();
        // reset semua tablink/tab content agar tidak memiliki class active
        tabLink.forEach((tab) => tab.classList.remove("active"));
        tabContent.forEach((content) => content.classList.remove("active"));
        this.classList.add("active"); // tab link diberi class active

        // menambahkan class active pada id tab contentnya
        document
          .querySelector(this.getAttribute("href"))
          .classList.add("active");
      });
    });
  }
};

// UNTUK SWITCH TAB SUB MENU 
const switchTabSubMenu = () => {
  const tabSubMenu = document.querySelectorAll(".tab-sublink");
  const tabSubContent = document.querySelectorAll(".tab-subcontent");

  if (tabSubMenu) {
    tabSubMenu.forEach((link) => {
      link.addEventListener("click", function (event) {
        event.preventDefault();

        // reset semua tab sublink/tab subcontent agar tidak memiliki class active
        tabSubMenu.forEach((tab) => tab.classList.remove("active"));
        tabSubContent.forEach((content) => content.classList.remove("active"));

        this.classList.add("active");// tab sublink diberi class active

        // menambahkan class active pada id tab subcontentnya
        document
          .querySelector(this.getAttribute("href"))
          .classList.add("active");
      });
    });
  }
};

const updateBadge = () => {
  const getBadgeClass = (forValue) => {
    switch (forValue) {
      case "status-pending":
        return "badge-orange";
      case "status-completed":
        return "badge-green";
      case "status-processing":
        return "badge-blue";
      case "status-rejected":
        return "badge-red";
      default:
        return "badge-gray";
    }
  };

  const badges = document.querySelectorAll(".badge-contain .badge");
  const radios = document.querySelectorAll(
    '.badge-contain input[type="radio"]'
  );

  // Untuk memastikan badge yang terkait dengan radio button yang dipilih mendapatkan class yang sesuai.
  radios.forEach((radio, index) => {
    if (radio.checked) {
      const forValue = badges[index].getAttribute("for");
      badges[index].classList.add(getBadgeClass(forValue));
      badges[index].classList.remove("badge-gray");
    }
  });

  badges.forEach((badge) => {
    badge.addEventListener("click", () => {
      badges.forEach((b) => {
        b.className = "badge badge-gray";
      });

      const forValue = badge.getAttribute("for");

      badge.classList.remove("badge-gray");
      badge.classList.add(getBadgeClass(forValue));
    });
  });
};

// MENAMPILKAN POPUP ALERT
const showAlert = () => {
  const alertOverlay = document.querySelector(".overlay");

  alertOverlay.classList.add("alert-active");
};

// MENGHILANGKAN POPUP ALERT
const closeAlert = () => {
  const alertOverlay = document.querySelector(".overlay");

  alertOverlay.classList.remove("alert-active");
};

// UNTUK MENAMPILKAN BUKTI LAMPIRAN KETIKA DI KLIK
const showLampiran = () => {
  const lampiran = document.querySelectorAll(".lampiran_bukti");
  const lampiranFull = document.querySelector(".lampiran_bukti_full");
  const overlay = document.querySelector(".overlay");

  if (lampiran.length > 0 && lampiranFull) {
    lampiran.forEach((bukti) => {
      bukti.addEventListener("click", () => {
        const srcValue = bukti.getAttribute("src");
        lampiranFull.setAttribute("src", srcValue);
        showAlert();
      });
    });
  }

  if (overlay) {
    overlay.addEventListener("click", closeAlert);
  }
};


// UNTUK MENAMPILKAN FILE APA SAJA YANG DIUPLOAD
const uploadFile = () => {
  const fileInput = document.getElementById("lampiran");
  const fileCountDisplay = document.getElementById("file-count");
  const fileListDisplay = document.getElementById("file-list");

  if (fileInput && fileCountDisplay && fileListDisplay) {
    fileInput.addEventListener("change", () => {
      const files = fileInput.files;

      if (files.length > 1)
        fileCountDisplay.textContent = `${files.length} file(s) uploaded`;
      else fileCountDisplay.textContent = "file uploaded";

      fileListDisplay.innerHTML = "";

      for (let i = 0; i < files.length; i++) {
        const listItem = document.createElement("li");
        listItem.textContent = files[i].name;
        fileListDisplay.appendChild(listItem);
      }
    });
  }
};

// UNTUK MENAMPILKAN PREVIEW IMAGE YANG TELAH DIUPLOAD
const changePhoto = () => {
  const fileInput = document.getElementById("change-photo");
  const profileImage = document.getElementById("profile-image");
  const deletePhoto = document.getElementById("delete-photo");

  if (fileInput && profileImage && deletePhoto) {
    fileInput.addEventListener("change", function (event) {
      const file = event.target.files[0]; //
      if (file) {
        // Membuat URL sementara untuk file yang dipilih
        const imageUrl = URL.createObjectURL(file);
        console.log(imageUrl);
        profileImage.src = imageUrl;
      }
    });
  }
};

// UNTUK MENGGANTI TAB PROFILE(INFO PROFILE & EDIT PROFILE)
const switchProfile = () => {
  const profile = document.getElementById("profile-user");
  const profileForm = document.getElementById("edit-profile");
  const btnToEdit = document.getElementById("btn-edit-profile");
  const btnBack = document.getElementById("back-to-profile");

  if (profile && profileForm && btnBack) {
    btnToEdit.addEventListener("click", () => {
      profileForm.classList.add("active");
      profile.classList.remove("active");
    });

    btnBack.addEventListener("click", () => {
      profile.classList.add("active");
      profileForm.classList.remove("active");
    });
  }
};

document.addEventListener("DOMContentLoaded", () => {
  eventTogglePassword();
  eventNavbarScroll();
  switchTab();
  switchTabSubMenu();
  switchProfile();
  updateBadge();
  uploadFile();
  changePhoto();
  showLampiran();
  toggleNavigationMenu();
});
