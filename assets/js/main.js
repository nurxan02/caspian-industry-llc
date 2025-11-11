// Main JavaScript for Caspian Industry

document.addEventListener("DOMContentLoaded", function () {
  // Navbar scroll effect
  const navbar = document.getElementById("navbar");

  window.addEventListener("scroll", function () {
    if (window.scrollY > 50) {
      navbar.classList.add("scrolled");
    } else {
      navbar.classList.remove("scrolled");
    }
  });

  // Mobile menu toggle
  const navbarToggle = document.getElementById("navbar-toggle");
  const navbarMenu = document.getElementById("navbar-menu");

  if (navbarToggle) {
    navbarToggle.addEventListener("click", function () {
      navbarMenu.classList.toggle("active");

      // Animate toggle button
      const spans = this.querySelectorAll("span");
      if (navbarMenu.classList.contains("active")) {
        spans[0].style.transform = "rotate(45deg) translateY(8px)";
        spans[1].style.opacity = "0";
        spans[2].style.transform = "rotate(-45deg) translateY(-8px)";
      } else {
        spans[0].style.transform = "";
        spans[1].style.opacity = "1";
        spans[2].style.transform = "";
      }
    });
  }

  // Close mobile menu when clicking on a link
  const navLinks = document.querySelectorAll(".navbar-menu a");
  navLinks.forEach((link) => {
    link.addEventListener("click", function () {
      if (window.innerWidth <= 768) {
        navbarMenu.classList.remove("active");
        const spans = navbarToggle.querySelectorAll("span");
        spans[0].style.transform = "";
        spans[1].style.opacity = "1";
        spans[2].style.transform = "";
      }
    });
  });

  // Fade in animations on scroll
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

  // Smooth scroll for anchor links
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

// Globe.gl initialization function
function initGlobe(containerId, locations = [], arcs = []) {
  const globe = Globe()(document.getElementById(containerId))
    .globeImageUrl("//unpkg.com/three-globe/example/img/earth-dark.jpg")
    .backgroundColor("rgba(0,0,0,0)")
    .showAtmosphere(false)
    .arcColor(() => ["#6BA8D6", "#205581"])
    .arcDashLength(0.4)
    .arcDashGap(1)
    .arcDashInitialGap(() => Math.random())
    .arcDashAnimateTime(2000)
    .pointColor(() => "#6BA8D6")
    .pointAltitude(0.01)
    .pointRadius(0.15)
    .pointsMerge(true);

  // Add labels if locations provided
  if (locations.length > 0) {
    globe
      .labelsData(locations)
      .labelText("name")
      .labelSize(1.5)
      .labelColor(() => "#FEFEFE")
      .labelResolution(2);
  }

  // Add arcs if provided
  if (arcs.length > 0) {
    globe.arcsData(arcs);
  }

  // Add location points
  if (locations.length > 0) {
    globe.pointsData(locations);
  }

  // Auto rotate
  globe.controls().autoRotate = true;
  globe.controls().autoRotateSpeed = 0.5;
  globe.controls().enableZoom = false;

  // Responsive sizing
  const resizeGlobe = () => {
    const container = document.getElementById(containerId);
    if (container) {
      globe.width(container.offsetWidth);
      globe.height(container.offsetHeight);
    }
  };

  window.addEventListener("resize", resizeGlobe);
  setTimeout(resizeGlobe, 100);

  return globe;
}

// Form validation and submission
function handleContactForm(formId) {
  const form = document.getElementById(formId);
  if (!form) return;

  form.addEventListener("submit", async function (e) {
    e.preventDefault();

    const formData = new FormData(form);
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;

    // Disable button and show loading state
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

// Show message helper
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

// Gallery lightbox
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

// FAQ Accordion
function initFAQ() {
  const faqItems = document.querySelectorAll(".faq-item");

  faqItems.forEach((item) => {
    const question = item.querySelector(".faq-question");
    if (question) {
      question.addEventListener("click", function () {
        const isActive = item.classList.contains("active");

        // Close all items
        faqItems.forEach((i) => i.classList.remove("active"));

        // Open clicked item if it wasn't active
        if (!isActive) {
          item.classList.add("active");
        }
      });
    }
  });
}

// CSS animations
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
