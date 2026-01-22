{{-- resources/views/page/index.blade.php --}}
<!DOCTYPE html>
<html lang="es" class="scroll-smooth">

<head>
  <meta charset="UTF-8">

  {{-- ✅ CSRF para axios POST --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="icon" type="image/png" href="{{ asset('assets/logo.png') }}">
  <title>CEIPP | Certificaciones Profesionales</title>

  <meta name="description"
    content="CEIPP: Centro Integral de Formación y Especialización Profesional. Cursos, diplomados y certificaciones con respaldo institucional.">
  <meta name="robots" content="index,follow,max-snippet:-1,max-image-preview:large,max-video-preview:-1">
  <meta name="author" content="CEIPP">

  <meta property="og:title" content="CEIPP | Certificaciones Profesionales">
  <meta property="og:description"
    content="Cursos, diplomados y certificaciones con respaldo institucional. Mejora tu perfil profesional con CEIPP.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url('/') }}">
  <meta property="og:image" content="{{ asset('assets/logo.png') }}">

  <link rel="stylesheet" href="{{ mix('css/tailwind.css') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700&family=Manrope:wght@400;500;600&display=swap"
    rel="stylesheet">

  <style>
    /* CSS Variable for dynamic header height */
    :root {
      --header-h: 80px;
      scroll-padding-top: calc(var(--header-h) - 24px);
    }

    html {
      scroll-padding-top: calc(var(--header-h) - 24px);
    }

    /* ✅ HERO SLIDES */
    .hero-frame {
      opacity: 0;
      transition: opacity 1800ms ease;
    }

    .hero-frame.active {
      opacity: 1;
    }

    body {
      font-family: 'Manrope', system-ui, sans-serif;
      background-color: #f8fafc;
      color: #1e293b;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* ✅ NAV active pill */
    .nav-link {
      padding: 8px 12px;
      border-radius: 9999px;
      position: relative;
    }

    .nav-link.active {
      color: #fff !important;
      background: rgba(255, 255, 255, .10);
      border: 1px solid rgba(255, 255, 255, .14);
      box-shadow: 0 8px 20px rgba(0, 0, 0, .14);
      backdrop-filter: blur(10px);
    }

    .nav-link-mobile.active {
      background: rgba(255, 255, 255, .10);
      border: 1px solid rgba(255, 255, 255, .14);
    }

    /* FIX: Hero title typewriter text wrapping
     * PROBLEMA: max-width: 20ch causaba que el texto se cortara durante la animación
     * ("con Mentore…") porque forzaba wrapping antes de terminar de escribir.
     * SOLUCIÓN:
     * - Removido max-width: 20ch
     * - Desktop (md+): white-space: nowrap para evitar cortes durante typewriter
     * - Mobile (<md): white-space: normal para permitir wrap y evitar desborde
     * - min-height reserva espacio para evitar "saltos" de layout al cambiar slides
     */
    .hero-title {
      /* FIX: Reservar altura fija reducida */
      min-height: 80px;
    }

    @media (min-width: 768px) {
      .hero-title {
        min-height: 90px;
      }
    }

    @media (min-width: 1024px) {
      .hero-title {
        min-height: 100px;
      }
    }

    .hero-title .typewriter-line {
      display: block;
      line-height: 1.05;
      /* FIX: En desktop, sin wrapping para que typewriter se vea fluido */
      white-space: nowrap;
    }

    /* FIX: En mobile, permite wrapping para evitar desborde horizontal */
    @media (max-width: 767px) {
      .hero-title .typewriter-line {
        white-space: normal;
        word-break: break-word;
      }
    }
  </style>
</head>

<body class="bg-white text-gray-900 antialiased min-h-screen flex flex-col">
  <div id="app" class="flex flex-col min-h-screen">

    <!-- CHANGED: Header now integrates with hero background -->
    <!-- CHANGED: Header with fixed gradient and shadow, now STICKY -->
    <header id="mainHeader" class="sticky top-0 z-50
           bg-gradient-to-r from-[#062b33] via-[#0b3f45] to-[#0c5660]
           bg-opacity-100
           shadow-[0_10px_30px_rgba(0,0,0,0.25)]
           transition-all duration-300">
      <div class="container mx-auto max-w-7xl px-4 md:px-6">
        <div class="flex items-center justify-between py-2.5 lg:py-2 relative">
          <!-- Logo -->
          <div class="flex-shrink-0">
            <button type="button" id="logoBtn" class="flex items-center gap-3 group" aria-label="Ir al inicio">
              <span
                class="inline-flex items-center justify-center rounded-xl bg-white/5 backdrop-blur-md ring-1 ring-white/10 px-3 py-2 transition-all duration-300 group-hover:bg-white/10">
                <img src="{{ asset('assets/logo-header.png') }}" alt="CEIPP Logo"
                  class="h-8 w-auto object-contain drop-shadow-md transition-all duration-300" id="headerLogo">
              </span>
            </button>
          </div>

          <!-- CHANGED: Desktop Navigation - white text for dark background -->
          <!-- CHANGED: Desktop Navigation - active pills -->
          <nav class="hidden lg:flex items-center gap-4 xl:gap-6 absolute left-1/2 -translate-x-1/2" id="siteNav">
            <a href="#inicio"
              class="nav-link text-white/90 hover:text-white transition-all duration-300 text-[13px] font-semibold relative">
              Inicio
            </a>
            <a href="#nosotros"
              class="nav-link text-white/90 hover:text-white transition-all duration-300 text-[13px] font-semibold relative">
              Nosotros
            </a>
            <a href="#cursos"
              class="nav-link text-white/90 hover:text-white transition-all duration-300 text-[13px] font-semibold relative">
              Cursos
            </a>
            <a href="#contactos"
              class="nav-link text-white/90 hover:text-white transition-all duration-300 text-[13px] font-semibold relative">
              Contactos
            </a>
            <a href="#verificar"
              class="nav-link text-white/90 hover:text-white transition-all duration-300 text-[13px] font-semibold relative">
              Verificar
            </a>
          </nav>



          <!-- CHANGED: Mobile Menu Toggle - white icon -->
          <button class="lg:hidden text-white text-2xl p-2 hover:bg-white/10 rounded-lg transition-colors"
            id="menuToggle" aria-label="Abrir menú">
            <span id="menuIcon">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
              </svg>
            </span>
          </button>
        </div>

        <!-- CHANGED: Mobile Menu - dark background -->
        <div class="lg:hidden hidden overflow-hidden transition-all duration-300" id="mobileMenu">
          <nav class="py-4 space-y-1 border-t border-white/10">
            <a href="#inicio"
              class="nav-link-mobile block px-4 py-3 text-white/90 hover:bg-white/10 hover:text-[#f1841a] rounded-lg transition-all duration-200 font-medium">
              Inicio
            </a>
            <a href="#nosotros"
              class="nav-link-mobile block px-4 py-3 text-white/90 hover:bg-white/10 hover:text-[#f1841a] rounded-lg transition-all duration-200 font-medium">
              Nosotros
            </a>
            <a href="#cursos"
              class="nav-link-mobile block px-4 py-3 text-white/90 hover:bg-white/10 hover:text-[#f1841a] rounded-lg transition-all duration-200 font-medium">
              Cursos
            </a>
            <a href="#contactos"
              class="nav-link-mobile block px-4 py-3 text-white/90 hover:bg-white/10 hover:text-[#f1841a] rounded-lg transition-all duration-200 font-medium">
              Contactos
            </a>
            <a href="#verificar"
              class="nav-link-mobile block px-4 py-3 text-white/90 hover:bg-white/10 hover:text-[#f1841a] rounded-lg transition-all duration-200 font-medium">
              Verificar
            </a>

          </nav>
        </div>
      </div>
    </header>

    <!-- HERO SECTION: Premium Layout (Header + Hero = 100vh) -->
    <section class="hero relative flex flex-col justify-center flex-1 overflow-hidden bg-[#062b33]" id="inicio"
      style="min-height: calc(100vh - var(--header-h));">
      <!-- Background Pattern -->
      <div class="absolute inset-0 opacity-10 pointer-events-none">
        <div class="absolute inset-0"
          style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;">
        </div>
      </div>

      <!-- CHANGED: Hero Image Background - full opacity for active image -->
      <div class="hero-image parallax-bg absolute inset-0 z-0">
        <img class="hero-frame hero-frame-1 active absolute inset-0 w-full h-full object-cover object-center"
          src="{{ asset('img/hero.png') }}" alt="Profesionales en certificación"
          onerror="this.style.display='none'; this.parentNode.style.background='linear-gradient(135deg, #0b3f45 0%, #0c5660 100%)'">
        <img class="hero-frame hero-frame-2 absolute inset-0 w-full h-full object-cover object-center"
          src="{{ asset('img/hero2.png') }}" alt="Profesionales en certificación 2" onerror="this.style.display='none'">
      </div>

      <!-- CHANGED: Overlay -> specific premium gradient requested -->
      <div
        class="hero-overlay absolute inset-0 z-10 bg-gradient-to-r from-[#0b3f45]/70 via-[#0b3f45]/35 to-transparent">
      </div>

      <!-- extra overlay leve arriba para efecto “barra” -->
      <div
        class="absolute inset-0 z-10 pointer-events-none bg-gradient-to-b from-[#0b3f45]/40 via-transparent to-transparent">
      </div>

      <!-- CHANGED: Content fits in viewport, better spacing, max-w-6xl for premium feel -->
      <div class="container mx-auto max-w-7xl px-4 md:px-6 relative z-20 h-full">
        <div class="grid lg:grid-cols-12 gap-8 h-full items-center">

          <!-- IZQUIERDA: Texto -->
          <div class="lg:col-span-7 flex flex-col gap-6 justify-center h-full pt-6 lg:pt-0">
            <div class="hero-text text-white text-left">
              <span
                class="eyebrow animate-fade-in inline-block text-xs font-bold uppercase tracking-widest text-white/80 mb-3">
                Centro Internacional de certificación
              </span>

              <h1 class="hero-title font-black text-3xl md:text-3xl lg:text-4xl leading-tight mb-2 tracking-tight">
                <span id="typewriter-text-1" class="typewriter-line block text-white"></span>
                <span id="typewriter-text-2"
                  class="typewriter-line highlight block bg-gradient-to-r from-[#f1841a] to-[#ff9a3d] bg-clip-text text-transparent"></span>
              </h1>

              <p
                class="hero-lead animate-fade-in delay-2 text-base md:text-lg text-white/90 leading-relaxed mb-6 max-w-xl">
                Mejora tu perfil profesional con nuestras certificaciones avaladas. Alianzas con universidades líderes.
              </p>

              <!-- New Buttons -->
              <div class="flex flex-wrap gap-4 animate-fade-in delay-2">
                <a href="#cursos"
                  class="group inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#f1841a] to-[#ff9a3d] text-white font-bold rounded-xl hover:shadow-[0_10px_30px_rgba(241,132,26,0.3)] transition-all duration-300 transform hover:-translate-y-1">
                  <span>Ver Cursos</span>
                  <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                    </path>
                  </svg>
                </a>
                <a href="#contactos"
                  class="inline-flex items-center gap-2 px-6 py-3 border border-white/20 text-white font-bold rounded-xl hover:bg-white/10 hover:border-white/40 backdrop-blur-sm transition-all duration-300">
                  <span>Contactarnos</span>
                </a>
              </div>
            </div>
          </div>

          <!-- DERECHA: Form abajo -->
          <div class="lg:col-span-5 h-full flex flex-col justify-end pb-0 lg:pb-0 lg:translate-y-32">
            <div class="w-full animate-fade-in delay-3 lg:ml-auto lg:max-w-md">
              <div
                class="rounded-3xl bg-white/10 backdrop-blur-md border border-white/15 shadow-[0_20px_60px_rgba(0,0,0,0.35)] p-4 md:p-5">
                <div class="mb-2 flex items-center justify-between">
                  <div>
                    <h3 class="text-white text-base font-bold leading-tight">Crea tu cuenta</h3>
                    <p class="text-white/70 text-[11px] mt-0.5">Accede a programas y certificaciones.</p>
                  </div>

                  <div class="p-2 rounded-full bg-white/5 border border-white/10">
                    <svg class="w-4 h-4 text-[#f1841a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                  </div>
                </div>

                <register-form></register-form>
              </div>
            </div>
          </div>

        </div>

        <!-- Scroll indicator -->
        <a href="#servicios"
          class="absolute -bottom-24 left-1/2 -translate-x-1/2 z-20 animate-bounce p-2 text-white/40 hover:text-white transition-colors">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
          </svg>
        </a>
    </section>

    <!-- SERVICES -->
    <section class="pt-14 pb-24 bg-white relative" id="servicios" data-animate>
      <!-- Decorated background element -->
      <div
        class="absolute top-0 right-0 w-1/3 h-1/3 bg-gradient-to-bl from-teal-50 to-transparent rounded-bl-full opacity-50 pointer-events-none">
      </div>

      <div class="container mx-auto px-4 md:px-6 relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-16">
          <span
            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-teal-50 text-teal-700 text-xs font-bold uppercase tracking-wide mb-4 border border-teal-100">
            <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span> Nuestos Servicios
          </span>
          <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-900 mb-4 tracking-tight">Formación de
            Excelencia</h2>
          <p class="text-lg text-slate-600">Impulsamos tu carrera con programas certificados y metodología práctica.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <!-- Service 1 -->
          <div
            class="group relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:-translate-y-2"
            data-animate-card>
            <div
              class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-[#f1841a]/10 to-transparent rounded-bl-full">
            </div>
            <div class="relative">
              <div
                class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[#f1841a] to-[#ff9a3d] flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-orange-500/30">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                  </path>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-gray-900 mb-3">Cursos Certificados</h3>
              <p class="text-gray-600 mb-6 leading-relaxed">Rutas cortas y verificables con acompañamiento experto y
                material aplicado.</p>
              <a href="#cursos"
                class="inline-flex items-center gap-2 text-[#f1841a] font-semibold hover:gap-3 transition-all duration-300 group">
                Descubrir Cursos
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </a>
            </div>
          </div>

          <!-- Service 2 -->
          <div
            class="group relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:-translate-y-2"
            data-animate-card>
            <div
              class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-[#0c5660]/10 to-transparent rounded-bl-full">
            </div>
            <div class="relative">
              <div
                class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[#0c5660] to-[#0b3f45] flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-teal-500/30">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                  <path
                    d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                  </path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222">
                  </path>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-gray-900 mb-3">Diplomados Especializados</h3>
              <p class="text-gray-600 mb-6 leading-relaxed">Programas integrales con mentoría, evaluación y
                certificación
                orientada al mercado.</p>
              <a href="#cursos"
                class="inline-flex items-center gap-2 text-[#0c5660] font-semibold hover:gap-3 transition-all duration-300 group">
                Ver Diplomados
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </a>
            </div>
          </div>

          <!-- Service 3 -->
          <div
            class="group relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:-translate-y-2 md:col-span-2 lg:col-span-1"
            data-animate-card>
            <div
              class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-[#f1841a]/10 to-transparent rounded-bl-full">
            </div>
            <div class="relative">
              <div
                class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[#f1841a] to-[#ff9a3d] flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-orange-500/30">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                  </path>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-gray-900 mb-3">Congresos y Talleres</h3>
              <p class="text-gray-600 mb-6 leading-relaxed">Eventos en vivo para conectar con expertos, tendencias y
                redes
                profesionales.</p>
              <a href="#cursos"
                class="inline-flex items-center gap-2 text-[#f1841a] font-semibold hover:gap-3 transition-all duration-300 group">
                Ver Eventos
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- NOSOTROS -->
    <section class="pt-14 pb-24 bg-slate-50 relative overflow-hidden" id="nosotros" data-animate>
      <div class="container mx-auto px-4 md:px-6 relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-16">
          <span
            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-200 text-slate-700 text-xs font-bold uppercase tracking-wide mb-4 border border-slate-300">
            <span class="w-1.5 h-1.5 rounded-full bg-slate-500"></span> Sobre Nosotros
          </span>
          <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-900 mb-4 tracking-tight">Misión y Visión</h2>
          <p class="text-lg text-slate-600">Comprometidos con la excelencia educativa y el desarrollo profesional en el
            Perú.</p>
        </div>

        <!-- Mission & Vision Cards -->
        <div class="grid md:grid-cols-2 gap-8 mb-20">
          <!-- Mission -->
          <div
            class="group relative rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-1"
            data-animate-card>
            <div class="absolute inset-0 bg-[#062b33]"></div>
            <div class="absolute inset-0 opacity-20 group-hover:opacity-30 transition-opacity duration-500">
              <img src="{{ asset('assets/mision.png') }}" alt="Misión" class="w-full h-full object-cover">
            </div>
            <div class="relative p-10 text-white h-full flex flex-col">
              <div
                class="w-14 h-14 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center mb-6">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z">
                  </path>
                </svg>
              </div>
              <h3 class="text-2xl font-bold mb-4 tracking-tight">Nuestra Misión</h3>
              <p class="text-white/80 leading-relaxed text-lg">Somos una empresa académica dedicada a brindar
                capacitaciones a profesionales y técnicos, fortaleciendo competencias para una mayor competitividad
                laboral.</p>
            </div>
          </div>

          <!-- Vision -->
          <div
            class="group relative rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-1"
            data-animate-card>
            <div class="absolute inset-0 bg-gradient-to-br from-[#f1841a] to-[#ff9a3d]"></div>
            <div class="absolute inset-0 opacity-20 group-hover:opacity-30 transition-opacity duration-500">
              <img src="{{ asset('assets/vision.png') }}" alt="Visión" class="w-full h-full object-cover">
            </div>
            <div class="relative p-10 text-white h-full flex flex-col">
              <div
                class="w-14 h-14 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center mb-6">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                  </path>
                </svg>
              </div>
              <h3 class="text-2xl font-bold mb-4 tracking-tight">Nuestra Visión</h3>
              <p class="text-white/80 leading-relaxed text-lg">Ser la plataforma líder en capacitación moderna y
                sostenible, promoviendo el aprendizaje autónomo con contenidos actualizados.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CURSOS -->
    <section class="pt-14 pb-24 bg-white" id="cursos" data-animate>
      <div class="container mx-auto px-4 md:px-6">
        <div class="text-center max-w-2xl mx-auto mb-16">
          <span
            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-orange-50 text-orange-600 text-xs font-bold uppercase tracking-wide mb-4 border border-orange-100">
            <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span> Programas
          </span>
          <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-900 mb-4 tracking-tight">Cursos y
            Certificaciones</h2>
          <p class="text-lg text-slate-600">Explora nuestra oferta académica y especialízate con los mejores.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          @foreach ($courses as $row)
            <article
              class="group bg-white rounded-2xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1"
              data-animate-card>
              <div class="relative h-56 overflow-hidden">
                <img src="{{ $row->image_url }}"
                  class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                  alt="{{ $row->titulo }}"
                  onerror="this.style.opacity='0.3'; this.parentElement.style.backgroundColor='#062b33'">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-80">
                </div>
                <span
                  class="absolute top-4 right-4 px-3 py-1 bg-white/90 backdrop-blur-sm text-slate-900 text-xs font-bold rounded-full shadow-sm">{{ $row->subtitulo }}</span>
              </div>

              <div class="p-8">
                <h3
                  class="text-xl font-bold text-slate-900 mb-3 line-clamp-2 leading-tight group-hover:text-[#0c5660] transition-colors">
                  {{ $row->titulo }}
                </h3>
                <div class="text-slate-600 text-sm mb-6 line-clamp-3 leading-relaxed opacity-90">{!! $row->description !!}
                </div>

                <a href="#contactos"
                  class="inline-flex w-full items-center justify-center gap-2 px-6 py-3 bg-slate-50 text-slate-700 rounded-xl font-semibold text-sm hover:bg-[#f1841a] hover:text-white transition-all duration-300 group-btn">
                  Solicitar Información
                  <svg class="w-4 h-4 transition-transform group-hover/btn:translate-x-1" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                    </path>
                  </svg>
                </a>
              </div>
            </article>
          @endforeach
        </div>
      </div>
    </section>

    <!-- CONTACTOS -->
    <section class="pt-14 pb-24 bg-slate-50 relative" id="contactos" data-animate>
      <div class="container mx-auto px-4 md:px-6">
        <div class="text-center max-w-2xl mx-auto mb-16">
          <span
            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-200 text-slate-700 text-xs font-bold uppercase tracking-wide mb-4 border border-slate-300">
            <span class="w-1.5 h-1.5 rounded-full bg-slate-500"></span> Contáctanos
          </span>
          <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-900 mb-4 tracking-tight">¿Listo para empezar?
          </h2>
          <p class="text-lg text-slate-600">Escríbenos para recibir información detallada sobre nuestros programas o
            convenios.</p>
        </div>

        <div class="grid lg:grid-cols-2 gap-12">
          <!-- Contact Form -->
          <div class="bg-gradient-to-br from-gray-50 to-white rounded-3xl p-8 md:p-10 shadow-xl border border-gray-100"
            data-animate-card>
            <form onsubmit="event.preventDefault(); alert('Formulario enviado (demo).');" class="space-y-6">
              <div>
                <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">Nombre completo</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                  </div>
                  <input id="name" type="text" required placeholder="Tu nombre completo"
                    class="w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-xl focus:border-[#0c5660] focus:ring-4 focus:ring-[#0c5660]/10 outline-none transition-all duration-300 text-gray-900">
                </div>
              </div>

              <div>
                <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">Correo Electrónico</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                      </path>
                    </svg>
                  </div>
                  <input id="email" type="email" required placeholder="correo@dominio.com"
                    class="w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-xl focus:border-[#0c5660] focus:ring-4 focus:ring-[#0c5660]/10 outline-none transition-all duration-300 text-gray-900">
                </div>
              </div>

              <button type="submit"
                class="w-full px-8 py-4 bg-gradient-to-r from-[#f1841a] to-[#ff9a3d] text-white rounded-xl font-semibold text-base hover:shadow-2xl hover:shadow-orange-500/40 transition-all duration-300 hover:-translate-y-1 flex items-center justify-center gap-2">
                Enviar solicitud
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                  </path>
                </svg>
              </button>
            </form>
          </div>

          <!-- Contact Info -->
          <div class="space-y-6" data-animate-card>
            <div class="bg-gradient-to-br from-[#0b3f45] to-[#0c5660] rounded-3xl p-8 md:p-10 text-white shadow-2xl">
              <h3 class="text-2xl font-bold mb-2">CEIPP</h3>
              <p class="text-white/90 mb-8 leading-relaxed text-sm">
                Centro Integral de Formación y Especialización Profesional del Pacífico. Brindando educación de calidad
                para el desarrollo profesional y empresarial en el Perú.
              </p>

              <div class="space-y-4">
                <div class="flex items-start gap-4">
                  <div
                    class="w-10 h-10 rounded-lg bg-white/10 backdrop-blur-sm flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-[#f1841a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                      </path>
                    </svg>
                  </div>
                  <div>
                    <p class="text-xs font-semibold text-white/60 uppercase mb-1">Email</p>
                    <p class="text-sm text-white">escueladeprofesionalesdelperu@gmail.com</p>
                  </div>
                </div>

                <div class="flex items-start gap-4">
                  <div
                    class="w-10 h-10 rounded-lg bg-white/10 backdrop-blur-sm flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-[#f1841a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                      </path>
                    </svg>
                  </div>
                  <div>
                    <p class="text-xs font-semibold text-white/60 uppercase mb-1">Teléfono</p>
                    <p class="text-sm text-white">960938621</p>
                  </div>
                </div>

                <div class="flex items-start gap-4">
                  <div
                    class="w-10 h-10 rounded-lg bg-white/10 backdrop-blur-sm flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-[#f1841a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                  </div>
                  <div>
                    <p class="text-xs font-semibold text-white/60 uppercase mb-1">Horario</p>
                    <p class="text-sm text-white">Lunes a viernes 08:00 - 19:00<br>Sábados 09:00 - 14:00</p>
                  </div>
                </div>

                <div class="flex items-start gap-4">
                  <div
                    class="w-10 h-10 rounded-lg bg-white/10 backdrop-blur-sm flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-[#f1841a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                  </div>
                  <div>
                    <p class="text-xs font-semibold text-white/60 uppercase mb-1">Dirección</p>
                    <p class="text-sm text-white">Av. Cusco 1440, Ayacucho-San Juan Bautista</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Map -->
            <div class="rounded-2xl overflow-hidden shadow-xl">
              <iframe title="Mapa de ubicación"
                src="https://www.google.com/maps?q=Av.%20Cusco%201440,%20Ayacucho-San%20Juan%20Bautista%20Ayacucho%20Peru&output=embed"
                width="100%" height="300" style="border:0;" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- ✅ Vue Root content --}}
    <!-- VERIFICAR -->
    <section class="pt-14 pb-24 bg-gradient-to-b from-white to-gray-50" id="verificar" data-animate>
      <div class="container mx-auto px-4 md:px-6">
        <div class="text-center max-w-3xl mx-auto mb-16">
          <div class="inline-flex items-center gap-2 px-4 py-2 bg-[#0c5660]/10 rounded-full mb-4">
            <svg class="w-5 h-5 text-[#0c5660]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
              </path>
            </svg>
            <span class="text-[#0c5660] text-sm font-semibold">Verificación de Certificados</span>
          </div>
          <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Verifica tu Certificado</h2>
          <p class="text-lg text-gray-600">Ingresa tu número de DNI para verificar la autenticidad de tu certificado.
          </p>
        </div>

        <div class="max-w-4xl mx-auto">
          <div class="bg-white rounded-3xl p-8 md:p-10 shadow-xl border border-gray-100">
            <div class="flex items-start gap-4 p-4 bg-blue-50 border border-blue-200 rounded-xl mb-8">
              <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              <div>
                <h4 class="font-semibold text-blue-900 mb-1">Sistema de Verificación</h4>
                <p class="text-sm text-blue-700">Todos nuestros certificados cuentan con un código único de
                  verificación. Ingresa tu DNI para validar la autenticidad.</p>
              </div>
            </div>

            {{-- ✅ Vue component --}}
            <verify-certificate></verify-certificate>
          </div>
        </div>
      </div>
    </section>

    <!-- REGISTRARME -->
    <section class="pt-14 pb-24 bg-white" id="registrarme" data-animate>
      <div class="container mx-auto px-4 md:px-6">
        <div class="text-center max-w-3xl mx-auto mb-16">
          <div class="inline-flex items-center gap-2 px-4 py-2 bg-[#f1841a]/10 rounded-full mb-4">
            <svg class="w-5 h-5 text-[#f1841a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
            </svg>
            <span class="text-[#f1841a] text-sm font-semibold">Registro de Estudiantes</span>
          </div>
          <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Comienza tu Formación</h2>
          <p class="text-lg text-gray-600">Regístrate ahora y accede a nuestros programas de certificación profesional.
          </p>
        </div>

        <div class="max-w-4xl mx-auto text-center">
          <p class="text-gray-500 mb-6">El formulario de registro también está disponible en la sección principal.</p>
          <a href="#inicio" class="inline-flex items-center gap-2 text-[#f1841a] font-semibold hover:underline">
            Ir al formulario de arriba
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18">
              </path>
            </svg>
          </a>

          {{-- OPTIONAL: Keep it here too if desired, but commented out to avoid duplicate ID issues if any --}}
          {{-- <register-form></register-form> --}}
        </div>
      </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gradient-to-br from-[#0b3f45] to-[#0c5660] text-white pt-16 pb-8">
      <div class="container mx-auto px-4 md:px-6">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
          <!-- Brand -->
          <div class="lg:col-span-2">
            <img src="{{ asset('assets/ceipp-logo.png') }}" alt="CEIPP Logo" class="h-12 mb-4">
            <p class="text-white/80 mb-6 max-w-md leading-relaxed">
              Centro Integral de Formación y Especialización Profesional del Pacífico. Transformando vidas a través de
              la
              educación de calidad.
            </p>
            <div class="flex gap-3">
              <a href="#"
                class="w-10 h-10 rounded-lg bg-white/10 hover:bg-white/20 flex items-center justify-center transition-colors">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path
                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                </svg>
              </a>
              <a href="#"
                class="w-10 h-10 rounded-lg bg-white/10 hover:bg-white/20 flex items-center justify-center transition-colors">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path
                    d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                </svg>
              </a>
              <a href="#"
                class="w-10 h-10 rounded-lg bg-white/10 hover:bg-white/20 flex items-center justify-center transition-colors">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path
                    d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z" />
                </svg>
              </a>
            </div>
          </div>

          <!-- Quick Links -->
          <div>
            <h4 class="text-lg font-bold mb-4">Enlaces Rápidos</h4>
            <ul class="space-y-3">
              <li><a href="#inicio" class="text-white/80 hover:text-white transition-colors">Inicio</a></li>
              <li><a href="#nosotros" class="text-white/80 hover:text-white transition-colors">Nosotros</a></li>
              <li><a href="#cursos" class="text-white/80 hover:text-white transition-colors">Cursos</a></li>
              <li><a href="#contactos" class="text-white/80 hover:text-white transition-colors">Contactos</a></li>
            </ul>
          </div>

          <!-- Services -->
          <div>
            <h4 class="text-lg font-bold mb-4">Servicios</h4>
            <ul class="space-y-3">
              <li><a href="#cursos" class="text-white/80 hover:text-white transition-colors">Cursos Certificados</a>
              </li>
              <li><a href="#cursos" class="text-white/80 hover:text-white transition-colors">Diplomados</a></li>
              <li><a href="#cursos" class="text-white/80 hover:text-white transition-colors">Talleres</a></li>
              <li><a href="#verificar" class="text-white/80 hover:text-white transition-colors">Verificar
                  Certificado</a>
              </li>
            </ul>
          </div>
        </div>

        <div class="border-t border-white/10 pt-8 text-center text-white/60 text-sm">
          <p>© <span id="year"></span> CEIPP. Todos los derechos reservados.</p>
        </div>
      </div>
    </footer>

  </div> <!-- VUE APP END -->

  {{-- Scripts --}}
  <script src="{{ mix('js/app.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>