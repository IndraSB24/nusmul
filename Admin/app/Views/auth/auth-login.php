<?= $this->include('partials/head-main') ?>

<head>
    <meta charset="utf-8" />
    <title>Login | Nusa Mulya 1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/logo/nusmul_transparent_16x16.ico">

    <?= $this->include('partials/head-css') ?>
</head>

<?= $this->include('partials/body') ?>

    <!-- <body data-layout="horizontal"> -->
        <div class="auth-page">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-xxl-3 col-lg-4 col-md-5">
                        <div class="auth-full-page-content d-flex p-sm-5 p-4">
                            <div class="w-100">
                                <div class="d-flex flex-column h-100">
                                    <div class="mb-4 mb-md-5 text-center">
                                        <a href="/" class="d-block auth-logo">
                                            <img src="assets/images/logo/nusmul_transparent_586x457.png" alt="" height="100"> 
                                            <br><span class="logo-txt">Nusa Mulya</span>
                                        </a>
                                    </div>
                                    <div class="auth-content my-auto">
                                        <div class="text-center">
                                            <h5 class="mb-0">Semangat Kerja !</h5>
                                            <p class="text-muted mt-2">Mulai hari mu dengan login</p>
                                        </div>
                                        <form class="custom-form mt-4 pt-2" action="<?= base_url('Auth/login') ?>" method="POST">
                                            <div class="mb-3">
                                                <label class="form-label">Username</label>
                                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                                            </div>
                                            <div class="mb-3">
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-grow-1">
                                                        <label class="form-label">Password</label>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="">
                                                            <a href="auth-recoverpw" class="text-muted">Lupa password?</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="input-group auth-pass-inputgroup">
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
                                                    <button class="btn btn-light ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                </div>
                                            </div>
                                            <!--<div class="row mb-4">-->
                                            <!--    <div class="col">-->
                                            <!--        <div class="form-check">-->
                                            <!--            <input class="form-check-input" type="checkbox" id="remember-check">-->
                                            <!--            <label class="form-check-label" for="remember-check">-->
                                            <!--                Remember me-->
                                            <!--            </label>-->
                                            <!--        </div>  -->
                                            <!--    </div>-->
                                            <!--</div>-->
                                            <div class="mb-3">
                                                <button class="btn btn-danger w-100 waves-effect waves-light" type="submit">Log In</button>
                                            </div>
                                        </form>

                                        <div class="mt-5 text-center">
                                            <p class="text-muted mb-0">Belum aunya akun ? <a href="auth-register"
                                                    class="text-danger fw-semibold"> Daftar disini </a> </p>
                                        </div>
                                    </div>
                                    <div class="mt-4 mt-md-5 text-center">
                                        <p class="mb-0">
                                            © <script>document.write(new Date().getFullYear())</script> Nusa Mulya.
                                            <br> Carefully Assembled with Love 
                                            <!--<i class="mdi mdi-heart-pulse text-primary"></i>-->
                                            <i class="mdi mdi-puzzle-heart text-danger"></i>
                                            <br>by <a href="https://digision.id/sixart" class="text-dark fw-semibold"> Digision.id </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end auth full page content -->
                    </div>
                    <!-- end col -->
                    <div class="col-xxl-9 col-lg-8 col-md-7">
                        <div class="auth-bg pt-md-5 p-4 d-flex">
                            <div class="bg-overlay bg-secondary"></div>
                            <ul class="bg-bubbles">
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                             <!--end bubble effect -->
                             
                            <div class="row justify-content-center align-items-center">
                                <div class="col-xl-7">
                                    <div class="p-0 p-sm-4 px-xl-0">
                                        <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-indicators carousel-indicators-rounded justify-content-start ms-0 mb-0">
                                                <?php foreach($data_template as $index => $row): ?>
                                                    <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="<?= $index ?>" <?php if ($index === 0) echo 'class="active" aria-current="true"'; ?> aria-label="Slide <?= $index + 1 ?>"></button>
                                                <?php endforeach; ?>
                                            </div>
                                             <!--end carouselIndicators -->
                                            <div class="carousel-inner">
                                                <?php foreach($data_template as $index => $row): ?>
                                                    <div class="carousel-item <?php if ($index === 0) echo 'active'; ?>">
                                                        <div class="testi-contain text-white">
                                                            <i class="bx bxs-quote-alt-left text-success display-6"></i>
                            
                                                            <h4 class="mt-4 fw-medium lh-base text-white">
                                                                “<?= $row->isi ?>.”
                                                            </h4>
                                                            <div class="mt-4 pt-3 pb-5">
                                                                <div class="d-flex align-items-start">
                                                                    <div class="flex-shrink-0">
                                                                        <img src="assets/images/<?= $row->picture ?>" class="avatar-md img-fluid rounded-circle" alt="...">
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3 mb-4">
                                                                        <h5 class="font-size-18 text-white"><?= $row->detail ?></h5>
                                                                        <p class="mb-0 text-white-50"><?= $row->detail ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                             <!--end carousel-inner -->
                                        </div>
                                         <!--end review carousel -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container fluid -->
        </div>


        <!-- JAVASCRIPT -->
       <?= $this->include('partials/vendor-scripts') ?>
        <!-- password addon init -->
        <script src="assets/js/pages/pass-addon.init.js"></script>

    </body>

</html>