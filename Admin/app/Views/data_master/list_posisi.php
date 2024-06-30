<?= $this->include('partials/head-main') ?>

<head>

    <?= $title_meta ?>
    
    <?= $this->include('partials/head-css-sweetalert') ?>
    <?= $this->include('partials/head-css-form-advance') ?>
    <?= $this->include('partials/head-css-datatable') ?>
    <?= $this->include('partials/head-css') ?>
    
    <style>
        .accounting-format {
            text-align: right; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            padding: 0 5px; 
        }
    </style>

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
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_add"> Tambah Karyawan </button>
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
                                            <th>Posisi</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $counter = 0;
                                            foreach($data_list_posisi as $row):
                                                $counter += 1;
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $counter ?></td>
                                                <td class="text-center"><?= $row->nama ?></td>
                                                <td class="text-center"><?= $row->deskripsi ?></td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-info" id="btn_edit"
                                                        data-id = "<?= $row->id ?>"
                                                        data-nama = "<?= $row->nama ?>"
                                                        data-deskripsi = "<?= $row->deskripsi ?>"
                                                    >
                                                        <i class="bx bx-edit"></i> 
                                                    </button>
                                                    <button class="btn btn-sm btn-danger" id="btn_delete" 
                                                        data-id="<?= $row->id ?>"
                                                        data-nama="<?= $row->nama ?>"
                                                        data-path="<?= base_url('list_posisi/delete/list_posisi') ?>"
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
                <h5 class="modal-title text-light" id="myLargeModalLabel">Tambah Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" id="form_modal_add" method="POST">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="nama" class="form-label">Nama Karyawan</label>
                            <input class="form-control text-center" type="text" id="nama" name="nama" placeholder="Nama Paket" />
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat Karyawan"></textarea>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="hp" class="form-label">Nomor Hp</label>
                            <input class="form-control" id="hp" name="hp" placeholder="Nomor Hp" />
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="posisi" class="form-label">Posisi</label>
                            <select class="form-control" data-trigger name="posisi" id="posisi" placeholder="Pilih Posisi">
                                <option value="1" selected>Pilih Posisi</option>
                                <?php
                                    foreach($data_list_posisi as $row){
                                        echo '<option value="'.$row->id.'"> '.$row->nama.' </option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12" style="text-align: right">
                            <button type="button" class="btn btn-primary ml-3" id="btn-simpan" data-object="<?= base_url('karyawan/add/karyawan') ?>">
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
                <h5 class="modal-title text-light" id="myLargeModalLabel">Edit Paket Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" id="form_modal_edit" method="POST">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="nama_edit" class="form-label">Nama Karyawan</label>
                            <input class="form-control text-center" type="text" id="nama_edit" name="nama_edit" placeholder="Nama Paket Baru" />
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="alamat_edit" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat_edit" name="alamat_edit" placeholder="Alamat Karyawan Baru"></textarea>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="hp_edit" class="form-label">Nomor Hp</label>
                            <input class="form-control" id="hp_edit" name="hp_edit" placeholder="Nomor Hp baru" />
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="posisi_edit" class="form-label">Posisi saat ini: <span id="posisi_saat_ini"></span></label>
                            <select class="form-control" data-trigger name="posisi_edit" id="posisi_edit">
                                <option value="">Pilih Posisi Baru</option>
                                <?php
                                    foreach($data_list_posisi as $row){
                                        echo '<option value="'.$row->id.'"> '.$row->nama.' </option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <input type="hidden" name="id_edit" id="id_edit" />
                        <div class="col-lg-12" style="text-align: right">
                            <button type="button" class="btn btn-primary ml-3" id="btn-simpan-edit" data-object="<?= base_url('karyawan/edit/karyawan') ?>">
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
        fetch(`${baseUrl}/karyawan/ajax_get/main_table_data`, {
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
        const inputFields = ["nama", "hp", "alamat", "posisi"];
        
        inputFields.forEach(field => {
            data[field] = $('#' + field).val();
        });
        
        loadSaveSwal(path, data, 'Tambah Karyawan?', 'Disimpan!', 'Karyawan baru berhasil disimpan.', 'modal_add');
    });
    
    // show edit modal ==============================================================================================================================================
    $(document).on('click', '#btn_edit', function() {
        const data = $(this).data();
        
        $('#id_edit').val(data['id']);
        $('#nama_edit').val(data['nama']);
        $('#hp_edit').val(data['hp']);
        $('#alamat_edit').val(data['alamat']);
        $('#posisi_saat_ini').text(`${data['nama_posisi']}`);
    
        $('#modal_edit').modal('show');
    });
    
    // edit armada ================================================================================================================================================
    $(document).on('click', '#btn-simpan-edit', function () {
        const path = $(this).data('object');
        const data = {};
        const inputFields = [
            "id_edit", 
            "nama_edit", 
            "hp_edit",
            "alamat_edit",
            "posisi_edit"
        ];
        
        inputFields.forEach(field => {
            data[field] = $('#' + field).val();
        });
        
        loadSaveSwal(path, data, 'Edit Karyawan?', 'Disimpan!', 'Karyawan berhasil diedit.', 'modal_edit');
    });
    
    // delete armada ================================================================================================================================================
    $(document).on('click', '#btn_delete', function () {
        const thisData = $(this).data();
        const path = thisData['path'];
        const data = {
            id : thisData['id']
        };
        
        loadSaveSwal(path, data, 'Hapus Karyawan\n '+thisData['nama']+' ?', 'Dihapus!', 'Karyawan '+thisData['nama']+' \nberhasil dihapus.', '');
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


