<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth focus:scroll-auto">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <link rel="icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <title>StrangerTravel</title>
    </head>
    <body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-enabled">


		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>



		<div class="d-flex flex-column flex-root">

			<div class="page d-flex flex-row flex-column-fluid">

				<div id="kt_aside" class="aside aside-extended" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="auto" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">

					<div class="aside-primary d-flex flex-column align-items-lg-center flex-row-auto">

						<div class="aside-logo d-none d-lg-flex flex-column align-items-center flex-column-auto pt-10" id="kt_aside_logo">
							<a href="#">
								<img alt="Logo" src="{{ asset('assets/favicon.ico') }}" class="h-55px" />
							</a>
						</div>


						<div class="aside-nav d-flex flex-column flex-lg-center flex-column-fluid w-100 py-5 px-3" id="kt_aside_nav">

							<div class="w-100 hover-scroll-overlay-y d-flex scroll-ms" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside, #kt_aside_nav, #kt_aside_menu_wrapper" data-kt-scroll-offset="5px">

								<div id="kt_aside_menu" class="menu menu-rounded menu-column menu-active-bg menu-title-gray-600 menu-icon-gray-400 menu-state-primary menu-arrow-gray-500 fw-semibold fs-6 my-auto" data-kt-menu="true">


									<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item py-2">

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

												<a class="menu-link" href="{{ route('admin.cms.home') }}" title="Check out over 200 in-house components, plugins and ready for use solutions" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
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
									<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item py-2">

										<span class="menu-link menu-center">
											<span class="menu-icon me-0">
												<i class="ki-duotone ki-user text-primary fs-2x">
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

												<a class="menu-link" href="#" title="Check out over 200 in-house components, plugins and ready for use solutions" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
													<span class="menu-icon">
														<i class="ki-duotone ki-user-tick fs-2x">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
													</span>
													<span class="menu-title">Manage user</span>
												</a>

											</div>

										</div>

									</div>
									<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item py-2">

										<span class="menu-link menu-center">
											<span class="menu-icon me-0">
												<i class="ki-duotone ki-home-2 fs-2x">
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

												<a class="menu-link" href="{{ route('admin.cms.hotel') }}" title="Check out over 200 in-house components, plugins and ready for use solutions" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
													<span class="menu-icon">
														<i class="ki-duotone ki-home-1 fs-2x">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
													</span>
													<span class="menu-title">Check the hotel</span>
												</a>

											</div>

										</div>

									</div>

								</div>

							</div>

						</div>


						<div class="aside-footer d-flex flex-column align-items-center flex-column-auto" id="kt_aside_footer">

							<div class="mb-7">
								<button type="button" class="btn btm-sm btn-icon btn-color-gray-400 btn-active-color-primary btn-active-light" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-overflow="true" data-kt-menu-placement="top-start">
									<i class="ki-duotone ki-setting-2 fs-2x">
										<span class="path1"></span>
										<span class="path2"></span>
									</i>
								</button>

								<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">

									<div class="menu-item px-3">
										<div class="menu-content fs-6 text-dark fw-bold px-3 py-4">Quick Actions</div>
									</div>


									<div class="separator mb-3 opacity-75"></div>


									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3">New Admin</a>
									</div>


									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3">Check Hotel</a>
									</div>


									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3">Logout</a>
									</div>

								</div>

							</div>

						</div>

					</div>



					<div class="aside-secondary d-flex flex-row-fluid">

						<div class="aside-workspace overflow-auto my-2 my-lg-7 px-2 px-lg-4" id="kt_aside_wordspace">

							<div class="menu menu-sub-indention menu-rounded menu-column menu-active-bg menu-title-gray-600 menu-icon-gray-400 menu-state-primary menu-arrow-gray-500 fw-semibold fs-6 my-5 mt-lg-2 mb-lg-0" id="kt_aside_menu" data-kt-menu="true">
								<div id="kt_aside_menu_wrapper" class="hover-scroll-y me-lg-n4 pe-lg-4" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-offset="20px" data-kt-scroll-wrappers="#kt_aside_wordspace">

									<div class="menu-item">

										<div class="menu-content">
											<span class="menu-section fs-5 fw-bold ps-1 py-1">Account</span>
										</div>

									</div>

									<div class="menu-item">

										<a class="menu-link active" href="#">
											<span class="menu-bullet">
												<span class="bullet bullet-dot"></span>
											</span>
											<span class="menu-title">Manager user</span>
										</a>

									</div>



								</div>
							</div>

						</div>

					</div>


					<button class="btn btn-sm btn-icon bg-body btn-active-primary position-absolute translate-middle mb-4 start-100 end-0 bottom-0 shadow-sm d-none d-lg-flex" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
						<i class="ki-duotone ki-arrow-left fs-2 rotate-180">
							<span class="path1"></span>
							<span class="path2"></span>
						</i>
					</button>


				</div>


                <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                    <div id="app">
                        <admin-account
                        :csrf-token="'{{ csrf_token() }}'"
                        ></admin-account>
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
