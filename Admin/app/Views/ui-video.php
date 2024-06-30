<?= $this->include('partials/head-main') ?>

<head>

    <<?= $title_meta ?> <?= $this->include('partials/head-css') ?> </head>

        <?= $this->include('partials/body') ?>

        <!-- <body data-layout="horizontal"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            <?= $this->include('partials/menu') ?>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <?= $page_title ?>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Ratio video 16:9</h4>
                                        <p class="card-title-desc">Aspect ratios can be customized with modifier classes.</p>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <!-- 16:9 aspect ratio -->
                                        <div class="ratio ratio-16x9">
                                            <iframe src="https://www.youtube.com/embed/1y_kfWUCFDQ" title="YouTube video" allowfullscreen></iframe>
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Ratio video 21:9</h4>
                                        <p class="card-title-desc">Aspect ratios can be customized with modifier classes.</p>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <!-- 21:9 aspect ratio -->
                                        <div class="ratio ratio-21x9">
                                            <iframe src="https://www.youtube.com/embed/1y_kfWUCFDQ" title="YouTube video" allowfullscreen></iframe>
                                        </div>

                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                        </div> <!-- end row -->

                        <div class="row">

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Ratio video 4:3</h4>
                                        <p class="card-title-desc">Aspect ratios can be customized with modifier classes.</p>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <!-- 4:3 aspect ratio -->
                                        <div class="ratio ratio-4x3">
                                            <iframe src="https://www.youtube.com/embed/1y_kfWUCFDQ" title="YouTube video" allowfullscreen></iframe>
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Ratio video 1:1</h4>
                                        <p class="card-title-desc">Aspect ratios can be customized with modifier classes.</p>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <!-- 1:1 aspect ratio -->
                                        <div class="ratio ratio-1x1">
                                            <iframe src="https://www.youtube.com/embed/1y_kfWUCFDQ" title="YouTube video" allowfullscreen></iframe>
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div> <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <?= $this->include('partials/footer') ?>

            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->


        <?= $this->include('partials/right-sidebar') ?>

        <!-- JAVASCRIPT -->
        <?= $this->include('partials/vendor-scripts') ?>

        <script src="assets/js/app.js"></script>

        </body>

</html>