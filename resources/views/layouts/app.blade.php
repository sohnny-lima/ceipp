<!DOCTYPE html>
<html lang="es" data-footer="true" data-scrollspy="true" data-placement="vertical" data-behaviour="unpinned"
    data-layout="fluid" data-radius="rounded" data-color="light-blue" data-navcolor="default" data-show="true"
    data-dimension="desktop" data-menu-animate="hidden">
 

<head>
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
     <title>CEIPP | Certificaciones Profesionales</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
    <!-- import JavaScript -->
    <script src="https://unpkg.com/element-ui/lib/index.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="app-shell">
        @auth
            @include('layouts.header')
            <div class="app-body">
                @include('layouts.sidebar')
                <main class="app-content">
                    <div id="app">
                        @yield('content')
                    </div>
                </main>
            </div>
        @else
            <div id="app">
                @yield('content')
            </div>
        @endauth
    </div>

    <style>
        [v-cloak] {
            display: none;
        }
        .thumb_profile {
            max-width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .position-relatives {
            position: relative !important;
            height: 105px;
            display: flex;
            flex: auto;
            margin: auto;
        }

        html[data-color=light-blue] .logo .img,
        html[data-color=light-lime] .logo .img,
        html[data-color=light-green] .logo .img,
        html[data-color=light-red] .logo .img,
        html[data-color=light-pink] .logo .img,
        html[data-color=light-purple] .logo .img,
        html[data-color=light-teal] .logo .img,
        html[data-color=light-sky] .logo .img,
        html[data-color=dark-blue] .logo .img,
        html[data-color=dark-green] .logo .img,
        html[data-color=dark-red] .logo .img,
        html[data-color=dark-pink] .logo .img,
        html[data-color=dark-purple] .logo .img,
        html[data-color=dark-lime] .logo .img,
        html[data-color=dark-sky] .logo .img,
      
        .el-tabs__item {
            padding: 0 17px !important;
        }

        .app-shell {
            min-height: 100vh;
            background: #f5f6f8;
        }

        .app-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 20px;
            background: #ffffff;
            border-bottom: 1px solid #e6e8ec;
        }

        .app-header .brand {
            font-weight: 700;
            color: #111827;
            text-decoration: none;
        }

        .app-header .user-area {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .app-body {
            display: flex;
            min-height: calc(100vh - 56px);
        }

        .app-sidebar {
            width: 240px;
            background: #1f2937;
            color: #ffffff;
            padding: 16px;
        }

        .app-sidebar .menu-title {
            font-size: 12px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #9ca3af;
            margin-bottom: 12px;
        }

        .app-sidebar .menu-link {
            display: block;
            padding: 10px 12px;
            border-radius: 6px;
            color: #e5e7eb;
            text-decoration: none;
            margin-bottom: 6px;
        }

        .app-sidebar .menu-link:hover {
            background: #374151;
            color: #ffffff;
        }

        .app-content {
            flex: 1;
            padding: 20px;
        }

        .logout-button {
            border: none;
            background: #ef4444;
            color: #ffffff;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
        }

        .logout-button:hover {
            background: #dc2626;
        }

        @media (max-width: 991px) {
            .app-body {
                flex-direction: column;
            }

            .app-sidebar {
                width: 100%;
            }
        }

        .login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f2f3f7;
            padding: 24px;
            width: 100%;
            box-sizing: border-box;
        }

        .login-card {
            width: 100%;
            max-width: 380px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 14px;
            padding: 28px;
            box-shadow: 0 16px 36px rgba(15, 23, 42, 0.12);
            box-sizing: border-box;
        }

        .login-logo {
            width:250px !important;
         
            display: block;
            padding: 10px;
            
        }

        .login-title {
            text-align: center;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #1f2937;
        }

        .login-input {
            border-radius: 10px;
            border-color: #cbd5f5;
            padding: 10px 12px;
        }

        .login-input:focus {
            border-color: #4f73e0;
            box-shadow: 0 0 0 0.2rem rgba(79, 115, 224, 0.15);
        }

        .login-button {
            background: #4f73e0;
            border-color: #4f73e0;
            border-radius: 10px;
            font-weight: 600;
            letter-spacing: 0.3px;
            padding: 10px 12px;
        }

        .login-button:hover {
            background: #3d61d6;
            border-color: #3d61d6;
        }

        .login-link {
            color: #4f73e0;
            text-decoration: none;
            font-size: 13px;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        .login-toggle {
            border-radius: 0 10px 10px 0;
            border-color: #cbd5f5;
            background: #ffffff;
        }
    </style>
    <script defer src="{{ mix('js/app.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var toggle = document.getElementById("togglePassword");
            var input = document.getElementById("password");
            if (toggle && input) {
                toggle.addEventListener("click", function () {
                    var type = input.getAttribute("type") === "password" ? "text" : "password";
                    input.setAttribute("type", type);
                });
            }
        });
    </script>
 <style scoped>
.avatar-uploader .el-upload {
    width: 178px;
    height: 178px;
    border: 1px dashed #000;
    border-radius: 6px;
    background-color: #ffffff;
    cursor: pointer;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1p dotted #000;
}

.avatar-uploader .el-upload:hover {
    border-color: #000;
}

.avatar-uploader-icon {
    width: 178px;
    height: 178px;
    line-height: 178px;
    font-size: 28px;
    color: #8c939d;
    text-align: center;
}
.el-upload {
    width: 178px !important;
    height: 178px !important;
    border: 1px dashed #d9d9d9  !important;
    border-radius: 6px  !important;
    background-color: #ffffff  !important;
    cursor: pointer  !important;
}
.avatar {
    width: 178px;
    height: 178px;
    display: block;
    object-fit: cover;
    border: 1px dashed #d9d9d9;
    border-radius: 6px;
}    
.login-logo{
    width: 350px;
    height: auto;
    display: block;
    margin: 0 auto 12px;
}
</style> 
</body>

</html>
