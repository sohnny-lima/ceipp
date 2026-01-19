// ==================== UTILS ====================
const debounce = (fn, delay) => {
    let timeoutId;
    return (...args) => {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => fn.apply(this, args), delay);
    };
};

// ==================== TYPEWRITER EFFECT ====================
class Typewriter {
    constructor(elementId, text, speed = 60) {
        this.element = document.getElementById(elementId);
        this.text = text;
        this.speed = speed;
        this.isTyping = false;
        this.currentIndex = 0;
        this.timer = null;
    }

    start() {
        if (this.isTyping || !this.element) return;
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
            this.timer = setTimeout(() => this.typeCharacter(), this.speed);
        } else {
            this.isTyping = false;
            this.element.classList.add("typewriter-done");
        }
    }

    reset() {
        if (this.timer) clearTimeout(this.timer);
        if (this.element) {
            this.element.textContent = "";
            this.element.classList.remove("typewriter-done");
        }
        this.isTyping = false;
        this.currentIndex = 0;
    }

    setText(newText) {
        this.text = newText;
    }
}

// ==================== APP INITIALIZATION ====================
document.addEventListener("DOMContentLoaded", function () {
    console.log("CEIPP App Initialized");

    // --- DOM Elements ---
    const header = document.getElementById("mainHeader");
    const heroImage = document.querySelector(".parallax-bg");
    const navAnchors = document.querySelectorAll('#siteNav a[href^="#"], #mobileMenu a[href^="#"]');

    // --- State ---
    let headerHeight = 80;
    let ticking = false; // for requestAnimationFrame

    // 1. HEADER HEIGHT SYNC
    function syncHeaderHeight() {
        if (!header) return;
        headerHeight = header.offsetHeight;
        document.documentElement.style.setProperty("--header-h", `${headerHeight}px`);
    }

    // 2. SCROLL HANDLER (Unified)
    function onScroll() {
        const scrollY = window.pageYOffset;

        // Sticky Header Styles
        if (header) {
            if (scrollY > 10) {
                header.classList.add('shadow-xl', 'border-white/10', 'bg-opacity-95');
                header.classList.remove('bg-opacity-100'); // Let backdrop blur work if needed
            } else {
                header.classList.remove('shadow-xl', 'border-white/10', 'bg-opacity-95');
                header.classList.add('bg-opacity-100');
            }
        }

        // Parallax Hero
        if (heroImage && scrollY < window.innerHeight) {
            const rate = scrollY * 0.3;
            heroImage.style.transform = `translate3d(0, ${rate}px, 0)`;
        }

        // ScrollSpy (Nav Highlight)
        highlightNavigation(scrollY);

        ticking = false;
    }

    function highlightNavigation(scrollY) {
        if (!navAnchors.length) return;

        // Use a slight offset to activate section before it hits the exact top
        const scrollPos = scrollY + headerHeight + 50;

        let currentId = "inicio";

        // Find the current section
        // We iterate backwards or just check all sections
        const sections = Array.from(document.querySelectorAll('section[id]'));

        for (const section of sections) {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;

            if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
                currentId = section.id;
            }
        }

        // Special case: if at bottom of page, highlight last contact section
        if ((window.innerHeight + scrollY) >= document.body.offsetHeight - 50) {
            // check if 'contactos' exists
            if (document.getElementById('contactos')) currentId = 'contactos';
        }

        // Update classes
        navAnchors.forEach(link => {
            link.classList.remove("active");
            const href = link.getAttribute("href");
            if (href === `#${currentId}`) {
                link.classList.add("active");
            }
        });
    }

    // Bind Scroll
    window.addEventListener("scroll", () => {
        if (!ticking) {
            window.requestAnimationFrame(onScroll);
            ticking = true;
        }
    });

    // Bind Resize
    window.addEventListener("resize", debounce(() => {
        syncHeaderHeight();
        // re-run mobile check for typewriter
        checkMobileTypewriter();
    }, 100));

    // Initial calls
    syncHeaderHeight();
    onScroll(); // Trigger once to set initial state


    // 3. TYPEWRITER & HERO SLIDER
    const typewriter1 = new Typewriter("typewriter-text-1", "Formación en Vivo", 50);
    const typewriter2 = new Typewriter("typewriter-text-2", "con Mentores Internacionales", 50);
    const heroFrames = document.querySelectorAll(".hero-frame");

    // Slide Data
    const slides = [
        { imgIndex: 0, line1: "Formación en Vivo", line2: "con Mentores Internacionales" },
        { imgIndex: 1, line1: "Certificaciones Profesionales", line2: "para Impulsar tu Empleabilidad" },
    ];
    let currentSlide = 0;

    function showSlide(index) {
        if (window.innerWidth < 768) return; // Disable animation logic on mobile (static text)

        const slide = slides[index];

        // Change Image
        heroFrames.forEach((frame, i) => {
            frame.classList.toggle("active", i === slide.imgIndex);
        });

        // Typewriter Animation
        typewriter1.reset();
        typewriter2.reset();

        // Slight delay to settle layout
        setTimeout(() => {
            typewriter1.setText(slide.line1);
            typewriter2.setText(slide.line2);
            typewriter1.start();

            // Start second line after first is approx done (simple calculation)
            const delay2 = slide.line1.length * 50 + 300;
            setTimeout(() => typewriter2.start(), delay2);
        }, 100);
    }

    function startSlideLoop() {
        if (window.innerWidth < 768) return;

        setInterval(() => {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }, 6000); // 6 seconds per slide
    }

    function checkMobileTypewriter() {
        if (window.innerWidth <= 768) {
            // Static text for mobile
            const l1 = document.getElementById("typewriter-text-1");
            const l2 = document.getElementById("typewriter-text-2");
            if (l1) l1.textContent = slides[0].line1;
            if (l2) l2.textContent = slides[0].line2;
        }
    }

    // Start Hero Logic
    checkMobileTypewriter();
    if (window.innerWidth > 768 && heroFrames.length > 0) {
        // Initial start
        showSlide(0);
        startSlideLoop();
    }


    // 4. ANIMATIONS (IntersectionObserver)
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-active');

                // Stagger children keys
                if (entry.target.dataset.animate === 'stagger') {
                    const children = entry.target.querySelectorAll('[data-animate-child]');
                    children.forEach((child, i) => {
                        setTimeout(() => {
                            child.classList.add('animate-active');
                        }, i * 150);
                    });
                }
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe data-animate elements
    // Note: I will update CSS to handle .animate-active
    document.querySelectorAll('[data-animate]').forEach(el => {
        // Pre-set style for JS fade-in if not handled by CSS class only
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.8s ease-out, transform 0.8s ease-out';
        observer.observe(el);
    });

    // Inject CSS for the animation if needed, or handle inline here
    const style = document.createElement('style');
    style.innerHTML = `
        .animate-active { opacity: 1 !important; transform: translateY(0) !important; }
        [data-animate-card] { opacity: 0; transform: translateY(20px); transition: all 0.6s ease-out; }
        [data-animate-card].visible { opacity: 1; transform: translateY(0); }
    `;
    document.head.appendChild(style);

    // Separate observer for cards
    const cardObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                cardObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('[data-animate-card]').forEach(el => cardObserver.observe(el));


    // 5. MOBILE MENU
    const menuToggle = document.getElementById("menuToggle");
    const mobileMenu = document.getElementById("mobileMenu");

    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
            const isOpen = !mobileMenu.classList.contains("hidden");
            menuToggle.innerHTML = isOpen
                ? '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>'
                : '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>';
        });

        // Close on link click
        mobileMenu.querySelectorAll("a").forEach(link => {
            link.addEventListener("click", () => {
                mobileMenu.classList.add("hidden");
                menuToggle.innerHTML = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>';
            });
        });
    }

});
