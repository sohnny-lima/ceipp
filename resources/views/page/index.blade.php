{{-- resources/views/page/index.blade.php --}}
<!DOCTYPE html>
<html lang="es" class="scroll-smooth">

<head>
  <meta charset="UTF-8">

  {{-- ✅ CSRF para axios POST --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
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
  <meta property="og:image" content="{{ asset('assets/ceipp-logo.png') }}">

  <link rel="stylesheet" href="{{ mix('css/tailwind.css') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin">
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Poppins:wght@600;700;800&display=swap"
    rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', system-ui, sans-serif;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>

<body class="bg-white text-gray-900 antialiased">

  <!-- HEADER -->
  <header class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-white/95 backdrop-blur-md shadow-sm"
    id="mainHeader">
    <div class="container mx-auto px-4 md:px-6">
      <div class="flex items-center justify-between py-3 md:py-4">
        <!-- Logo -->
        <div class="flex-shrink-0">
          <a href="#inicio" class="block">
            <img src="{{ asset('assets/ceipp-logo.png') }}" alt="CEIPP Logo"
              class="h-10 md:h-12 transition-all duration-300" id="headerLogo">
          </a>
        </div>

        <!-- Desktop Navigation -->
        <nav class="hidden lg:flex items-center gap-8" id="siteNav">
          <a href="#inicio"
            class="text-gray-700 hover:text-[#0b3f45] transition-colors duration-300 text-sm font-semibold relative group">
            Inicio
            <span
              class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#f1841a] transition-all duration-300 group-hover:w-full"></span>
          </a>
          <a href="#nosotros"
            class="text-gray-700 hover:text-[#0b3f45] transition-colors duration-300 text-sm font-semibold relative group">
            Nosotros
            <span
              class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#f1841a] transition-all duration-300 group-hover:w-full"></span>
          </a>
          <a href="#cursos"
            class="text-gray-700 hover:text-[#0b3f45] transition-colors duration-300 text-sm font-semibold relative group">
            Cursos
            <span
              class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#f1841a] transition-all duration-300 group-hover:w-full"></span>
          </a>
          <a href="#contactos"
            class="text-gray-700 hover:text-[#0b3f45] transition-colors duration-300 text-sm font-semibold relative group">
            Contactos
            <span
              class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#f1841a] transition-all duration-300 group-hover:w-full"></span>
          </a>
          <a href="#verificar"
            class="text-gray-700 hover:text-[#0b3f45] transition-colors duration-300 text-sm font-semibold relative group">
            Verificar
            <span
              class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#f1841a] transition-all duration-300 group-hover:w-full"></span>
          </a>
        </nav>

        <!-- Desktop CTA Buttons -->
        <div class="hidden lg:flex items-center gap-3">
          <a href="{{ url('/login') }}" target="_blank" rel="noopener"
            class="px-5 py-2 rounded-lg text-gray-700 text-sm font-semibold hover:bg-gray-100 transition-all duration-300">
            Iniciar Sesión
          </a>
          <a href="#registrarme"
            class="px-5 py-2 rounded-lg bg-gradient-to-r from-[#f1841a] to-[#ff9a3d] text-white text-sm font-semibold hover:shadow-lg hover:shadow-orange-500/30 transition-all duration-300 hover:-translate-y-0.5">
            Registrarme
          </a>
        </div>

        <!-- Mobile Menu Toggle -->
        <button class="lg:hidden text-gray-700 text-2xl p-2 hover:bg-gray-100 rounded-lg transition-colors"
          id="menuToggle" aria-label="Abrir menú">
          <span id="menuIcon">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
          </span>
        </button>
      </div>

      <!-- Mobile Menu -->
      <div class="lg:hidden hidden overflow-hidden transition-all duration-300" id="mobileMenu">
        <nav class="py-4 space-y-1 border-t border-gray-100">
          <a href="#inicio"
            class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#0b3f45] rounded-lg transition-all duration-200 font-medium">
            Inicio
          </a>
          <a href="#nosotros"
            class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#0b3f45] rounded-lg transition-all duration-200 font-medium">
            Nosotros
          </a>
          <a href="#cursos"
            class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#0b3f45] rounded-lg transition-all duration-200 font-medium">
            Cursos
          </a>
          <a href="#contactos"
            class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#0b3f45] rounded-lg transition-all duration-200 font-medium">
            Contactos
          </a>
          <a href="#verificar"
            class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#0b3f45] rounded-lg transition-all duration-200 font-medium">
            Verificar
          </a>
          <div class="pt-4 space-y-2 border-t border-gray-100 mt-2">
            <a href="{{ url('/login') }}" target="_blank" rel="noopener"
              class="block px-4 py-3 text-center rounded-lg text-gray-700 font-semibold hover:bg-gray-100 transition-all duration-200">
              Iniciar Sesión
            </a>
            <a href="#registrarme"
              class="block px-4 py-3 text-center rounded-lg bg-gradient-to-r from-[#f1841a] to-[#ff9a3d] text-white font-semibold hover:shadow-lg transition-all duration-200">
              Registrarme
            </a>
          </div>
        </nav>
      </div>
    </div>
  </header>

  <!-- HERO -->
  <section
    class="relative min-h-screen bg-gradient-to-br from-[#0b3f45] via-[#0c5660] to-[#0b3f45] overflow-hidden pt-20 md:pt-24"
    id="inicio">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10 pointer-events-none">
      <div class="absolute inset-0"
        style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;">
      </div>
    </div>

    <!-- Hero Image Background (Parallax) -->
    <div class="hero-image parallax-bg absolute inset-0 z-0">
      <img
        class="hero-frame hero-frame-1 active absolute inset-0 w-full h-full object-cover object-center opacity-30 transition-opacity duration-[1800ms]"
        src="{{ asset('img/hero.png') }}" alt="Profesionales en certificación"
        onerror="this.style.display='none'; this.parentNode.style.background='linear-gradient(135deg, #0b3f45 0%, #0c5660 100%)'">
      <img
        class="hero-frame hero-frame-2 absolute inset-0 w-full h-full object-cover object-center opacity-0 transition-opacity duration-[1800ms]"
        src="{{ asset('img/hero2.png') }}" alt="Profesionales en certificación 2" onerror="this.style.display='none'">
    </div>

    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-[#0b3f45]/85 via-[#0b3f45]/60 to-[#0b3f45]/30 z-10"></div>

    <!-- Content -->
    <div class="container mx-auto px-4 md:px-6 relative z-20">
      <div class="grid lg:grid-cols-2 gap-12 items-center min-h-[calc(100vh-5rem)] py-12">
        <!-- Text Content -->
        <div class="text-white space-y-6">
          <div
            class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full border border-white/20">
            <svg class="w-4 h-4 text-[#f1841a]" fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
            </svg>
            <span class="text-xs font-semibold uppercase tracking-wider">Centro Internacional de Certificación</span>
          </div>

          <h1 class="hero-title font-black text-3xl md:text-4xl lg:text-5xl leading-tight">
            <span id="typewriter-text-1" class="typewriter-line block"></span>
            <span id="typewriter-text-2"
              class="typewriter-line block bg-gradient-to-r from-[#f1841a] to-[#ff9a3d] bg-clip-text text-transparent"></span>
          </h1>

          <p class="hero-lead text-base md:text-lg text-white/90 max-w-2xl leading-relaxed opacity-0">
            Mejora tu perfil profesional con nuestras certificaciones avaladas. Alianzas con universidades y empresas
            líderes.
          </p>

          <div class="hero-actions flex flex-wrap gap-4 pt-4">
            <a href="#cursos"
              class="animate-left group inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-[#f1841a] to-[#ff9a3d] text-white rounded-xl font-semibold text-base hover:shadow-2xl hover:shadow-orange-500/40 transition-all duration-300 hover:-translate-y-1 opacity-0">
              Ver Cursos
              <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6">
                </path>
              </svg>
            </a>
            <a href="#contactos"
              class="animate-right inline-flex items-center gap-2 px-8 py-4 border-2 border-white/30 backdrop-blur-sm text-white rounded-xl font-semibold text-base hover:bg-white/10 hover:border-white transition-all duration-300 opacity-0">
              Contactarnos
            </a>
          </div>

          <div class="hero-stats grid grid-cols-3 gap-6 pt-8 border-t border-white/20">
            <div class="stat-item opacity-0">
              <div class="text-3xl md:text-4xl font-bold text-[#f1841a]">+120</div>
              <div class="text-xs md:text-sm text-white/80 mt-1">Programas</div>
            </div>
            <div class="stat-item opacity-0">
              <div class="text-3xl md:text-4xl font-bold text-[#f1841a]">100%</div>
              <div class="text-xs md:text-sm text-white/80 mt-1">Certificado</div>
            </div>
            <div class="stat-item opacity-0">
              <div class="text-3xl md:text-4xl font-bold text-[#f1841a]">24/7</div>
              <div class="text-xs md:text-sm text-white/80 mt-1">Soporte</div>
            </div>
          </div>
        </div>

        <!-- Logo Column (Desktop only) -->
        <div class="hidden lg:flex items-center justify-center">
          <div class="hero-image-container relative w-full max-w-[520px] lg:max-w-[640px] mx-auto">
            <img
              class="hero-frame hero-frame-1 active w-full h-auto object-contain opacity-0 transition-opacity duration-[1800ms]"
              src="{{ asset('img/hero.png') }}" alt="Profesionales en certificación"
              onerror="this.style.display='none'">
            <img
              class="hero-frame hero-frame-2 absolute inset-0 w-full h-auto object-contain opacity-0 transition-opacity duration-[1800ms]"
              src="{{ asset('img/hero2.png') }}" alt="Profesionales en certificación 2"
              onerror="this.style.display='none'">
          </div>
        </div>
      </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 animate-bounce">
      <svg class="w-6 h-6 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
      </svg>
    </div>
  </section>

  <!-- SERVICES -->
  <section class="py-20 md:py-28 bg-gradient-to-b from-white to-gray-50" id="servicios" data-animate>
    <div class="container mx-auto px-4 md:px-6">
      <div class="text-center max-w-3xl mx-auto mb-16">
        <span
          class="inline-block px-4 py-2 bg-[#f1841a]/10 text-[#f1841a] rounded-full text-sm font-semibold mb-4">Nuestros
          Servicios</span>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Formación Profesional de Excelencia
        </h2>
        <p class="text-lg text-gray-600">Cursos certificados, diplomados especializados y eventos prácticos para
          impulsar tu carrera.</p>
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
            <p class="text-gray-600 mb-6 leading-relaxed">Programas integrales con mentoría, evaluación y certificación
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
            <p class="text-gray-600 mb-6 leading-relaxed">Eventos en vivo para conectar con expertos, tendencias y redes
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
  <section class="py-20 md:py-28 bg-white" id="nosotros" data-animate>
    <div class="container mx-auto px-4 md:px-6">
      <div class="text-center max-w-3xl mx-auto mb-16">
        <span
          class="inline-block px-4 py-2 bg-[#0c5660]/10 text-[#0c5660] rounded-full text-sm font-semibold mb-4">Sobre
          Nosotros</span>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Nuestra Misión y Visión</h2>
        <p class="text-lg text-gray-600">Comprometidos con la excelencia educativa y el desarrollo profesional.</p>
      </div>

      <!-- Mission & Vision -->
      <div class="grid md:grid-cols-2 gap-8 mb-16">
        <div
          class="group relative bg-gradient-to-br from-[#0b3f45] to-[#0c5660] rounded-3xl overflow-hidden shadow-2xl hover:shadow-3xl transition-all duration-500 hover:-translate-y-2"
          data-animate-card>
          <div class="absolute inset-0 opacity-20">
            <img src="{{ asset('assets/mision.png') }}" alt="Misión" class="w-full h-full object-cover"
              onerror="this.style.display='none'">
          </div>
          <div class="relative p-8 md:p-10 text-white">
            <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center mb-6">
              <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <span class="text-sm font-semibold uppercase tracking-wider text-white/80 mb-3 block">Nuestra</span>
            <h3 class="text-2xl md:text-3xl font-bold mb-4">MISIÓN</h3>
            <p class="text-white/90 leading-relaxed">
              Somos una empresa académica dedicada a brindar capacitaciones a profesionales y técnicos en los temas más
              relevantes de la actualidad, complementando el aprendizaje y fortaleciendo competencias para una mayor
              competitividad laboral.
            </p>
          </div>
        </div>

        <div
          class="group relative bg-gradient-to-br from-[#f1841a] to-[#ff9a3d] rounded-3xl overflow-hidden shadow-2xl hover:shadow-3xl transition-all duration-500 hover:-translate-y-2"
          data-animate-card>
          <div class="absolute inset-0 opacity-20">
            <img src="{{ asset('assets/vision.png') }}" alt="Visión" class="w-full h-full object-cover"
              onerror="this.style.display='none'">
          </div>
          <div class="relative p-8 md:p-10 text-white">
            <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center mb-6">
              <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                </path>
              </svg>
            </div>
            <span class="text-sm font-semibold uppercase tracking-wider text-white/80 mb-3 block">Nuestra</span>
            <h3 class="text-2xl md:text-3xl font-bold mb-4">VISIÓN</h3>
            <p class="text-white/90 leading-relaxed">
              Ser una plataforma moderna y sostenible en capacitaciones, que promueva el aprendizaje autónomo y
              complemente el conocimiento profesional mediante contenidos actualizados.
            </p>
          </div>
        </div>
      </div>

      <!-- Features -->
      <div class="grid md:grid-cols-3 gap-8">
        <div
          class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 hover:-translate-y-1"
          data-animate-card>
          <div
            class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#0c5660]/10 to-[#0c5660]/5 flex items-center justify-center mb-4">
            <svg class="w-6 h-6 text-[#0c5660]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
              </path>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-gray-900 mb-3">Formación práctica</h3>
          <p class="text-gray-600 text-sm mb-4 leading-relaxed">Clases con enfoque laboral, casos reales, proyectos y
            acompañamiento.</p>
          <div class="flex flex-wrap gap-2">
            <span class="px-3 py-1 bg-[#0c5660]/10 text-[#0c5660] text-xs font-medium rounded-full">Modalidad
              Online</span>
            <span class="px-3 py-1 bg-[#f1841a]/10 text-[#f1841a] text-xs font-medium rounded-full">Soporte 24/7</span>
          </div>
        </div>

        <div
          class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 hover:-translate-y-1"
          data-animate-card>
          <div
            class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#f1841a]/10 to-[#f1841a]/5 flex items-center justify-center mb-4">
            <svg class="w-6 h-6 text-[#f1841a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
              </path>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-gray-900 mb-3">Certificación verificable</h3>
          <p class="text-gray-600 text-sm mb-4 leading-relaxed">Certificados con código de verificación y respaldo
            institucional.</p>
          <div class="flex flex-wrap gap-2">
            <span class="px-3 py-1 bg-[#0c5660]/10 text-[#0c5660] text-xs font-medium rounded-full">Verificación</span>
            <span class="px-3 py-1 bg-[#f1841a]/10 text-[#f1841a] text-xs font-medium rounded-full">Transparencia</span>
          </div>
        </div>

        <div
          class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 hover:-translate-y-1"
          data-animate-card>
          <div
            class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#0c5660]/10 to-[#0c5660]/5 flex items-center justify-center mb-4">
            <svg class="w-6 h-6 text-[#0c5660]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
              </path>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-gray-900 mb-3">Convenios y alianzas</h3>
          <p class="text-gray-600 text-sm mb-4 leading-relaxed">Alianzas con universidades y empresas para fortalecer
            credibilidad y empleabilidad.</p>
          <div class="flex flex-wrap gap-2">
            <span class="px-3 py-1 bg-[#0c5660]/10 text-[#0c5660] text-xs font-medium rounded-full">Empresas</span>
            <span class="px-3 py-1 bg-[#f1841a]/10 text-[#f1841a] text-xs font-medium rounded-full">Universidades</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CURSOS -->
  <section class="py-20 md:py-28 bg-gradient-to-b from-gray-50 to-white" id="cursos" data-animate>
    <div class="container mx-auto px-4 md:px-6">
      <div class="text-center max-w-3xl mx-auto mb-16">
        <span
          class="inline-block px-4 py-2 bg-[#f1841a]/10 text-[#f1841a] rounded-full text-sm font-semibold mb-4">Nuestros
          Programas</span>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Cursos y Certificaciones</h2>
        <p class="text-lg text-gray-600">Explora nuestros programas disponibles y comienza tu transformación
          profesional.</p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($courses as $row)
          <article
            class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:-translate-y-2"
            data-animate-card>
            <div class="relative h-48 overflow-hidden bg-gradient-to-br from-[#0b3f45] to-[#0c5660]">
              <img src="{{ $row->image_url }}"
                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                alt="{{ $row->titulo }}" data-fallback="{{ asset('assets/gestion_publica.png') }}"
                onerror="this.style.opacity='0.3'">
              <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
              <span
                class="absolute top-4 right-4 px-3 py-1 bg-[#f1841a] text-white text-xs font-semibold rounded-full shadow-lg">
                {{ $row->subtitulo }}
              </span>
            </div>

            <div class="p-6">
              <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#0c5660] transition-colors line-clamp-2">
                {{ $row->titulo }}
              </h3>
              <div class="text-gray-600 text-sm mb-6 leading-relaxed line-clamp-3">
                {!! $row->description !!}
              </div>
              <a href="#contactos"
                class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#f1841a] to-[#ff9a3d] text-white rounded-xl font-semibold text-sm hover:shadow-lg hover:shadow-orange-500/30 transition-all duration-300 group">
                Solicitar info
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </a>
            </div>
          </article>
        @endforeach
      </div>
    </div>
  </section>

  <!-- CONTACTOS -->
  <section class="py-20 md:py-28 bg-white" id="contactos" data-animate>
    <div class="container mx-auto px-4 md:px-6">
      <div class="text-center max-w-3xl mx-auto mb-16">
        <span
          class="inline-block px-4 py-2 bg-[#0c5660]/10 text-[#0c5660] rounded-full text-sm font-semibold mb-4">Contáctanos</span>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">¿Listo para comenzar?</h2>
        <p class="text-lg text-gray-600">Envíanos tus datos para inscripción, información de cursos o propuesta de
          convenio institucional.</p>
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

  {{-- ✅ ROOT ÚNICO PARA VUE (verificar + registrarme) --}}
  <div id="app">
    <!-- VERIFICAR -->
    <section class="py-20 md:py-28 bg-gradient-to-b from-white to-gray-50" id="verificar" data-animate>
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
    <section class="py-20 md:py-28 bg-white" id="registrarme" data-animate>
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

        <div class="max-w-4xl mx-auto">
          <div class="bg-gradient-to-br from-gray-50 to-white rounded-3xl p-8 md:p-10 shadow-xl border border-gray-100">
            <div class="grid md:grid-cols-3 gap-6 mb-8">
              <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded-lg bg-[#0c5660]/10 flex items-center justify-center flex-shrink-0">
                  <svg class="w-5 h-5 text-[#0c5660]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                  </svg>
                </div>
                <div>
                  <h4 class="font-semibold text-gray-900 text-sm mb-1">Proceso Rápido</h4>
                  <p class="text-xs text-gray-600">Registro en minutos</p>
                </div>
              </div>

              <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded-lg bg-[#f1841a]/10 flex items-center justify-center flex-shrink-0">
                  <svg class="w-5 h-5 text-[#f1841a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                    </path>
                  </svg>
                </div>
                <div>
                  <h4 class="font-semibold text-gray-900 text-sm mb-1">Datos Seguros</h4>
                  <p class="text-xs text-gray-600">Información protegida</p>
                </div>
              </div>

              <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded-lg bg-[#0c5660]/10 flex items-center justify-center flex-shrink-0">
                  <svg class="w-5 h-5 text-[#0c5660]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                </div>
                <div>
                  <h4 class="font-semibold text-gray-900 text-sm mb-1">Acceso Inmediato</h4>
                  <p class="text-xs text-gray-600">Comienza hoy mismo</p>
                </div>
              </div>
            </div>

            {{-- ✅ Vue component --}}
            <register-form></register-form>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- FOOTER -->
  <footer class="bg-gradient-to-br from-[#0b3f45] to-[#0c5660] text-white pt-16 pb-8">
    <div class="container mx-auto px-4 md:px-6">
      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
        <!-- Brand -->
        <div class="lg:col-span-2">
          <img src="{{ asset('assets/ceipp-logo.png') }}" alt="CEIPP Logo" class="h-12 mb-4">
          <p class="text-white/80 mb-6 max-w-md leading-relaxed">
            Centro Integral de Formación y Especialización Profesional del Pacífico. Transformando vidas a través de la
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
            <li><a href="#cursos" class="text-white/80 hover:text-white transition-colors">Cursos Certificados</a></li>
            <li><a href="#cursos" class="text-white/80 hover:text-white transition-colors">Diplomados</a></li>
            <li><a href="#cursos" class="text-white/80 hover:text-white transition-colors">Talleres</a></li>
            <li><a href="#verificar" class="text-white/80 hover:text-white transition-colors">Verificar Certificado</a>
            </li>
          </ul>
        </div>
      </div>

      <div class="border-t border-white/10 pt-8 text-center text-white/60 text-sm">
        <p>© <span id="year"></span> CEIPP. Todos los derechos reservados.</p>
      </div>
    </div>
  </footer>

  {{-- Scripts --}}
  <script src="{{ mix('js/app.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>