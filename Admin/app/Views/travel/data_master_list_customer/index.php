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

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Gender</th>
                                            <th>No HP</th>
                                            <th>Provinsi</th>
                                            <th>Kota</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $counter = 0;
                                            foreach($data_customer as $row):
                                                $counter += 1;
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $counter ?></td>
                                                <td class="text-center"><?= $row->kode ?></td>
                                                <td><?= $row->name ?></td>
                                                <td class="text-center"><?= format_gender($row->gender) ?></td>
                                                <td class="text-center"><?= $row->hp ?></td>
                                                <td class="text-center"><?= $row->nama_provinsi ?></td>
                                                <td class="text-center"><?= $row->nama_kota ?></td>
                                                <td><?= $row->alamat ?></td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-info" id="btn_edit"
                                                        data-id="<?= $row->id ?>"
                                                        data-nama="<?= $row->name ?>"
                                                        data-gender="<?= $row->gender ?>"
                                                        data-hp="<?= $row->hp ?>"
                                                        data-provinsi="<?= $row->nama_provinsi ?>"
                                                        data-kota="<?= $row->nama_kota ?>"
                                                        data-alamat="<?= $row->alamat ?>"
                                                    >
                                                        <i class="bx bx-edit"></i> 
                                                    </button>
                                                    <button class="btn btn-sm btn-danger" id="btn_delete" 
                                                        data-id="<?= $row->id ?>"
                                                        data-nama="<?= $row->name ?>"
                                                        data-path="<?= base_url('customer/delete/customer') ?>"
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

<script src="assets/js/app.js"></script>

</body>
</html>

<script>
    // get base URL ================================================================================================================================================
    const baseUrl = "<?= base_url() ?>";
    
    // variable
    const filterNamaElement = document.getElementById('filter_nama');
    const filterProvinsiElement = document.getElementById('filter_provinsi');
    const filterKotaElement = document.getElementById('filter_kota');
    const filterNamaChoices = new Choices(filterNamaElement);
    const filterProvinsiChoices = new Choices(filterProvinsiElement);
    const filterKotaChoices = new Choices(filterKotaElement);
    
    // main datatable ==============================================================================================================================================
    // function to reload
    function reloadMainDatatable(filterNama, filterProvinsi, filterKota) {
        fetch(`${baseUrl}/customer/ajax_get/main_table_data`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                filter_nama: filterNama,
                filter_provinsi: filterProvinsi,
                filter_kota: filterKota,
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
        reloadMainDatatable(filterNamaElement.value, filterProvinsiElement.value, filterKotaElement.value);
    });

    // kota dropdown by provinsi ====================================================================================================================================
    


    // add customer ================================================================================================================================================
    $(document).on('click', '#btn-simpan', function () {
        const path = $(this).data('object');
        const data = {
            name: $("#name").val(),
            hp: $("#hp").val(),
            gender: $("input[name='gender']:checked").val(),
            kode_provinsi: $("#provinsi").val(),
            kode_kota: $("#kota").val(),
            alamat: $("#alamat").val()
        };
        
        loadSaveSwal(path, data, 'Tambah Customer?', 'Disimpan!', 'Customer baru berhasil disimpan.', 'modal_add');
    });
    
    // show edit modal ==============================================================================================================================================
    $(document).on('click', '#btn_edit', function() {
        const data = $(this).data();
        
        $('#id_edit').val(data['id']);
        $('#nama_edit').val(data['nama']);
        $('#hp_edit').val(data['hp']);
        $(`input[name="gender_edit"][value="${data['gender']}"]`).prop('checked', true);
        $("#provinsi_saat_ini").text(`saat ini: ${data['provinsi']}`);
        $("#kota_saat_ini").text(`saat ini: ${data['kota']}`);
        $('#alamat_edit').val(data['alamat']);
    
        $('#modal_edit').modal('show');
    });
    
    // edit customer ================================================================================================================================================
    $(document).on('click', '#btn-simpan-edit', function () {
        const path = $(this).data('object');
        const data = {
            id_edit: $("#id_edit").val(),
            nama_edit: $("#nama_edit").val(),
            hp_edit: $("#hp_edit").val(),
            gender_edit: $("input[name='gender_edit']:checked").val(),
            provinsi_edit: $("#provinsi_edit").val(),
            kota_edit: $("#kota_edit").val(),
            alamat_edit: $("#alamat_edit").val()
        };
        
        loadSaveSwal(path, data, 'Edit Customer?', 'Disimpan!', 'Customer '+data['nama_edit']+' berhasil diedit.', 'modal_edit');
    });
    
    // delete customer ==============================================================================================================================================
    $(document).on('click', '#btn_delete', function () {
        const thisData = $(this).data();
        const path = thisData['path'];
        const data = {
            id : thisData['id']
        };
        
        loadSaveSwal(path, data, 'Hapus Customer Dengan Nama: '+thisData['nama']+' ?', 'Dihapus!', 'Customer dengan Nama: '+thisData['nama']+' berhasil dihapus.', '');
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


