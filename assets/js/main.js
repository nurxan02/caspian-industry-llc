document.addEventListener("DOMContentLoaded", function () {
  const navbar = document.getElementById("navbar");

  window.addEventListener("scroll", function () {
    if (window.scrollY > 50) {
      navbar.classList.add("scrolled");
    } else {
      navbar.classList.remove("scrolled");
    }
  });

  const mobileLangToggle = document.getElementById("mobile-lang-toggle");
  const mobileLangMenu = document.getElementById("mobile-lang-menu");

  if (mobileLangToggle && mobileLangMenu) {
    mobileLangToggle.addEventListener("click", function (e) {
      e.stopPropagation();
      const isExpanded =
        mobileLangToggle.getAttribute("aria-expanded") === "true";
      mobileLangToggle.setAttribute("aria-expanded", !isExpanded);
      mobileLangMenu.classList.toggle("active");
    });

    document.addEventListener("click", function (e) {
      if (
        !mobileLangToggle.contains(e.target) &&
        !mobileLangMenu.contains(e.target)
      ) {
        mobileLangToggle.setAttribute("aria-expanded", "false");
        mobileLangMenu.classList.remove("active");
      }
    });
  }

  const navbarToggle = document.getElementById("navbar-toggle");
  const navbarMenu = document.getElementById("navbar-menu");
  const navbarCenter = document.querySelector(".navbar-center");
  const navbarActions = document.querySelector(".navbar-actions");

  const mobileMenu = document.getElementById("mobile-menu");
  const mobileOverlay = document.getElementById("mobile-menu-overlay");
  const mobilePanel = mobileMenu
    ? mobileMenu.querySelector(".mobile-menu-panel")
    : null;
  const mobileClose = document.getElementById("mobile-menu-close");

  console.log("Mobile menu elements:", {
    navbarToggle,
    navbarMenu,
    navbarCenter,
    navbarActions,
  });

  function openAppleMenu() {
    if (!mobileMenu) return;
    navbarToggle.classList.add("active");
    navbarToggle.setAttribute("aria-expanded", "true");
    mobileMenu.setAttribute("aria-hidden", "false");
    mobileMenu.classList.add("is-open");
    document.body.style.overflow = "hidden";
    document.body.classList.add("menu-open");
    setTimeout(() => {
      if (mobilePanel) mobilePanel.focus();
    }, 50);
  }

  function closeAppleMenu() {
    if (!mobileMenu) return;
    navbarToggle.classList.remove("active");
    navbarToggle.setAttribute("aria-expanded", "false");
    mobileMenu.classList.remove("is-open");
    mobileMenu.setAttribute("aria-hidden", "true");
    document.body.style.overflow = "";
    document.body.classList.remove("menu-open");
    navbarToggle.focus();
  }

  if (navbarToggle) {
    navbarToggle.addEventListener("click", function (e) {
      e.preventDefault();
      e.stopPropagation();

      if (window.innerWidth <= 768 && mobileMenu) {
        if (mobileMenu.classList.contains("is-open")) closeAppleMenu();
        else openAppleMenu();
        return;
      }

      if (navbarMenu) {
        const isActive = navbarMenu.classList.contains("active");
        navbarMenu.classList.toggle("active");
        navbarToggle.classList.toggle("active");
        if (navbarCenter) navbarCenter.classList.toggle("active");
        if (navbarActions) navbarActions.classList.toggle("active");
        document.body.style.overflow = isActive ? "" : "hidden";
      }
    });
  }

  if (mobileOverlay) mobileOverlay.addEventListener("click", closeAppleMenu);
  if (mobileClose) mobileClose.addEventListener("click", closeAppleMenu);
  document.addEventListener("keydown", (e) => {
    if (
      e.key === "Escape" &&
      mobileMenu &&
      mobileMenu.classList.contains("is-open")
    )
      closeAppleMenu();
  });

  if (navbarCenter) {
    navbarCenter.addEventListener("click", function (e) {
      if (e.target === navbarCenter) {
        console.log("Overlay clicked, closing menu");
        navbarMenu.classList.remove("active");
        navbarToggle.classList.remove("active");
        navbarCenter.classList.remove("active");
        if (navbarActions) {
          navbarActions.classList.remove("active");
        }
        document.body.style.overflow = "";
      }
    });
  }

  const navLinks = document.querySelectorAll(
    ".navbar-menu a, .mobile-menu-links a"
  );
  navLinks.forEach((link) => {
    link.addEventListener("click", function () {
      console.log("Nav link clicked");
      navbarMenu.classList.remove("active");
      navbarToggle.classList.remove("active");
      if (navbarCenter) {
        navbarCenter.classList.remove("active");
      }
      if (navbarActions) {
        navbarActions.classList.remove("active");
      }
      document.body.style.overflow = "";
    });
  });

  const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px",
  };

  const observer = new IntersectionObserver(function (entries) {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("fade-in");
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  const animatedElements = document.querySelectorAll(".card, .section-header");
  animatedElements.forEach((el) => observer.observe(el));

  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      const href = this.getAttribute("href");
      if (href !== "#") {
        e.preventDefault();
        const target = document.querySelector(href);
        if (target) {
          target.scrollIntoView({
            behavior: "smooth",
            block: "start",
          });
        }
      }
    });
  });
});

