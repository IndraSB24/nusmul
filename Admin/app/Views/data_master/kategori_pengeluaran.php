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
                
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_add"> Tambah Kategori Pengeluaran </button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Kategori</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $counter = 0;
                                            foreach($data_kategori_pengeluaran as $row):
                                                $counter += 1;
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $counter ?></td>
                                                <td class="text-center"><?= $row->nama ?></td>
                                                <td class="text-center"><?= $row->deskripsi ?></td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-info" id="btn_edit"
                                                        data-id="<?= $row->id ?>"
                                                        data-nama="<?= $row->nama ?>"
                                                        data-deskripsi="<?= $row->deskripsi ?>"
                                                    >
                                                        <i class="bx bx-edit"></i> 
                                                    </button>
                                                    <button class="btn btn-sm btn-danger" id="btn_delete" 
                                                        data-id="<?= $row->id ?>"
                                                        data-nama="<?= $row->nama ?>"
                                                        data-path="<?= base_url('kategori_transaksi_finance/delete') ?>"
                                                    > 
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end cardaa -->
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

<!--modal-->
<!-- modal add -->
<div id="modal_add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="myLargeModalLabel">Tambah Kategori Pengeluaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" id="form_modal_add" method="POST">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="nama" class="form-label">Kategori</label>
                            <input class="form-control text-center" type="text" id="nama" name="nama" placeholder="Nama Kategori" />
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi Kategori"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12" style="text-align: right">
                            <button type="button" class="btn btn-primary ml-3" id="btn-simpan" data-object="<?= base_url('kategori_transaksi_finance/add/pengeluaran') ?>">
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
<div id="modal_edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                            <label for="nama_edit" class="form-label">Kategori</label>
                            <input class="form-control text-center" type="text" id="nama_edit" name="nama_edit" placeholder="Nama Kategori" />
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="deskripsi_edit" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi_edit" name="deskripsi_edit" placeholder="Deskripsi Kategori" rows="4" ></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <input type="hidden" name="id_edit" id="id_edit" />
                        <div class="col-lg-12" style="text-align: right">
                            <button type="button" class="btn btn-primary ml-3" id="btn-simpan-edit" data-object="<?= base_url('kategori_transaksi_finance/edit') ?>">
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

<script src="assets/js/app.js"></script>

</body>
</html>

<script>
    // get base URL ================================================================================================================================================
    const baseUrl = "<?= base_url() ?>";
    
    // variable
    
    // main datatable ==============================================================================================================================================
    // function to reload
    function reloadMainDatatable(filterList) {
        fetch(`${baseUrl}/kategori_transaksi_finance/ajax_get/main_table_data/pengeluaran`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
            }),
        })
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector('#datatable-buttons tbody');
            tableBody.innerHTML = data.html;
        })
        .catch(error => console.error('Error:', error));
    }

    // add armada ================================================================================================================================================
    $(document).on('click', '#btn-simpan', function () {
        const path = $(this).data('object');
        const data = {};
        const inputFields = ["nama", "deskripsi"];
        
        inputFields.forEach(field => {
            data[field] = $('#' + field).val();
        });
        
        loadSaveSwal(path, data, 'Tambah Kategori Pengeluaran?', 'Disimpan!', 'Kategori pengeluaran baru berhasil disimpan.', 'modal_add');
    });
    
    // show edit modal ==============================================================================================================================================
    $(document).on('click', '#btn_edit', function() {
        const data = $(this).data();
        
        $('#id_edit').val(data['id']);
        $('#nama_edit').val(data['nama']);
        $('#deskripsi_edit').val(data['deskripsi']);
    
        $('#modal_edit').modal('show');
    });
    
    // edit armada ================================================================================================================================================
    $(document).on('click', '#btn-simpan-edit', function () {
        const path = $(this).data('object');
        const data = {};
        const inputFields = [
            "id_edit", 
            "nama_edit", 
            "deskripsi_edit"
        ];
        
        inputFields.forEach(field => {
            data[field] = $('#' + field).val();
        });
        
        loadSaveSwal(path, data, 'Edit Kategori Pengeluaran?', 'Disimpan!', 'Kategori pengeluaran berhasil diedit.', 'modal_edit');
    });
    
    // delete armada ================================================================================================================================================
    $(document).on('click', '#btn_delete', function () {
        const thisData = $(this).data();
        const path = thisData['path'];
        const data = {
            id : thisData['id']
        };
        
        loadSaveSwal(path, data, 'Hapus Kategori Pengeluaran\n '+thisData['nama']+' ?', 'Dihapus!', 'Kategori pengeluaran '+thisData['nama']+' \nberhasil dihapus.', '');
    });
    
    // swall loader ===============================================================================================================================================
    function loadSaveSwal(path, data, title1, title2, text2, modalToHide="") {
        Swal.fire({
            title: title1,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then(function (result) {
            if (result.value) {
                $.post(path, data, function (response) {
                    Swal.fire({
                        title: title2,
                        icon: 'success',
                        text: text2,
                        timer: 1000,
                        confirmButtonColor: "#5664d2",
                        onBeforeOpen: function () {
                            timerInterval = setInterval(function () {
                                Swal.getContent().querySelector('strong')
                                    .textContent = Swal.getTimerLeft();
                            }, 100);
                        }
                    }).then((result) => {
                        if(modalToHide!==""){
                            $('#'+modalToHide).modal('hide');   
                        }
                        reloadMainDatatable();
                    });
                }, 'json');
            }
        });
    }
    
    // Reload Page ===============================================================================================================================================
    function reloadPage() {
        location.reload();
    }
</script>


