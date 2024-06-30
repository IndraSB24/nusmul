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
                                                    foreach($data_armada as $row){
                                                        echo '<option value="'.$row->id.'"> '.$row->unit_name.' </option>';
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

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Type</th>
                                            <th>Merk</th>
                                            <th>Nama Unit</th>
                                            <th>Plat Nomor</th>
                                            <th>Kapasitas Kursi (Orang)</th>
                                            <th>Kapasitas Beban (Kg)</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $counter = 0;
                                            foreach($data_armada as $row):
                                                $counter += 1;
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $counter ?></td>
                                                <td class="text-center"><?= $row->kode ?></td>
                                                <td class="text-center"><?= $row->type ?></td>
                                                <td class="text-center"><?= $row->brand ?></td>
                                                <td class="text-center"><?= $row->unit_name ?></td>
                                                <td class="text-center"><?= $row->plat_number ?></td>
                                                <td class="text-center"><?= $row->kapasitas_kursi ?></td>
                                                <td class="text-center"><?= $row->kapasitas_beban ?></td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-info" id="btn_edit"
                                                        data-id="<?= $row->id ?>"
                                                        data-kode="<?= $row->kode ?>"
                                                        data-type="<?= $row->type ?>"
                                                        data-brand="<?= $row->brand ?>"
                                                        data-unit_name="<?= $row->unit_name ?>"
                                                        data-plat_number="<?= $row->plat_number ?>"
                                                        data-kapasitas_kursi="<?= $row->kapasitas_kursi ?>"
                                                        data-kapasitas_beban="<?= $row->kapasitas_beban ?>"
                                                    >
                                                        <i class="bx bx-edit"></i> 
                                                    </button>
                                                    <button class="btn btn-sm btn-danger" id="btn_delete" 
                                                        data-id="<?= $row->id ?>"
                                                        data-kode="<?= $row->kode ?>"
                                                        data-path="<?= base_url('armada/delete/armada') ?>"
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
                <h5 class="modal-title text-light" id="myLargeModalLabel">Tambah Armada</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" id="form_modal_add" method="POST">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="kode" class="form-label">Kode</label>
                            <input class="form-control text-center" type="text" id="kode" name="kode" placeholder="Kode Armada" />
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-control" data-trigger name="type" id="type" placeholder="Pilih Tipe Kendaraan">
                                <option value="">Pilih Tipe Kendaraan</option>
                                <?php
                                    foreach($list_tipe_kendaraan as $row){
                                        echo '<option value="'.$row.'"> '.$row.' </option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="brand" class="form-label">Brand</label>
                            <select class="form-control" data-trigger name="brand" id="brand" placeholder="Pilih Brand Kendaraan">
                                <option value="">Pilih Brand Kendaraan</option>
                                <?php
                                    foreach($list_brand_kendaraan as $row){
                                        echo '<option value="'.$row.'"> '.$row.' </option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="unit_name" class="form-label">Nama Unit</label>
                            <input class="form-control" type="text" id="unit_name" name="unit_name" placeholder="Nama Unit Kendaraan" />
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="plat_number" class="form-label">Plat Nomor</label>
                            <input class="form-control" type="text" id="plat_number" name="plat_number" placeholder="Plat Nomor Kendaraan" />
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="kapasitas_kursi" class="form-label">Kapasitas Kursi</label>
                            <input class="form-control text-center" type="number" id="kapasitas_kursi" name="kapasitas_kursi" />
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="kapasitas_beban" class="form-label">Kapasitas Beban (Kg)</label>
                            <input class="form-control text-center" type="number" id="kapasitas_beban" name="kapasitas_beban" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12" style="text-align: right">
                            <button type="button" class="btn btn-primary ml-3" id="btn-simpan" data-object="<?= base_url('armada/add/armada') ?>">
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
                            <label for="kode" class="form-label">Kode</label>
                            <input class="form-control text-center" type="text" id="kode_edit" name="kode_edit" placeholder="Kode Armada" />
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="type" class="form-label">Type <span id="type_saat_ini"></span></label>
                            <select class="form-control" data-trigger name="type_edit" id="type_edit" placeholder="Pilih Tipe Kendaraan">
                                <option value="">Pilih Tipe Kendaraan</option>
                                <?php
                                    foreach($list_tipe_kendaraan as $row){
                                        echo '<option value="'.$row.'"> '.$row.' </option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="brand" class="form-label">Brand <span id="brand_saat_ini"></span></label>
                            <select class="form-control" data-trigger name="brand_edit" id="brand_edit" placeholder="Pilih Brand Kendaraan">
                                <option value="">Pilih Brand Kendaraan</option>
                                <?php
                                    foreach($list_brand_kendaraan as $row){
                                        echo '<option value="'.$row.'"> '.$row.' </option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="unit_name" class="form-label">Nama Unit</label>
                            <input class="form-control" type="text" id="unit_name_edit" name="unit_name_edit" placeholder="Nama Unit Kendaraan" />
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="plat_number" class="form-label">Plat Nomor</label>
                            <input class="form-control" type="text" id="plat_number_edit" name="plat_number_edit" placeholder="Plat Nomor Kendaraan" />
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="kapasitas_kursi" class="form-label">Kapasitas Kursi</label>
                            <input class="form-control text-center" type="number" id="kapasitas_kursi_edit" name="kapasitas_kursi_edit" />
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="kapasitas_beban" class="form-label">Kapasitas Beban (Kg)</label>
                            <input class="form-control text-center" type="number" id="kapasitas_beban_edit" name="kapasitas_beban_edit" />
                        </div>
                    </div>
                    <div class="row">
                        <input type="hidden" name="id_edit" id="id_edit" />
                        <div class="col-lg-12" style="text-align: right">
                            <button type="button" class="btn btn-primary ml-3" id="btn-simpan-edit" data-object="<?= base_url('armada/edit/armada') ?>">
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
    // const filterNamaElement = document.getElementById('filter_nama');
    // const filterProvinsiElement = document.getElementById('filter_provinsi');
    // const filterKotaElement = document.getElementById('filter_kota');
    // const filterNamaChoices = new Choices(filterNamaElement);
    // const filterProvinsiChoices = new Choices(filterProvinsiElement);
    // const filterKotaChoices = new Choices(filterKotaElement);
    
    // main datatable ==============================================================================================================================================
    // function to reload
    function reloadMainDatatable(filterList) {
        fetch(`${baseUrl}/armada/ajax_get/main_table_data`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                // filter_nama: filterNama,
                // filter_provinsi: filterProvinsi,
                // filter_kota: filterKota,
            }),
        })
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector('#datatable-buttons tbody');
            tableBody.innerHTML = data.html;
        })
        .catch(error => console.error('Error:', error));
    }
    
    // filter main table
    document.getElementById('form-filter').addEventListener('submit', function (e) {
        e.preventDefault();
        reloadMainDatatable();
    });

    // kota dropdown by provinsi ====================================================================================================================================
    


    // add armada ================================================================================================================================================
    $(document).on('click', '#btn-simpan', function () {
        const path = $(this).data('object');
        const data = {};
        const inputFields = ["kode", "type", "brand", "unit_name", "plat_number", "kapasitas_kursi", "kapasitas_beban"];
        
        inputFields.forEach(field => {
            data[field] = $('#' + field).val();
        });
        
        loadSaveSwal(path, data, 'Tambah Armada?', 'Disimpan!', 'Armada baru berhasil disimpan.', 'modal_add');
    });
    
    // show edit modal ==============================================================================================================================================
    $(document).on('click', '#btn_edit', function() {
        const data = $(this).data();
        
        $('#id_edit').val(data['id']);
        $('#kode_edit').val(data['kode']);
        $('#unit_name_edit').val(data['unit_name']);
        $('#plat_number_edit').val(data['plat_number']);
        $('#kapasitas_kursi_edit').val(data['kapasitas_kursi']);
        $('#kapasitas_beban_edit').val(data['kapasitas_beban']);
        $("#type_saat_ini").text(`saat ini: ${data['type']}`);
        $("#brand_saat_ini").text(`saat ini: ${data['brand']}`);
    
        $('#modal_edit').modal('show');
    });
    
    // edit armada ================================================================================================================================================
    $(document).on('click', '#btn-simpan-edit', function () {
        const path = $(this).data('object');
        const data = {};
        const inputFields = [
            "id_edit", 
            "kode_edit", 
            "type_edit", 
            "brand_edit", 
            "unit_name_edit", 
            "plat_number_edit", 
            "kapasitas_kursi_edit", 
            "kapasitas_beban_edit"
        ];
        
        inputFields.forEach(field => {
            data[field] = $('#' + field).val();
        });
        
        loadSaveSwal(path, data, 'Edit Armada?', 'Disimpan!', 'Armada dengan kode: '+data['kode_edit']+' berhasil diedit.', 'modal_edit');
    });
    
    // delete armada ================================================================================================================================================
    $(document).on('click', '#btn_delete', function () {
        const thisData = $(this).data();
        const path = thisData['path'];
        const data = {
            id : thisData['id']
        };
        
        loadSaveSwal(path, data, 'Hapus Armada Dengan Kode '+thisData['kode']+' ?', 'Dihapus!', 'Armada dengan kode: '+thisData['kode']+' berhasil dihapus.', '');
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


