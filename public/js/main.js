// ==================== TYPEWRITER EFFECT ====================
class Typewriter {
    constructor(elementId, text, speed = 60) {
        this.element = document.getElementById(elementId);
        this.text = text;
        this.speed = speed;
        this.isTyping = false;
        this.currentIndex = 0;
    }

    start() {
        if (this.isTyping) return;

        this.isTyping = true;
        this.currentIndex = 0;
        this.element.textContent = "";
        this.element.classList.remove("typewriter-done");

        this.typeCharacter();
    }

    typeCharacter() {
        if (this.currentIndex < this.text.length) {
            this.element.textContent += this.text.charAt(this.currentIndex);
            this.currentIndex++;
            setTimeout(() => this.typeCharacter(), this.speed);
        } else {
            this.isTyping = false;
            this.element.classList.add("typewriter-done");
        }
    }

    reset() {
        this.element.textContent = "";
        this.element.classList.remove("typewriter-done");
        this.isTyping = false;
        this.currentIndex = 0;
    }

    setText(newText) {
        this.text = newText;
    }
}

// ==================== MAIN INITIALIZATION ====================
document.addEventListener("DOMContentLoaded", function () {
    console.log("Inicializando página...");

    const header = document.querySelector(".header");
    const navAnchors = document.querySelectorAll('.nav a[href^="#"]');
    let preventHeaderHide = false;
    // Inicializar Typewriters
    const typewriter1 = new Typewriter(
        "typewriter-text-1",
        "Certificaciones Profesionales",
        60
    );
    const typewriter2 = new Typewriter(
        "typewriter-text-2",
        "para Impulsar tu Empleabilidad",
        60
    );

    // Slides de hero sincronizados con texto
    const heroFrames = document.querySelectorAll(".hero-frame");
    const slides = [
        {
            imgIndex: 0,
            line1: "Certificaciones Profesionales",
            line2: "para Impulsar tu Empleabilidad",
        },
        {
            imgIndex: 1,
            line1: "Formación en Vivo",
            line2: "con Mentores Internacionales",
        },
    ];
    let currentSlide = 0;
    let slideTimer = null;

    // Secuencia de animaciones
    function startAnimations() {
        console.log("Iniciando animaciones...");

        // 1. Eyebrow aparece primero
        setTimeout(() => {
            document.querySelector(".eyebrow").style.animation =
                "fadeInUp 1s ease-out forwards";
        }, 500);

        // 2. Lanzar la primera slide con textos sincronizados sin esperar
        if (heroFrames.length) {
            showSlide(0);
            startSlideLoop();
        }

        // 4. Texto descriptivo
        setTimeout(() => {
            document.querySelector(".hero-lead").style.animation =
                "fadeInUp 1s ease-out forwards";
        }, 5000); // Tiempo suficiente para ambas líneas

        // 5. Botones
        setTimeout(() => {
            const buttons = document.querySelectorAll(".hero-actions a");
            buttons[0].style.animation = "fadeInLeft 0.8s ease-out forwards";
            buttons[1].style.animation = "fadeInRight 0.8s ease-out forwards";
        }, 5500);

        // 6. Stats
        setTimeout(() => {
            const stats = document.querySelectorAll(".stat-item");
            stats.forEach((stat, index) => {
                setTimeout(() => {
                    stat.style.animation = "fadeInUp 1s ease-out forwards";
                }, index * 300);
            });
        }, 6000);
    }

    function showSlide(index) {
        const slide = slides[index];
        if (!slide) return;

        heroFrames.forEach((frame, i) => {
            frame.classList.toggle("active", i === slide.imgIndex);
        });

        typewriter1.reset();
        typewriter2.reset();
        typewriter1.setText(slide.line1);
        typewriter2.setText(slide.line2);

        typewriter1.start();
        const secondLineDelay = slide.line1.length * typewriter1.speed + 200;
        setTimeout(() => typewriter2.start(), secondLineDelay);
    }

    function startSlideLoop() {
        clearInterval(slideTimer);
        if (heroFrames.length === 0) return;
        slideTimer = setInterval(() => {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }, 9000);
    }

    // ==================== PARALLAX ====================
    function initParallax() {
        const heroImage = document.querySelector(".parallax-bg");
        if (!heroImage) return;

        let ticking = false;

        window.addEventListener("scroll", () => {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    const scrolled = window.pageYOffset;
                    const rate = scrolled * 0.1;
                    heroImage.style.transform = `translate3d(0, ${rate}px, 0)`;
                    ticking = false;
                });
                ticking = true;
            }
        });
    }

    // ==================== STICKY HEADER WITH BLUR ====================
    function initStickyHeader() {
        const header = document.getElementById('mainHeader');
        const headerLogo = document.getElementById('headerLogo');
        if (!header) return;

        let lastScrollTop = 0;

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;

            // Add blur and shadow when scrolled
            if (currentScroll > 50) {
                header.classList.add('backdrop-blur-lg', 'bg-[#0b3f45]/95', 'shadow-xl');
                header.classList.remove('bg-[#0b3f45]');
                if (headerLogo) {
                    headerLogo.classList.add('h-8');
                    headerLogo.classList.remove('h-10');
                }
            } else {
                header.classList.remove('backdrop-blur-lg', 'bg-[#0b3f45]/95', 'shadow-xl');
                header.classList.add('bg-[#0b3f45]');
                if (headerLogo) {
                    headerLogo.classList.remove('h-8');
                    headerLogo.classList.add('h-10');
                }
            }

            lastScrollTop = currentScroll;
        });
    }

    // ==================== INTERSECTION OBSERVER ANIMATIONS ====================
    function initScrollAnimations() {
        // Animation for sections
        const sectionObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    entry.target.style.filter = 'blur(0)';
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        // Animation for cards with stagger
        const cardObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const cards = entry.target.parentElement.querySelectorAll('[data-animate-card]');
                    cards.forEach((card, index) => {
                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                            card.style.filter = 'blur(0)';
                        }, index * 100); // Stagger delay
                    });
                    cardObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        // Apply initial styles and observe sections
        document.querySelectorAll('[data-animate]').forEach(section => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(30px)';
            section.style.filter = 'blur(5px)';
            section.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
            sectionObserver.observe(section);
        });

        // Apply initial styles and observe cards
        document.querySelectorAll('[data-animate-card]').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(40px)';
            card.style.filter = 'blur(8px)';
            card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        });

        // Observe parent containers for stagger effect
        document.querySelectorAll('[data-animate]').forEach(section => {
            if (section.querySelector('[data-animate-card]')) {
                cardObserver.observe(section);
            }
        });
    }

    // ==================== SCROLL REVEAL ====================
    function initScrollReveal() {
        const observerOptions = {
            root: null,
            rootMargin: "0px",
            threshold: 0.15,
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const element = entry.target;

                    // Partners logos
                    if (element.classList.contains("partner-logo")) {
                        setTimeout(() => {
                            element.classList.add("visible");
                        }, element.dataset.delay || 0);
                    }

                    // Needs header
                    if (element.classList.contains("needs-header")) {
                        element.classList.add("visible");
                    }

                    // Service boxes
                    if (element.classList.contains("service-box")) {
                        setTimeout(() => {
                            element.classList.add("visible");
                        }, 200);
                    }

                    // Footer
                    if (element.classList.contains("footer")) {
                        element.classList.add("visible");
                    }

                    // Textos animados en needs
                    if (element.querySelector(".animate-left")) {
                        const animateElements = element.querySelectorAll(
                            ".animate-left, .animate-right, .animate-fade-in"
                        );
                        animateElements.forEach((el, index) => {
                            setTimeout(() => {
                                el.style.opacity = "1";
                                el.style.transform =
                                    "translateX(0) translateY(0)";
                            }, index * 150);
                        });
                    }

                    observer.unobserve(element);
                }
            });
        }, observerOptions);

        // Observar elementos para animación al scroll
        const scrollElements = document.querySelectorAll(
            "[data-scroll], .partner-logo, .needs-header, .service-box, .footer"
        );

        scrollElements.forEach((el, index) => {
            if (el.classList.contains("partner-logo")) {
                el.dataset.delay = index * 100;
            }
            observer.observe(el);
        });
    }

    // ==================== MOBILE MENU ====================
    const menuToggle = document.getElementById("menuToggle");
    const mobileMenu = document.getElementById("mobileMenu");
    const menuIcon = document.getElementById("menuIcon");

    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener("click", () => {
            // Toggle the hidden class
            mobileMenu.classList.toggle("hidden");

            // Change the icon
            if (mobileMenu.classList.contains("hidden")) {
                menuIcon.innerHTML = `
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                `;
                menuToggle.setAttribute("aria-label", "Abrir menú");
            } else {
                menuIcon.innerHTML = `
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                `;
                menuToggle.setAttribute("aria-label", "Cerrar menú");
            }
        });

        // Close the menu when clicking on a link
        const mobileNavLinks = mobileMenu.querySelectorAll("a");
        mobileNavLinks.forEach((link) => {
            link.addEventListener("click", () => {
                mobileMenu.classList.add("hidden");
                menuIcon.innerHTML = `
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                `;
                menuToggle.setAttribute("aria-label", "Abrir menú");
            });
        });
    }

    function initNavigationBehaviour() {
        if (!navAnchors || navAnchors.length === 0) return;

        navAnchors.forEach((link) => {
            link.addEventListener("click", () => {
                preventHeaderHide = true;
                header && header.classList.remove("hidden");
                setTimeout(() => {
                    preventHeaderHide = false;
                }, 600);
            });
        });
    }

    function initNavHighlight() {
        if (!navAnchors || navAnchors.length === 0) return;

        const sectionMap = {};
        navAnchors.forEach((link) => {
            const href = link.getAttribute("href") || "";
            const targetId = href.replace("#", "");
            if (targetId) {
                sectionMap[targetId] = link;
            }
        });

        Object.values(sectionMap).forEach((link) =>
            link.classList.remove("active")
        );
        const firstLink = navAnchors[0];
        if (firstLink) {
            firstLink.classList.add("active");
        }

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        Object.values(sectionMap).forEach((link) =>
                            link.classList.remove("active")
                        );
                        const targetLink = sectionMap[entry.target.id];
                        if (targetLink) {
                            targetLink.classList.add("active");
                        } else if (entry.target.id === "registrarme") {
                            // En la sección Registrarme no se resalta ningún ítem del menú
                            Object.values(sectionMap).forEach((link) =>
                                link.classList.remove("active")
                            );
                        }
                    }
                });
            },
            {
                threshold: 0.3,
                rootMargin: "-100px 0px 0px 0px", // compensa altura de header para marcar secciones correctamente
            }
        );

        const observedIds = [...Object.keys(sectionMap), "registrarme"];
        observedIds.forEach((id) => {
            const section = document.getElementById(id);
            if (section) {
                observer.observe(section);
            }
        });
    }

    // ==================== SMOOTH SCROLL ====================
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            const href = this.getAttribute("href");

            if (href === "#" || href === "#inicio") {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: "smooth",
                });
                return;
            }

            const targetElement = document.querySelector(href);
            if (targetElement) {
                e.preventDefault();
                targetElement.scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            }
        });
    });

    // ==================== INITIALIZE EVERYTHING ====================
    // Iniciar todas las funciones
    startAnimations();
    initParallax();
    initStickyHeader();
    initNavigationBehaviour();
    initNavHighlight();
    initScrollReveal();
    initScrollAnimations(); // ✅ NEW: IntersectionObserver animations

    // Reiniciar animaciones al volver al top
    let isAnimating = false;

    window.addEventListener("scroll", () => {
        if (window.pageYOffset === 0 && !isAnimating) {
            isAnimating = true;

            // Resetear typewriters
            typewriter1.reset();
            typewriter2.reset();

            // Resetear otras animaciones
            document
                .querySelectorAll(
                    ".eyebrow, .hero-lead, .hero-actions a, .stat-item"
                )
                .forEach((el) => {
                    el.style.animation = "none";
                    el.style.opacity = "0";
                });

            // Esperar un momento y reiniciar
            setTimeout(() => {
                startAnimations();
                isAnimating = false;
            }, 300);
        }
    });

    // ==================== RESPONSIVE TYPEWRITER ====================
    // En móviles, mostrar texto completo sin animación
    function checkMobile() {
        if (window.innerWidth <= 768) {
            // Mostrar texto completo en móviles
            const line1 = document.getElementById("typewriter-text-1");
            const line2 = document.getElementById("typewriter-text-2");

            if (line1 && line2) {
                line1.textContent = slides[0].line1;
                line2.textContent = slides[0].line2;
                line1.classList.add("typewriter-done");
                line2.classList.add("typewriter-done");
            }
        }
    }

    // Verificar al cargar y al cambiar tamaño
    checkMobile();
    window.addEventListener("resize", checkMobile);

    // ==================== SECCIONES NUEVAS (mockup2) ====================
    const yearEl = document.getElementById("year");
    if (yearEl) {
        yearEl.textContent = new Date().getFullYear();
    }

    // ==================== VERIFICADOR (DEMO) ====================
    // Si estás usando el verificador con Vue (#verify-app), NO ejecutes la demo.
    const verifyVueMount = document.getElementById("verify-app");

    if (!verifyVueMount) {
        const btnVerify = document.getElementById("btnVerify");
        const codeInput = document.getElementById("code");
        const okBox = document.getElementById("okBox");
        const badBox = document.getElementById("badBox");
        const statusEl = document.getElementById("status");
        const okCode = document.getElementById("okCode");

        if (btnVerify && codeInput && okBox && badBox && statusEl && okCode) {
            btnVerify.addEventListener("click", () => {
                const val = (codeInput.value || "").trim();
                okBox.style.display = "none";
                badBox.style.display = "none";

                if (!val) {
                    statusEl.textContent = "Ingresa un código.";
                    return;
                }

                if (val.toUpperCase() === "CEIPP-OK") {
                    okCode.textContent = val;
                    okBox.style.display = "block";
                    statusEl.textContent = "VÁLIDO ✔";
                } else {
                    badBox.style.display = "block";
                    statusEl.textContent = "NO ENCONTRADO ✖";
                }
            });
        }
    }

    // ==================== MODAL LOGIN ====================
    const loginModal = document.getElementById("loginModal");
    const openLoginModal = document.getElementById("openLoginModal");
    const closeLoginModal = document.getElementById("closeLoginModal");
    const navLoginBtn = document.getElementById("navLoginBtn");
    const closeLoginAction = document.getElementById("closeLoginAction");

    function showLoginModal() {
        if (loginModal) {
            loginModal.classList.add("active");
            loginModal.setAttribute("aria-hidden", "false");
        }
    }

    function hideLoginModal() {
        if (loginModal) {
            loginModal.classList.remove("active");
            loginModal.setAttribute("aria-hidden", "true");
        }
    }

    if (openLoginModal) {
        openLoginModal.addEventListener("click", showLoginModal);
    }

    if (navLoginBtn) {
        navLoginBtn.addEventListener("click", (e) => {
            e.preventDefault();
            showLoginModal();
        });
    }

    if (closeLoginModal) {
        closeLoginModal.addEventListener("click", hideLoginModal);
    }
    if (closeLoginAction) {
        closeLoginAction.addEventListener("click", hideLoginModal);
    }

    if (loginModal) {
        loginModal.addEventListener("click", (e) => {
            if (e.target === loginModal) hideLoginModal();
        });
        window.addEventListener("keydown", (e) => {
            if (e.key === "Escape") hideLoginModal();
        });
    }
});

