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

document.addEventListener("DOMContentLoaded", () => {
  eventTogglePassword();
  eventNavbarScroll();
});
