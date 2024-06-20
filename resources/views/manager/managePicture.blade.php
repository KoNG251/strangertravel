<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth focus:scroll-auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>StrangerTravel</title>
</head>

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-enabled">


    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>



    <div class="d-flex flex-column flex-root">

        <div class="page d-flex flex-row flex-column-fluid">

            <div id="kt_aside" class="aside aside-extended" data-kt-drawer="true" data-kt-drawer-name="aside"
                data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                data-kt-drawer-width="auto" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">

                <div class="aside-primary d-flex flex-column align-items-lg-center flex-row-auto">

                    <div class="aside-logo d-none d-lg-flex flex-column align-items-center flex-column-auto pt-10"
                        id="kt_aside_logo">
                        <a href="#">
                            <img alt="Logo" src="{{ asset('assets/favicon.ico') }}" class="h-55px" />
                        </a>
                    </div>


                    <div class="aside-nav d-flex flex-column flex-lg-center flex-column-fluid w-100 py-5 px-3"
                        id="kt_aside_nav">

                        <div class="w-100 hover-scroll-overlay-y d-flex scroll-ms" id="kt_aside_menu_wrapper"
                            data-kt-scroll="true" data-kt-scroll-height="auto"
                            data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
                            data-kt-scroll-wrappers="#kt_aside, #kt_aside_nav, #kt_aside_menu_wrapper"
                            data-kt-scroll-offset="5px">

                            <div id="kt_aside_menu"
                                class="menu menu-rounded menu-column menu-active-bg menu-title-gray-600 menu-icon-gray-400 menu-state-primary menu-arrow-gray-500 fw-semibold fs-6 my-auto"
                                data-kt-menu="true">


                                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                    data-kt-menu-placement="right-start" class="menu-item py-2">

                                    <span class="menu-link menu-center">
                                        <span class="menu-icon me-0">
                                            <i class="ki-duotone ki-category fs-2x">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                            </i>
                                        </span>
                                    </span>


                                    <div class="menu-sub menu-sub-indention menu-sub-dropdown w-225px px-2 py-4">

                                        <div class="menu-item">

                                            <div class="menu-content">
                                                <span class="menu-section fs-5 fw-bold ps-1 py-1">Dashboard</span>
                                            </div>

                                        </div>

                                        <div class="menu-item">

                                            <a class="menu-link" href="{{ route('manager.cms.home') }}"
                                                title="Check out over 200 in-house components, plugins and ready for use solutions"
                                                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                                                data-bs-placement="right">
                                                <span class="menu-icon">
                                                    <i class="ki-duotone ki-element-8 fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </span>
                                                <span class="menu-title">Dashboard</span>
                                            </a>

                                        </div>

                                    </div>

                                </div>
                                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                    data-kt-menu-placement="right-start" class="menu-item py-2">

                                    <span class="menu-link menu-center">
                                        <span class="menu-icon me-0">
                                            <i class="ki-duotone ki-user fs-2x">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                    </span>


                                    <div class="menu-sub menu-sub-indention menu-sub-dropdown w-225px px-2 py-4">

                                        <div class="menu-item">

                                            <div class="menu-content">
                                                <span class="menu-section fs-5 fw-bold ps-1 py-1">Account</span>
                                            </div>

                                        </div>

                                        <div class="menu-item">

                                            <a class="menu-link" href="{{ route('manager.cms.authentication') }}"
                                                title="Check out over 200 in-house components, plugins and ready for use solutions"
                                                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                                                data-bs-placement="right">
                                                <span class="menu-icon">
                                                    <i class="ki-duotone ki-user-tick fs-2x">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                </span>
                                                <span class="menu-title">Authentication</span>
                                            </a>

                                        </div>

                                    </div>

                                </div>
                                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                    data-kt-menu-placement="right-start" class="menu-item py-2">

                                    <span class="menu-link menu-center">
                                        <span class="menu-icon me-0">
                                            <i class="ki-duotone ki-home-2 fs-2x text-primary">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                    </span>


                                    <div class="menu-sub menu-sub-indention menu-sub-dropdown w-225px px-2 py-4">

                                        <div class="menu-item">

                                            <div class="menu-content">
                                                <span class="menu-section fs-5 fw-bold ps-1 py-1">Hotel</span>
                                            </div>

                                        </div>

                                        <div class="menu-item">

                                            <a class="menu-link" href="{{ route('manager.cms.add') }}"
                                                title="Check out over 200 in-house components, plugins and ready for use solutions"
                                                data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                data-bs-dismiss="click" data-bs-placement="right">
                                                <span class="menu-icon">
                                                    <i class="ki-duotone ki-home-1 fs-2x">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </span>
                                                <span class="menu-title">New hotel</span>
                                            </a>

                                            <a class="menu-link" href="{{ route('manager.cms.edit') }}"
                                                title="Check out over 200 in-house components, plugins and ready for use solutions"
                                                data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                data-bs-dismiss="click" data-bs-placement="right">
                                                <span class="menu-icon">
                                                    <i class="ki-duotone ki-wrench fs-2x">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </span>
                                                <span class="menu-title">Edit hotel</span>
                                            </a>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>



                <div class="aside-secondary d-flex flex-row-fluid">

                    <div class="aside-workspace overflow-auto my-2 my-lg-7 px-2 px-lg-4" id="kt_aside_wordspace">

                        <div class="menu menu-sub-indention menu-rounded menu-column menu-active-bg menu-title-gray-600 menu-icon-gray-400 menu-state-primary menu-arrow-gray-500 fw-semibold fs-6 my-5 mt-lg-2 mb-lg-0"
                            id="kt_aside_menu" data-kt-menu="true">
                            <div id="kt_aside_menu_wrapper" class="hover-scroll-y me-lg-n4 pe-lg-4"
                                data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                data-kt-scroll-height="auto" data-kt-scroll-offset="20px"
                                data-kt-scroll-wrappers="#kt_aside_wordspace">

                                <div class="menu-item">

                                    <div class="menu-content">
                                        <span class="menu-section fs-5 fw-bold ps-1 py-1">Dashboard</span>
                                    </div>

                                </div>

                                <div class="menu-item">

                                    <a class="menu-link active" href="#">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">New hotel</span>
                                    </a>

                                    <a class="menu-link" href="{{ route('manager.cms.edit') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Edit hotel</span>
                                    </a>

                                </div>



                            </div>
                        </div>

                    </div>

                </div>


                <button
                    class="btn btn-sm btn-icon bg-body btn-active-primary position-absolute translate-middle mb-4 start-100 end-0 bottom-0 shadow-sm d-none d-lg-flex"
                    data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
                    data-kt-toggle-name="aside-minimize">
                    <i class="ki-duotone ki-arrow-left fs-2 rotate-180">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </button>


            </div>

            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <div id="kt_header" class="header" data-kt-sticky="true" data-kt-sticky-name="header"
                    data-kt-sticky-offset="{default: '200px', lg: '300px'}">
                    <!--begin::Container-->
                    <div class="container-fluid d-flex align-items-stretch justify-content-between"
                        id="kt_header_container">
                        <!--begin::Page title-->
                        <div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-2 pb-2 pb-lg-0"
                            data-kt-swapper="true" data-kt-swapper-mode="prepend"
                            data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
                            <!--begin::Heading-->
                            <h1 class="text-dark fw-bold my-1 fs-2">Hotel</h1>
                            <!--end::Heading-->
                            <!--begin::Breadcrumb-->
                            <ul class="breadcrumb fw-semibold fs-base my-1">
                                <li class="breadcrumb-item text-muted">
                                    <a href="#" class="text-muted text-hover-primary">Home</a>
                                </li>
                                <li class="breadcrumb-item text-muted">Hotel</li>
                                <li class="breadcrumb-item text-dark">Add hotel</li>
                            </ul>
                            <!--end::Breadcrumb-->
                        </div>
                        <!--begin::Toolbar wrapper-->
                        <div class="d-flex align-items-center flex-shrink-0">

                            <!--begin::Theme mode-->
                            <div class="d-flex align-items-center ms-2 ms-lg-3">
                                <!--begin::Menu toggle-->
                                <a href="#"
                                    class="btn btn-icon btn-active-light-primaryw-35px h-35px w-md-40px h-md-40px"
                                    data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent"
                                    data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-night-day theme-light-show fs-2x">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                        <span class="path7"></span>
                                        <span class="path8"></span>
                                        <span class="path9"></span>
                                        <span class="path10"></span>
                                    </i>
                                    <i class="ki-duotone ki-moon theme-dark-show fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </a>
                                <!--begin::Menu toggle-->
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                                    data-kt-menu="true" data-kt-element="theme-mode-menu">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3 my-0">
                                        <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                            data-kt-value="light">
                                            <span class="menu-icon" data-kt-element="icon">
                                                <i class="ki-duotone ki-night-day fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                    <span class="path5"></span>
                                                    <span class="path6"></span>
                                                    <span class="path7"></span>
                                                    <span class="path8"></span>
                                                    <span class="path9"></span>
                                                    <span class="path10"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">Light</span>
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3 my-0">
                                        <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                            data-kt-value="dark">
                                            <span class="menu-icon" data-kt-element="icon">
                                                <i class="ki-duotone ki-moon fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">Dark</span>
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3 my-0">
                                        <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                            data-kt-value="system">
                                            <span class="menu-icon" data-kt-element="icon">
                                                <i class="ki-duotone ki-screen fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">System</span>
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu-->
                            </div>
                            <!--end::Theme mode-->
                            <!--begin::User-->
                            <div class="d-flex align-items-center ms-2 ms-lg-3" id="kt_header_user_menu_toggle">
                                <!--begin::Menu wrapper-->
                                <div class="cursor-pointer symbol symbol-35px symbol-md-40px"
                                    data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent"
                                    data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-profile-circle fs-2x">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </div>
                                <!--begin::User account menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                                    data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content d-flex align-items-center px-3">
                                            <!--begin::Username-->
                                            <div class="d-flex flex-column">
                                                <a href="#"
                                                    class="fw-semibold text-muted text-hover-primary fs-7"></a>
                                            </div>
                                            <!--end::Username-->
                                        </div>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu separator-->
                                    <div class="separator my-2"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5">

                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::User account menu-->
                                <!--end::Menu wrapper-->
                            </div>
                            <!--end::User -->
                        </div>
                        <!--end::Toolbar wrapper-->
                    </div>
                    <!--end::Container-->
                </div>

                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <!--begin::Container-->
                    <div class="container-xxl" id="kt_content_container">
                        <div class="card p-10">
                            <form action="{{ route('manager.chunks.save',['id'=>$id]) }}" method="POST" class="text-end mb-4">
                                @csrf
                                <button type="submit" class="btn btn-primary">SUBMIT</button>
                            </form>
                            <div class="grid grid-cols-4 gap-4">
                                @foreach ($chunks as $item)
                                <form class="parent-container relative" style="display: grid; place-items: center; height: 300px; width: 100%;" action="{{ route('manager.chunks.delete',$item->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow" style="background-image: url('{{ asset('storage/chunks/'.$item->chunks_path) }}'); width: 100%; height: 100%; background-size: cover; background-position: center;"></div>
                                    <button type="submit" class="w-10 h-10 rounded-full bg-white flex justify-center items-center cursor-pointer absolute" style="right: 10px; top: 10px;">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-duotone ki-arrow-up">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </div>

    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

</body>

</html>