// ==================== FORM VALIDATION (si existe) ====================
const contactForm = document.querySelector(".contact-form");
if (contactForm) {
    contactForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const nameInput = this.querySelector('input[type="text"]');
        const emailInput = this.querySelector('input[type="email"]');
        const messageInput = this.querySelector("textarea");

        let isValid = true;

        if (!nameInput.value.trim()) {
            showError(nameInput, "Por favor ingresa tu nombre");
            isValid = false;
        } else {
            clearError(nameInput);
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailInput.value.trim() || !emailRegex.test(emailInput.value)) {
            showError(emailInput, "Por favor ingresa un email válido");
            isValid = false;
        } else {
            clearError(emailInput);
        }

        if (!messageInput.value.trim()) {
            showError(messageInput, "Por favor ingresa tu mensaje");
            isValid = false;
        } else {
            clearError(messageInput);
        }

        if (isValid) {
            alert("¡Gracias por tu mensaje! Te contactaremos pronto.");
            this.reset();
        }
    });
}

function showError(input, message) {
    clearError(input);

    const errorDiv = document.createElement("div");
    errorDiv.className = "error-message";
    errorDiv.style.color = "#e74c3c";
    errorDiv.style.fontSize = "0.85rem";
    errorDiv.style.marginTop = "4px";
    errorDiv.textContent = message;

    input.parentNode.appendChild(errorDiv);
    input.style.borderColor = "#e74c3c";
}

function clearError(input) {
    const existingError = input.parentNode.querySelector(".error-message");
    if (existingError) {
        existingError.remove();
    }
    input.style.borderColor = "";
}
