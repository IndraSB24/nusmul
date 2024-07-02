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
                                        <table id="main_table" class="table table-bordered nowrap">
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
                        <h5 class="modal-title text-light" id="myLargeModalLabel">Tambah Pemasukan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form_modal_add" method="POST">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <label for="for_date" class="form-label">Tanggal</label>
                                    <input type="text" class="form-control datepicker-basic" id="for_date" placeholder="Tanggal">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" rows="4" id="description" placeholder="Deskripsi"></textarea>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="quantity" class="form-label">Jumlah</label>
                                    <input class="form-control" type="number" id="quantity" placeholder="Jumlah" />
                                </div>
                                <div class="col-lg-2 mb-3">
                                    <label for="unit" class="form-label">Satuan</label>
                                    <input class="form-control" type="text" id="unit" placeholder="Satuan" />
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="total_amount" class="form-label">Harga Total</label>
                                    <input class="form-control" type="number" id="total_amount" placeholder="Harga Total" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" style="text-align: right">
                                    <button type="button" class="btn btn-primary ml-3" id="btn_simpan" >
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
                        <h5 class="modal-title text-light" id="myLargeModalLabel">Edit Data Pemasukan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form_modal_edit" method="POST">
                            <div class="row">
                                <div class="col-lg-12 mb-2 mt-1 text-center">
                                    <h3 id="kode_edit"></h3>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="for_date_edit" class="form-label">Tanggal</label>
                                    <input type="text" class="form-control datepicker-basic" id="for_date_edit" placeholder="Tanggal">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="description_edit" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" rows="4" id="description_edit" placeholder="Deskripsi"></textarea>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="quantity_edit" class="form-label">Jumlah</label>
                                    <input class="form-control" type="number" id="quantity_edit" placeholder="Jumlah" />
                                </div>
                                <div class="col-lg-2 mb-3">
                                    <label for="unit_edit" class="form-label">Satuan</label>
                                    <input class="form-control" type="text" id="unit_edit" placeholder="Satuan" />
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="total_amount_edit" class="form-label">Harga Total</label>
                                    <input class="form-control" type="number" id="total_amount_edit" placeholder="Harga Total" />
                                </div>
                            </div>
                            <div class="row">
                                <input type="hidden" id="id_edit" />
                                <div class="col-lg-12" style="text-align: right">
                                    <button type="button" class="btn btn-primary ml-3" id="btn_konfirmasi_edit">
                                        Konfirmasi Edit
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
        <!-- datepicker js -->
        <?= $this->include('partials/vendor-scripts') ?>
        <?= $this->include('partials/vendor-scripts-sweetalert') ?>
        <?= $this->include('partials/vendor-scripts-datatable') ?>
        <?= $this->include('partials/custom-script') ?>

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
                "url": "<?php echo site_url('travel/ajax_get_pemasukan')?>",
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

    // simpan
    $(document).on('click', '#btn_simpan', function () {
        const thisData = $(this).data();
        const path = "<?= base_url('travel/add_pemasukan') ?>";
        const data = {
            for_date: $('#for_date').val(),
            description: $('#description').val(),
            quantity: $('#quantity').val(),
            unit: $('#unit').val(),
            amount_per_unit: $('#total_amount').val() / $('#quantity').val()
        };
        
        loadQuestionalSwal(
            path, data, 'Tambah pemasukan ?', 
            'Ditambahkan!', 'Pemasukan berhasil ditambahkan', 'modal_add'
        );
    });

    // load edit modal
    $(document).on('click', '#btn_edit', function() {
        var idToGet = $(this).data('id');
        const path = "<?= site_url('travel/ajax_get_pemasukan_data') ?>";
        
        $.ajax({
            url: path,
            method: 'POST',
            data: { id: idToGet },
            dataType: 'json',
            success: function(response) {
                // Populate modal fields with fetched data
                $('#id_edit').val(idToGet)
                $('#for_date_edit').val(response.for_date)
                $('#description_edit').val(response.description)
                $('#quantity_edit').val(response.quantity)
                $('#unit_edit').val(response.unit)
                $('#total_amount_edit').val(response.total_amount)
                $('#kode_edit').text(response.kode)
               
                // Show the modal
                $('#modal_edit').modal('show');
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(xhr.responseText);
            }
        });
    });

    // konfirmasi edit
    $(document).on('click', '#btn_konfirmasi_edit', function () {
        const path = "<?= base_url('travel/edit_pemasukan') ?>";
        const data = {
            id_edit : $('#id_edit').val(),
            for_date: $('#for_date_edit').val(),
            description: $('#description_edit').val(),
            quantity: $('#quantity_edit').val(),
            unit: $('#unit_edit').val(),
            amount_per_unit: $('#total_amount_edit').val() / $('#quantity_edit').val()
        };
        
        loadQuestionalSwal(
            path, data, 'Edit pemasukan ?', 
            'Diedit!', 'Pemasukan berhasil diedit', 'modal_edit'
        );
    });

    // delete
    $(document).on('click', '#btn_delete', function () {
        const thisData = $(this).data();
        const path = "<?= site_url('travel/delete_pemasukan') ?>";
        const data = {
            id : thisData['id']
        };
        
        loadQuestionalSwal(
            path, data, 'Hapus pemasukan dengan kode: '+thisData['kode']+' ?', 
            'Dihapus!', 'pemasukan dengan kode: '+thisData['kode']+' berhasil dihapus.', ''
        );
    });

</script>
