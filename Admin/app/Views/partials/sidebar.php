<head>
    <style>
        .default_set_menu{
            display:block;
        }
    </style>
</head>

<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <!--dashborad-->
                <li>
                    <a href="/">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                
                <!--travel-->
                    <li class="menu-title default_set_menu menu-travel" style="display:none">TRAVEL</li>
                    <li class="default_set_menu menu-travel" style="display:none">
                        <a href="/">
                            <i data-feather="home"></i>
                            <span>Dashboard Travel</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="briefcase"></i>
                            <span>Data Master</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="data-master-customer"> List Customer </a></li>
                            <li><a href="data-master-armada"> List Armada </a></li>
                            <li><a href="data-master-kategori-pemasukan"> Kategori Pemasukan </a></li>
                            <li><a href="data-master-kategori-pengeluaran"> Kategori Pengeluaran </a></li>
                            <li><a href="data-master-paket-service"> Paket Service </a></li>
                            <li><a href="data-master-posisi"> List Posisi </a></li>
                            <li><a href="data-master-karyawan"> Karyawan </a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="briefcase"></i>
                            <span>CRM</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="#"> Dashboard </a></li>
                            <li><a href="#" > WA Blasting </a></li>
                            <li><a href="#" > Format Pesan WA </a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="travel-booking">
                            <i data-feather="home"></i>
                            <span>Travel Booking</span>
                        </a>
                    </li>
                    <li>
                        <a href="travel-scheduling">
                            <i data-feather="home"></i>
                            <span>Travel Scheduling</span>
                        </a>
                    </li>
                
                <!--bus-->
                <!-- <div id="menu-bus" class="default_set_menu menu-bus"> -->
                    <li class="menu-title" data-key="t-menu">BUS</li>
                    <li>
                        <a href="/">
                            <i data-feather="home"></i>
                            <span>Dashboard bus</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="users"></i>
                            <span data-key="t-authentication"><?= lang('Files.Authentication') ?></span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="auth-login" data-key="t-login"><?= lang('Files.Login') ?></a></li>
                            <li><a href="auth-register" data-key="t-register"><?= lang('Files.Register') ?></a></li>
                            <li><a href="auth-recoverpw" data-key="t-recover-password"><?= lang('Files.Recover_Password') ?></a></li>
                            <li><a href="auth-lock-screen" data-key="t-lock-screen"><?= lang('Files.Lock_Screen') ?> </a></li>
                            <li><a href="auth-confirm-mail" data-key="t-confirm-mail"><?= lang('Files.Confirm_Mail') ?></a></li>
                            <li><a href="auth-email-verification" data-key="t-email-verification"><?= lang('Files.Email_Verification') ?></a></li>
                            <li><a href="auth-two-step-verification" data-key="t-two-step-verification"><?= lang('Files.Two_Step_Verification') ?></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="briefcase"></i>
                            <span>Data Master</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="ui-alerts"> Data Customer </a></li>
                            <li><a href="ui-buttons" data-key="t-buttons"><?= lang('Files.Buttons') ?></a></li>
                            <li><a href="ui-cards" data-key="t-cards"><?= lang('Files.Cards') ?></a></li>
                            <li><a href="ui-carousel" data-key="t-carousel"><?= lang('Files.Carousel') ?></a></li>
                            <li><a href="ui-dropdowns" data-key="t-dropdowns"><?= lang('Files.Dropdowns') ?></a></li>
                            <li><a href="ui-grid" data-key="t-grid"><?= lang('Files.Grid') ?></a></li>
                            <li><a href="ui-images" data-key="t-images"><?= lang('Files.Images') ?></a></li>
                            <li><a href="ui-modals" data-key="t-modals"><?= lang('Files.Modals') ?></a></li>
                            <li><a href="ui-offcanvas" data-key="t-offcanvas"><?= lang('Files.Offcanvas') ?></a></li>
                            <li><a href="ui-progressbars" data-key="t-progress-bars"><?= lang('Files.Progress_Bars') ?></a></li>
                            <li><a href="ui-tabs-accordions" data-key="t-tabs-accordions"><?= lang('Files.Tabs_n_Accordions') ?></a></li>
                            <li><a href="ui-typography" data-key="t-typography"><?= lang('Files.Typography') ?></a></li>
                            <li><a href="ui-video" data-key="t-video"><?= lang('Files.Video') ?></a></li>
                            <li><a href="ui-general" data-key="t-general"><?= lang('Files.General') ?></a></li>
                            <li><a href="ui-colors" data-key="t-colors"><?= lang('Files.Colors') ?></a></li>
                        </ul>
                    </li>
                <!-- </div> -->
                
                <!--cargo-->
                <!-- <div id="menu-cargo" class="default_set_menu menu-cargo"> -->
                    <li class="menu-title" data-key="t-menu">CARGO</li>
                    <li>
                        <a href="/">
                            <i data-feather="home"></i>
                            <span>Dashboard Cargo</span>
                        </a>
                    </li>
                    <li>
                        <a href="cargo-pemasukan"> 
                            <i data-feather="home"></i>
                            <span>Pemasukan</span>
                        </a>
                    </li>
                    <li>
                        <a href="cargo-pengeluaran"> 
                            <i data-feather="home"></i>
                            <span>Pengeluaran</span>
                        </a>
                    </li>
                <!-- </div> -->

                <li class="menu-title" data-key="t-menu">ASSETS</li>
                <li>
                    <a href="/">
                        <i data-feather="form-advanced"></i>
                        <span>Form Advance</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->


<!--script-->
<script>
    // hide all service menu
    // var defaultMenuElementsInitiate = document.getElementsByClassName("default_set_menu");
    // for (var i = 0; i < defaultMenuElementsInitiate.length; i++) {
    //     defaultMenuElementsInitiate[i].style.display = "none";
    // }
    
    // dinamically show servie menu
    function setShow(menuClass) {
        var defaultMenuElements = document.getElementsByClassName("default_set_menu");
        
        for (var i = 0; i < defaultMenuElements.length; i++) {
            defaultMenuElements[i].style.display = "block";
        }
        
        var menuElementsToShow = document.getElementsByClassName(menuClass);
        for (var i = 0; i < menuElementsToShow.length; i++) {
            menuElementsToShow[i].style.display = "block";
        }
    }


</script>