function handleContactForm(formId) {
  const form = document.getElementById(formId);
  if (!form) return;

  form.addEventListener("submit", async function (e) {
    e.preventDefault();

    const formData = new FormData(form);
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;

    submitBtn.disabled = true;
    submitBtn.textContent = "Sending...";

    try {
      const response = await fetch(form.action, {
        method: "POST",
        body: formData,
      });

      const result = await response.json();

      if (result.success) {
        showMessage("success", result.message || "Message sent successfully!");
        form.reset();
      } else {
        showMessage(
          "error",
          result.message || "An error occurred. Please try again."
        );
      }
    } catch (error) {
      showMessage("error", "An error occurred. Please try again.");
    } finally {
      submitBtn.disabled = false;
      submitBtn.textContent = originalText;
    }
  });
}

function showMessage(type, message) {
  const messageDiv = document.createElement("div");
  messageDiv.className = `alert alert-${type}`;
  messageDiv.textContent = message;
  messageDiv.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        padding: 1rem 1.5rem;
        background: ${type === "success" ? "#205581" : "#d32f2f"};
        color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.3);
        z-index: 9999;
        animation: slideInRight 0.3s ease;
    `;

  document.body.appendChild(messageDiv);

  setTimeout(() => {
    messageDiv.style.animation = "slideOutRight 0.3s ease";
    setTimeout(() => messageDiv.remove(), 300);
  }, 3000);
}

function initGallery() {
  const galleryItems = document.querySelectorAll(".gallery-item");

  galleryItems.forEach((item) => {
    item.addEventListener("click", function () {
      const imgSrc = this.querySelector("img").src;
      const title = this.querySelector("img").alt;

      const lightbox = document.createElement("div");
      lightbox.className = "lightbox";
      lightbox.innerHTML = `
                <div class="lightbox-content">
                    <span class="lightbox-close">&times;</span>
                    <img src="${imgSrc}" alt="${title}">
                    <div class="lightbox-caption">${title}</div>
                </div>
            `;

      lightbox.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0,0,0,0.95);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 10000;
                animation: fadeIn 0.3s ease;
            `;

      document.body.appendChild(lightbox);
      document.body.style.overflow = "hidden";

      const close = () => {
        lightbox.style.animation = "fadeOut 0.3s ease";
        setTimeout(() => {
          lightbox.remove();
          document.body.style.overflow = "";
        }, 300);
      };

      lightbox
        .querySelector(".lightbox-close")
        .addEventListener("click", close);
      lightbox.addEventListener("click", function (e) {
        if (e.target === lightbox) close();
      });
    });
  });
}

function initFAQ() {
  const faqItems = document.querySelectorAll(".faq-item");

  faqItems.forEach((item) => {
    const question = item.querySelector(".faq-question");
    if (question) {
      question.addEventListener("click", function () {
        const isActive = item.classList.contains("active");

        faqItems.forEach((i) => i.classList.remove("active"));

        if (!isActive) {
          item.classList.add("active");
        }
      });
    }
  });
}

const style = document.createElement("style");
style.textContent = `
    @keyframes slideInRight {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    @keyframes slideOutRight {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
    
    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }
    
    .lightbox-content {
        position: relative;
        max-width: 90%;
        max-height: 90%;
    }
    
    .lightbox-content img {
        max-width: 100%;
        max-height: 80vh;
        object-fit: contain;
        border-radius: 8px;
    }
    
    .lightbox-close {
        position: absolute;
        top: -60px;
        right: 0;
        font-size: 30px;
        color: #ffffffff;

        

        cursor: pointer;
        transition: color 0.3s;
    }
    
    .lightbox-close:hover {
        color: #6BA8D6;
    }
    
    .lightbox-caption {
        text-align: center;
        color: #fff;
        margin-top: 1rem;
        font-size: 1.125rem;
    }
`;
document.head.appendChild(style);

