<?= $this->include('partials/head-main') ?>

    <head>

        <?= $title_meta ?>
        
        <?= $this->include('partials/head-css-sweetalert') ?>
        <?= $this->include('partials/head-css-form-advance') ?>
        <?= $this->include('partials/head-css-datatable') ?>
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
                        
                        <!-- filter -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card bg-light text-dark">
                                    <div class="card-body">
                                        <h5 class="mb-3 text-dark">Filter</h5>
                                        <form id="form-filter">
                                            <div class="row">
                                                <div class="col-lg-4 mb-3">
                                                    <label for="filter_nama" class="form-label">Nama</label>
                                                    <select class="form-control" data-trigger name="filter_nama" id="filter_nama" placeholder="Pilih Saya">
                                                        <option value="">Pilih Nama</option>
                                                        <?php
                                                            foreach($data_customer as $row){
                                                                echo '<option value="'.$row->name.'"> '.$row->name.' </option>';
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 mb-3">
                                                    <label for="filter_provinsi" class="form-label">Provinsi</label>
                                                    <select class="form-control" data-trigger name="filter_provinsi" id="filter_provinsi">
                                                        <option value="">Pilih Provinsi</option>
                                                        <?php
                                                            foreach($data_provinsi as $row){
                                                                echo '<option value="'.$row->kode.'"> '.$row->nama.' </option>';
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 mb-3">
                                                    <label for="filter_kota" class="form-label">kota</label>
                                                    <select class="form-control" data-trigger name="filter_kota" id="filter_kota">
                                                        <option value="">Pilih Kota</option>
                                                        <?php
                                                            foreach($data_kota as $row){
                                                                echo '<option value="'.$row->kode.'"> '.$row->nama.' ('.$row->nama_provinsi.') </option>';
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-lg-12" style="text-align: right">
                                                    <a class="btn btn-danger ml-3" onClick="reloadPage()"> Reset </a>
                                                    <button type="submit" class="btn btn-dark ml-3"> Filter </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_add"> Tambah Data </button>
                            </div>
                        </div>

                        <!-- table -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table id="main_table" class="table table-bordered dt-responsive nowrap w-100">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>No</th>
                                                    <th>Kode</th>
                                                    <th>Tanggal</th>
                                                    <th>Deskripsi</th>
                                                    <th>Jumlah</th>
                                                    <th>Nominal Total</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- end cardaa -->
                            </div> <!-- end col -->
                        </div>

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


                <?= $this->include('partials/footer') ?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!--modal-->
        <!-- modal add -->
        <div id="modal_add" class="modal fade" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-light" id="myLargeModalLabel">Tambah Customer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form_modal_add" method="POST">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input class="form-control" type="text" id="name" name="name" placeholder="Nama Customer" />
                                </div>
                                <div class="col-lg-8 mb-3">
                                    <label for="hp" class="form-label">No HP</label>
                                    <input class="form-control" type="text" id="hp" name="hp" placeholder="Nomor Hp" />
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="gender1" value="l" checked>
                                        <label class="form-check-label" for="gender1">
                                            Laki-Laki
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender2" value="p">
                                        <label class="form-check-label" for="gender2">
                                            Perempuan
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="provinsi" class="form-label">Provinsi</label>
                                    <select class="form-control" data-trigger name="provinsi" id="provinsi">
                                        <option value="">Pilih Provinsi</option>
                                        <?php
                                            foreach($data_provinsi as $row){
                                                echo '<option value="'.$row->kode.'"> '.$row->nama.' </option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="kota" class="form-label">Kota</label>
                                    <select class="form-control" data-trigger name="kota" id="kota">
                                        <option value="">Pilih Kota</option>
                                        <?php
                                            foreach($data_kota as $row){
                                                echo '<option value="'.$row->kode.'"> '.$row->nama.' ('.$row->nama_provinsi.') </option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" rows="4" name="alamat" id="alamat"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" style="text-align: right">
                                    <button type="button" class="btn btn-primary ml-3" id="btn-simpan" data-object="<?= base_url('customer/add/customer') ?>">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--modal edit-->
        <div id="modal_edit" class="modal fade" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-light" id="myLargeModalLabel">Edit Data Customer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form_modal_edit" method="POST">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <label for="nama_edit" class="form-label">Nama</label>
                                    <input class="form-control" type="text" id="nama_edit" name="nama_edit" placeholder="Nama Customer" />
                                </div>
                                <div class="col-lg-8 mb-3">
                                    <label for="hp_edit" class="form-label">No HP</label>
                                    <input class="form-control" type="text" id="hp_edit" name="hp_edit" placeholder="Nomor Hp" />
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="gender_edit" class="form-label">Gender</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender_edit" id="gender_edit1" value="l" checked>
                                        <label class="form-check-label" for="gender1">
                                            Laki-Laki
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender_edit" id="gender_edit2" value="p">
                                        <label class="form-check-label" for="gender2">
                                            Perempuan
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="provinsi_edit" class="form-label">Provinsi <span id="provinsi_saat_ini"></span></label>
                                    <select class="form-control" data-trigger name="provinsi_edit" id="provinsi_edit">
                                        <option value="">Pilih Provinsi Baru</option>
                                        <?php
                                            foreach($data_provinsi as $row){
                                                echo '<option value="'.$row->kode.'"> '.$row->nama.' </option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="kota_edit" class="form-label">Kota/Kab  <span id="kota_saat_ini"></span></label>
                                    <select class="form-control" data-trigger name="kota_edit" id="kota_edit">
                                        <option value="">Pilih Kota Baru</option>
                                        <?php
                                            foreach($data_kota as $row){
                                                echo '<option value="'.$row->kode.'"> '.$row->nama.' ('.$row->nama_provinsi.') </option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="alamat_edit" class="form-label">Alamat</label>
                                    <textarea class="form-control" rows="4" name="alamat_edit" id="alamat_edit"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <input type="hidden" name="id_edit" id="id_edit" />
                                <div class="col-lg-12" style="text-align: right">
                                    <button type="button" class="btn btn-primary ml-3" id="btn-simpan-edit" data-object="<?= base_url('customer/edit/customer') ?>">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <?= $this->include('partials/right-sidebar') ?>

        <!-- JAVASCRIPT -->
        <?= $this->include('partials/vendor-scripts') ?>
        <?= $this->include('partials/vendor-scripts-sweetalert') ?>
        <?= $this->include('partials/vendor-scripts-datatable') ?>
        <?= $this->include('partials/vendor-scripts-form-advance') ?>
        <?= $this->include('partials/vendor-scripts-form-advance') ?>


        <script src="assets/js/app.js"></script>

    </body>
</html>

<script>
    // var
    const baseUrl = "<?= base_url() ?>";
    var mainTable;

    // Call the function when the document is ready
    $(document).ready(function() {
        mainDatatable();
    });

    // Initialize or reinitialize the DataTable
    function mainDatatable() {
        // Destroy the existing DataTable instance if it exists
        if (mainTable) {
            mainTable.destroy();
        }

        // Initialize the DataTable
        mainTable = $('#main_table').DataTable({
		    "processing": true,
            "serverSide": true,
            "scrollX": true,
            "autoWidth": false,
            // "responsive": true,
			language: {
				"paginate": {
					"first":      "&laquo",
					"last":       "&raquo",
					"next":       "&gt",
					"previous":   "&lt"
				},
			},
            lengthMenu: [ 
                [10, 25, 50, 100, -1],
                ['10', '25', '50', '100', 'ALL']
            ],
            ajax: {
                "url": "<?php echo site_url('cargo/ajax_get_pemasukan')?>",
                "type": "POST",
                "data": function ( data ) {
                    data.searchValue = $('#main_table_filter input').val();
                }
            },
            columnDefs: [
                { 
                "targets": [ 0, 1, 2, 4, 5, 6 ],
                "className": "text-center"
                },
                { 
                    "targets": [ 0, 6 ],
                    "orderable": false,
                },
            ],
		});
    }
</script>
