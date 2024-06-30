<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="/" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="assets/images/logo/nusmul_transparent_586x457.png" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo/nusmul_transparent_586x457.png" alt="" height="30"> <span class="logo-txt">Nusa Mulya</span>
                    </span>
                </a>

                <a href="/" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="assets/images/logo/nusmul_transparent_586x457.png" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo/nusmul_transparent_586x457.png" alt="" height="30"> <span class="logo-txt">Nusa Mulya</span>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>

        <div class="d-flex">

            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item" id="mode-setting-btn">
                    <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                    <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                </button>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="grid" class="icon-lg"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <div class="p-2">
                        <div class="row g-0">
                            <div class="col">
                                <a class="dropdown-icon-item" href="#" onClick="setShow('menu-travel')">
                                    <img src="assets/images/icon/car_3d_1.png" alt="Github">
                                    <span>Travel</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#" onClick="setShow('menu-bus')">
                                    <img src="assets/images/icon/bus_3d_1.png" alt="bitbucket">
                                    <span>Bus</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#" onClick="setShow('menu-cargo')">
                                    <img src="assets/images/icon/truck_box_3d_1.png" alt="dribbble">
                                    <span>Cargo</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-1.jpg" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium">Shawn L.</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="apps-contacts-profile"><i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> <?= lang('Files.Profile') ?></a>
                   <a class="dropdown-item" href="auth-lock-screen"><i class="mdi mdi-lock font-size-16 align-middle me-1"></i> <?= lang('Files.Lock_screen') ?></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= base_url('auth/logout') ?>"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout </a>
                </div>
            </div>

        </div>
    </div>
</header>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  $(document).ready(function () {
    // Set the inactivity duration to 5 seconds
    var inactivityDuration = 7200 * 1000; // 7200 seconds

    // Variables to store the last activity time and the logout timeout
    var lastActivityTime = new Date().getTime();
    var logoutTimeout;

    // Function to reset the logout timeout
    function resetLogoutTimeout() {
      clearTimeout(logoutTimeout);
      logoutTimeout = setTimeout(logout, inactivityDuration);
    }

    // Function to handle user activity
    function handleUserActivity() {
      lastActivityTime = new Date().getTime();
      resetLogoutTimeout();
    }

    // Function to logout the user
    function logout() {
      // Perform the logout action, e.g., redirect to a logout page
      console.log('Auto logout due to inactivity');
      // Replace the following line with your actual logout code
      window.location.href = 'https://digision.id/nusamulyasystem/Admin/public/';
    }

    // Attach the activity handler to relevant events
    $(document).on('mousemove keydown', handleUserActivity);

    // Initial setup
    resetLogoutTimeout();
  });
</script>