// Client Logo Carousel - Infinite Scroll (Works on all pages)
function initClientCarousel() {
  // Find all carousel tracks on the page
  const clientsTracks = document.querySelectorAll(".clients-track");

  clientsTracks.forEach((clientsTrack, index) => {
    if (
      clientsTrack &&
      clientsTrack.children.length > 0 &&
      clientsTrack.parentNode
    ) {
      // Create unique ID if doesn't exist
      if (!clientsTrack.id) {
        clientsTrack.id = "clientsTrack_" + index;
      }

      // Remove any existing clones for this track
      try {
        const existingClones = clientsTrack.parentNode.querySelectorAll(
          '[aria-hidden="true"]'
        );
        existingClones.forEach((clone) => {
          if (clone && clone.parentNode) {
            clone.remove();
          }
        });
      } catch (e) {
        console.warn("Error removing existing clones:", e);
      }

      // Create seamless infinite scroll by duplicating content
      const clonedTrack = clientsTrack.cloneNode(true);
      clonedTrack.removeAttribute("id");
      clonedTrack.setAttribute("aria-hidden", "true");
      clonedTrack.classList.add("no-transition");

      // Add the clone right after the original
      try {
        if (clientsTrack.parentNode) {
          clientsTrack.parentNode.appendChild(clonedTrack);
        }
      } catch (e) {
        console.warn("Error appending cloned track:", e);
        return; // Exit this iteration if we can't append
      }

      // Exclude from global transitions
      clientsTrack.classList.add("no-transition");

      // Force restart animations
      clientsTrack.style.animation = "none";
      clonedTrack.style.animation = "none";

      // Trigger reflow
      try {
        clientsTrack.offsetHeight;
        clonedTrack.offsetHeight;
      } catch (e) {
        console.warn("Error triggering reflow:", e);
      }

      // Restart animations
      clientsTrack.style.animation = "scroll 30s linear infinite";
      clonedTrack.style.animation = "scroll 30s linear infinite";

      // Pause animation on hover for this specific carousel
      const carousel = clientsTrack.closest(".clients-carousel-container");
      // if (carousel) {
      //   // Create unique functions for this carousel instance
      //   const pauseCarousel = function () {
      //     try {
      //       clientsTrack.style.animationPlayState = "paused";
      //       clonedTrack.style.animationPlayState = "paused";
      //     } catch (e) {
      //       console.warn("Error pausing carousel:", e);
      //     }
      //   };

      //   const resumeCarousel = function () {
      //     try {
      //       clientsTrack.style.animationPlayState = "running";
      //       clonedTrack.style.animationPlayState = "running";
      //     } catch (e) {
      //       console.warn("Error resuming carousel:", e);
      //     }
      //   };

      //   // Remove any existing listeners for this carousel
      //   try {
      //     if (carousel._pauseCarousel) {
      //       carousel.removeEventListener("mouseenter", carousel._pauseCarousel);
      //     }
      //     if (carousel._resumeCarousel) {
      //       carousel.removeEventListener(
      //         "mouseleave",
      //         carousel._resumeCarousel
      //       );
      //     }
      //   } catch (e) {
      //     console.warn("Error removing existing listeners:", e);
      //   }

      //   // Store functions on carousel element
      //   carousel._pauseCarousel = pauseCarousel;
      //   carousel._resumeCarousel = resumeCarousel;

      //   carousel.addEventListener("mouseenter", pauseCarousel);
      //   carousel.addEventListener("mouseleave", resumeCarousel);
      // }
    }
  });
}

// Initialize carousel when DOM is ready
if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", initClientCarousel);
} else {
  initClientCarousel();
}

// Re-initialize on window load to ensure all images are loaded
window.addEventListener("load", initClientCarousel);

// Enhanced Smooth Scrolling for internal links
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute("href"));
    if (target) {
      target.scrollIntoView({
        behavior: "smooth",
        block: "start",
      });
    }
  });
});

// Intersection Observer for fade-in animations
const observerOptions = {
  threshold: 0.1,
  rootMargin: "0px 0px -50px 0px",
};

const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.style.opacity = "1";
      entry.target.style.transform = "translateY(0)";
    }
  });
}, observerOptions);

// Apply fade-in animation to sections
document
  .querySelectorAll(".section, .card, .feature-item, .project-card, .news-card")
  .forEach((el) => {
    el.style.opacity = "0";
    el.style.transform = "translateY(20px)";
    el.style.transition = "opacity 0.6s ease, transform 0.6s ease";
    observer.observe(el);
  });

// Optimized parallax effect with throttling to improve performance
let ticking = false;

