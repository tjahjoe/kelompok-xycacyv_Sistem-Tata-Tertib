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

const eventNavbarScroll = () => {
  const navbar = document.getElementById("navbar");
  const hamburger = document.getElementById("hamburger");
  const menu = document.getElementById("menu");

  if (navbar) {
    let lastScrollTop = 0;

    window.addEventListener("scroll", () => {
      const scrollTop =
        window.pageYOffset || document.documentElement.scrollTop;
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

    hamburger.addEventListener("click", toggleMenu);
  }
};

const switchTab = () => {
  const tabLink = document.querySelectorAll(".tab-link");
  const logoutBtn = document.querySelector(".logout-btn");
  const tabContent = document.querySelectorAll(".tab-content");

  if (tabLink && tabContent && logoutBtn) {
    tabLink.forEach((link) => {
      link.addEventListener("click", function (event) {
        if (this === logoutBtn) {
          return;
        }

        event.preventDefault();
        tabLink.forEach((tab) => tab.classList.remove("active"));
        tabContent.forEach((content) => content.classList.remove("active"));
        this.classList.add("active");
        document
          .querySelector(this.getAttribute("href"))
          .classList.add("active");
      });
    });
  }
};

const switchTabSubMenu = () => {
  const tabSubMenu = document.querySelectorAll(".tab-sublink");
  const tabSubContent = document.querySelectorAll(".tab-subcontent");

  if(tabSubMenu){
    tabSubMenu.forEach((link) => {
      link.addEventListener("click", function(event){
        event.preventDefault();

        tabSubMenu.forEach((tab) => tab.classList.remove("active"));
        tabSubContent.forEach((content) => content.classList.remove("active"));
        
        this.classList.add("active");

        document
          .querySelector(this.getAttribute("href"))
          .classList.add("active");
      });
    })
  }
}

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

const showAlert = () => {
  const alertOverlay = document.querySelector(".overlay");

  alertOverlay.classList.add("alert-active");
};

const closeAlert = () => {
  const alertOverlay = document.querySelector(".overlay");

  alertOverlay.classList.remove("alert-active");
};

if(document.querySelector('.logout-btn')){
  document.querySelector('.logout-btn').addEventListener('click', (e) => {
  showAlert();
  });
  
  document.querySelector('.alert-logout-button').addEventListener('click', (e) => {
    e.preventDefault();

    window.location.href = './../app/controllers/Logout.php';
  });
}

if(document.querySelector('.lampiran_bukti')){
  const lampiran = document.querySelectorAll('.lampiran_bukti');
  const lampiranFull = document.querySelector('.lampiran_bukti_full');

  lampiran.forEach((bukti) => {
    bukti.addEventListener("click", () => {

      const srcValue = bukti.getAttribute("src");
      lampiranFull.setAttribute("src", srcValue);

      showAlert();   
    });
  });

  document.querySelector(".overlay").addEventListener("click", closeAlert);
}

if (
  document.querySelector(".overlay") &&
  document.querySelector(".alert-close-button")
) {
  document.querySelector(".overlay").addEventListener("click", closeAlert);
  document
    .querySelector(".alert-close-button")
    .addEventListener("click", closeAlert);
}

const uploadFile = () => {
  const fileInput = document.getElementById("lampiran");
  const fileCountDisplay = document.getElementById("file-count");
  const fileListDisplay = document.getElementById("file-list");

  if (fileInput && fileCountDisplay && fileListDisplay) {
    fileInput.addEventListener("change", () => {
      const files = fileInput.files;
      fileCountDisplay.textContent = `${files.length} file(s) uploaded`;

      fileListDisplay.innerHTML = "";

      for (let i = 0; i < files.length; i++) {
        const listItem = document.createElement("li");
        listItem.textContent = files[i].name;
        fileListDisplay.appendChild(listItem);
      }
    });
  }
};

const changePhoto = () => {
  const fileInput = document.getElementById('change-photo');
  const profileImage = document.getElementById('profile-image');
  const deletePhoto = document.getElementById('delete-photo');

  if (fileInput && profileImage && deletePhoto) {

  fileInput.addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
      const imageUrl = URL.createObjectURL(file);
      console.log(imageUrl)
      profileImage.src = imageUrl;
    }
  });
  }
}

const switchProfile = () => {
  const profile = document.getElementById('profile-user');
  const profileForm = document.getElementById('edit-profile');
  const btnToEdit = document.getElementById('btn-edit-profile');
  const btnBack = document.getElementById('back-to-profile');

  if (profile && profileForm && btnBack) {
    profileForm.style.display = 'none'

    btnToEdit.addEventListener('click', () => {
      profileForm.style.display = 'block';
      profile.classList.remove('active');
    });

    btnBack.addEventListener('click', () => {
      profile.classList.add('active');
      profileForm.style.display = 'none';
    });
  }
}

document.addEventListener("DOMContentLoaded", () => {
  eventTogglePassword();
  eventNavbarScroll();
  switchTab();
  switchTabSubMenu();
  switchProfile();
  updateBadge();
  uploadFile();
  changePhoto();
});
