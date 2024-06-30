<?= $this->include('partials/head-main') ?>

<head>

    <?= $title_meta ?>

    <!-- Sweet Alert-->
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <?= $this->include('partials/head-css') ?>

</head>

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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Examples</h4>
                                <p class="card-title-desc">A beautiful, responsive, customizable
                                    and accessible (WAI-ARIA) replacement for JavaScript's popup boxes. Zero
                                    dependencies.</p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-nowrap align-middle justify-content-center mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 50%;">
                                                    Sweet Alert Type
                                                </th>
                                                <th scope="col" class="text-center">
                                                    Sweet Alert Examples
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <th scope="row">
                                                    A Basic Message
                                                </th>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" id="sa-basic">Click me</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    A Title with a Text Under
                                                </th>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" id="sa-title">Click me</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    A success message!
                                                </th>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" id="sa-success">Click me</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    A warning message, with a function attached to the "Confirm"-button...
                                                </th>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" id="sa-warning">Click me</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    By passing a parameter, you can execute something else for "Cancel".
                                                </th>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" id="sa-params">Click me</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    A message with custom Image Header
                                                </th>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" id="sa-image">Click me</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    A message with auto close timer
                                                </th>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" id="sa-close">Click me</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    Custom HTML description and buttons
                                                </th>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" id="custom-html-alert">Click me</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    A custom positioned dialog
                                                </th>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" id="sa-position">Click me</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    A message with custom width, padding and background
                                                </th>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" id="custom-padding-width-alert">Click me</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    Ajax request example
                                                </th>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" id="ajax-alert">Click me</button>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <!-- end table -->
                                </div>
                                <!-- end table responsive -->

                            </div>
                        </div>
                    </div> <!-- end col -->
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

<!-- Sweet Alerts js -->
<script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

<!-- Sweet alert init js-->
<script src="assets/js/pages/sweetalert.init.js"></script>

<script src="assets/js/app.js"></script>

</body>

</html>