function updateParallax() {
  const scrolled = window.pageYOffset;
  const parallax = document.querySelector(".hero-section");
  const speed = scrolled * 0.5;

  if (parallax) {
    // Use transform instead of backgroundPosition for better performance
    parallax.style.transform = `translate3d(0, ${speed}px, 0)`;
  }
  ticking = false;
}

function requestParallaxUpdate() {
  if (!ticking) {
    requestAnimationFrame(updateParallax);
    ticking = true;
  }
}

// Use passive listener for better performance
window.addEventListener("scroll", requestParallaxUpdate, { passive: true });

// Enhanced button hover effects
document
  .querySelectorAll(".btn, .card, .project-card, .news-card")
  .forEach((element) => {
    element.addEventListener("mouseenter", function () {
      this.style.transform = "translateY(-2px)";
      this.style.boxShadow = "0 10px 25px rgba(0, 0, 0, 0.3)";
    });

    element.addEventListener("mouseleave", function () {
      this.style.transform = "translateY(0)";
      this.style.boxShadow = "";
    });
  });

// Optimized navbar scroll behavior with throttling
let lastScrollTop = 0;
let navbarTicking = false;

function updateNavbar() {
  let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  const navbar = document.getElementById("navbar");
  const logo = navbar ? navbar.querySelector(".navbar-logo") : null;

  if (navbar) {
    // Add transition for smooth hiding/showing
    if (!navbar.style.transition) {
      navbar.style.transition = "transform 0.3s ease-in-out";
    }

    if (scrollTop > lastScrollTop && scrollTop > 150) {
      // Scrolling down - hide navbar but preserve logo state
      navbar.style.transform = "translateY(-100%)";
      if (logo) {
        logo.classList.remove("hidden");
      }
    } else {
      // Scrolling up - show navbar
      navbar.style.transform = "translateY(0)";
      if (logo) {
        logo.classList.remove("hidden");
      }
    }

    // Ensure logo is always visible when navbar is visible
    if (logo && navbar.style.transform === "translateY(0)") {
      logo.style.opacity = "1";
      logo.style.visibility = "visible";
    }
  }

  lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
  navbarTicking = false;
}

function requestNavbarUpdate() {
  if (!navbarTicking) {
    requestAnimationFrame(updateNavbar);
    navbarTicking = true;
  }
}

// Use passive listener for better scroll performance
window.addEventListener("scroll", requestNavbarUpdate, { passive: true });

// Enhanced loading animation for images with logo protection
document.querySelectorAll("img").forEach((img) => {
  // Don't apply loading animation to logo images
  if (!img.closest(".navbar-logo")) {
    img.style.opacity = "0";
    img.style.transition = "opacity 0.5s ease";

    img.addEventListener("load", function () {
      this.style.opacity = "1";
    });
  }
});

// Add ripple effect to buttons
document.querySelectorAll(".btn").forEach((button) => {
  button.addEventListener("click", function (e) {
    const ripple = document.createElement("span");
    const diameter = Math.max(this.clientWidth, this.clientHeight);
    const radius = diameter / 2;

    ripple.style.width = ripple.style.height = diameter + "px";
    ripple.style.left = e.clientX - this.offsetLeft - radius + "px";
    ripple.style.top = e.clientY - this.offsetTop - radius + "px";
    ripple.classList.add("ripple");

    const rippleStyle = document.createElement("style");
    rippleStyle.textContent = `
      .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: scale(0);
        animation: ripple-animation 0.6s linear;
        pointer-events: none;
      }
      
      @keyframes ripple-animation {
        to {
          transform: scale(4);
          opacity: 0;
        }
      }
    `;

    if (!document.head.querySelector(".ripple-styles")) {
      rippleStyle.className = "ripple-styles";
      document.head.appendChild(rippleStyle);
    }

    this.style.position = "relative";
    this.style.overflow = "hidden";
    this.appendChild(ripple);

    setTimeout(() => {
      ripple.remove();
    }, 600);
  });
});

// Logo visibility protection
function ensureLogoVisibility() {
  const logos = document.querySelectorAll(".navbar-logo img");
  logos.forEach((logo) => {
    if (logo && logo.src) {
      logo.style.opacity = "1";
      logo.style.visibility = "visible";
      logo.style.display = "block";
    }
  });
}

// Run logo protection on load and periodically
window.addEventListener("load", ensureLogoVisibility);
document.addEventListener("DOMContentLoaded", ensureLogoVisibility);

// Periodic check for logo visibility (every 3 seconds)
setInterval(ensureLogoVisibility, 3000);

// Page visibility change protection
document.addEventListener("visibilitychange", function () {
  if (!document.hidden) {
    setTimeout(ensureLogoVisibility, 100);
  }
});
