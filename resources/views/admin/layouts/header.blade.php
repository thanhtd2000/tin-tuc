<!DOCTYPE html>
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>Admin</title>
    <link rel="apple-touch-icon" sizes="57x57" href="../../../dist/assets/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../../../dist/assets/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../../../dist/assets/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../../../dist/assets/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../../../dist/assets/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../../../dist/assets/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../../../dist/assets/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../../../dist/assets/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../../../dist/assets/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="../../../dist/assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../../dist/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../../../dist/assets/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../../dist/assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../../dist/assets/favicon/manifest.json">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../../../dist/assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendors styles-->
    <link rel="stylesheet" href="../../../dist/vendors/simplebar/css/simplebar.css">
    <link rel="stylesheet" href="../../../dist/css/vendors/simplebar.css">
    <!-- Main styles for this application-->
    <link href="../../../dist/css/style.css" rel="stylesheet">
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
    <link href="../../../dist/css/examples.css" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        // Shared IDchuyên
        gtag('config', 'UA-118965717-3');
        // Bootstrap ID
        gtag('config', 'UA-118965717-5');
    </script>
    <link href="../../../dist/vendors/@coreui/chartjs/css/coreui-chartjs.css" rel="stylesheet">
</head>

<body>
    <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
        <div class="sidebar-brand d-none d-md-flex">
            <a href="{{ route('client.home') }}"><svg class="sidebar-brand-full" width="118" height="46"
                    alt="CoreUI Logo">
                    <use xlink:href="../../../dist/assets/brand/coreui.svg#full"></use>
                </svg></a>
            <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
                <use xlink:href="../../../dist/assets/brand/coreui.svg#signet"></use>
            </svg>
        </div>
        <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
            <li class="nav-item"><a class="nav-link" href="/admin/index">
                    <svg class="nav-icon">
                        <use xlink:href="../../../dist/vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
                    </svg> Dashboard<span class="badge badge-sm bg-info ms-auto">NEW</span></a></li>
            <li class="nav-title">Quản lý</li>

            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use xlink:href="../../../dist/vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                    </svg> Người Dùng</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="{{ route('users.show') }}"> Danh sách</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('users.create') }}"><span
                                class="nav-icon"></span>
                            Thêm người dùng<span class="badge badge-sm bg-success ms-auto">ADD</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('users.permise') }}"><span
                                class="nav-icon"></span>
                            Phân quyền</a></li>
                </ul>
            </li>

            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use xlink:href="../../../dist/vendors/@coreui/icons/svg/free.svg#cil-star"></use>
                    </svg> Chuyên Mục</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="/admin/categories/index"> Danh sách</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/categories/create"> Thêm chuyên mục<span
                                class="badge badge-sm bg-success ms-auto">ADD</span></a></li>
                </ul>
            </li>
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use xlink:href="../../../dist/vendors/@coreui/icons/svg/free.svg#cil-newspaper"></use>
                    </svg> Bài Đăng</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="/admin/posts/create"><span
                                class="nav-icon"></span>
                            Thêm bài đăng</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/posts/index"><span
                                class="nav-icon"></span>
                            Danh sách</a></li>
                </ul>
            </li>

            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use xlink:href="../../../dist/vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                    </svg> Bình luận</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="{{route('comments.index')}}"><span
                                class="nav-icon"></span>
                            Danh sách</a></li>
                </ul>
            </li>

        </ul>
        <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        <header class="header header-sticky mb-4">
            <div class="container-fluid">
                <button class="header-toggler px-md-0 me-md-3" type="button"
                    onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                    <svg class="icon icon-lg">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
                    </svg>
                </button><a class="header-brand d-md-none" href="#">
                    <svg width="118" height="46" alt="CoreUI Logo">
                        <use xlink:href="../../../dist/assets/brand/free.svg#cil-list-rich"></use>
                    </svg></a>
                <ul class="header-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">
                            <svg class="icon icon-lg text-danger">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                            </svg></a></li>
                    <li class="nav-item"><a class="nav-link" href="#">
                            <svg class="icon icon-lg">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-list-rich"></use>
                            </svg></a></li>
                    <li class="nav-item"><a class="nav-link" href="#">
                            <svg class="icon icon-lg">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                            </svg></a></li>
                </ul>
                <ul class="header-nav ms-3">
                    <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown"
                            href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <div class="avatar avatar-md"><img class="avatar-img"
                                    src="../../../uploads/{{ Auth::user()->avatar }}" alt="user@email.com">
                            </div>
                        </a>
                        <!-- account -->
                        <div class="dropdown-menu dropdown-menu-end pt-0">
                            <div class="dropdown-header bg-light py-2">
                                <div class="fw-semibold">Account</div>
                            </div><a class="dropdown-item" href="#">
                                <svg class="icon me-2">
                                    <use
                                        xlink:href="../../../dist/vendors/@coreui/icons/svg/free.svg#cil-envelope-open">
                                    </use>
                                </svg> Messages<span class="badge badge-sm bg-success ms-2">42</span></a><a
                                class="dropdown-item" href="#">
                                <svg class="icon me-2">
                                    <use
                                        xlink:href="../../../dist/vendors/@coreui/icons/svg/free.svg#cil-comment-square">
                                    </use>
                                </svg> Comments<span class="badge badge-sm bg-warning ms-2">42</span></a>
                            <div class="dropdown-header bg-light py-2">
                                <div class="fw-semibold">Settings</div>
                            </div><a class="dropdown-item" href="#">
                                <svg class="icon me-2">
                                    <use xlink:href="../../../dist/vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                                </svg> Profile</a><a class="dropdown-item" href="#">
                                <svg class="icon me-2">
                                    <use xlink:href="../../../dist/vendors/@coreui/icons/svg/free.svg#cil-settings">
                                    </use>
                                </svg> Settings</a><a class="dropdown-item" href="#">
                                <div class="dropdown-divider"></div><a class="dropdown-item" href="/logout">
                                    <svg class="icon me-2">
                                        <use
                                            xlink:href="../../../dist/vendors/@coreui/icons/svg/free.svg#cil-account-logout">
                                        </use>
                                    </svg> Đăng Xuất</a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="header-divider"></div>
            <div class="container-fluid">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb my-0 ms-2">
                        <li class="breadcrumb-item">
                            <!-- if breadcrumb is single--><span>Home</span>
                        </li>
                        <li class="breadcrumb-item active"><span>Dashboard</span></li>
                    </ol>
                </nav>
            </div>
        </header>
