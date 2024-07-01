<script src="<?= base_url('assets/libs/flatpickr/flatpickr.min.js'); ?>"></script>

<script>

    document.addEventListener('DOMContentLoaded', function() {
        flatpickr('.datepicker-basic', {
            dateFormat: 'd-m-Y',
        });
    });

    // swall loader
    function loadQuestionalSwal(
        path, data, title1, title2, text2, modalToHide="", isTableReload=true, isPageReload=false
    ) {
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
                        confirmButtonColor: "#5664d2"
                    }).then((result) => {
                        if(modalToHide!==""){
                            $('#'+modalToHide).modal('hide');   
                        }

                        if(isTableReload === true){
                            mainDatatable();
                        }

                        if(isPageReload === true){
                            location.reload();
                        }

                        if (response.isRedirect === true && response.redirectUrl) {
                            window.location.href = response.redirectUrl;
                        }

                        if (response.printData) {
                            console.log(response.printData, 'PRINT DATA');
                            // fetchEscposLogo().then(escposLogo => {
                            //     var receiptText = generatePlainTextReceipt(
                            //         response.printData.dataTransaksi,
                            //         response.printData.detailTransaksi,
                            //         response.printData.detailBayar,
                            //         escposLogo
                            //     );
                            //     BtPrint(receiptText);
                            // }).catch(error => {
                            //     console.error("Failed to load logo:", error);
                            // });
                            var receiptText = generatePlainTextReceipt(
                                response.printData.dataTransaksi,
                                response.printData.detailTransaksi,
                                response.printData.detailBayar
                            );
                            BtPrint(receiptText);
                            // BtPrint("Hello, World!");
                        }
                        
                    });
                }, 'json');
            }
        });
    }

    // swall  with form data
    function loadQuestionalSwalFormData(
        path, data, title1, title2, text2, modalToHide = "", isTableReload = true, isPageReload = false
    ) {
        Swal.fire({
            title: title1,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: path,
                    type: 'POST',
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire({
                            title: title2,
                            icon: 'success',
                            text: text2,
                            timer: 1000,
                            confirmButtonColor: "#5664d2"
                        }).then((result) => {
                            if (modalToHide !== "") {
                                $('#' + modalToHide).modal('hide');
                            }

                            if (isTableReload === true) {
                                mainDatatable();
                            }

                            if (isPageReload === true) {
                                location.reload();
                            }
                        });
                    },
                    dataType: 'json'
                });
            }
        });
    }

    // swall loader
    function loadQuestionalSwalResetElement(
        path, data, title1, title2, text2, modalToHide="", isResetElement=true
    ) {
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
                        confirmButtonColor: "#5664d2"
                    }).then((result) => {
                        if(modalToHide!==""){
                            $('#'+modalToHide).modal('hide');   
                        }

                        if (isResetElement === true) {
                            resetTheseElement();
                        }

                        if (response.isRedirect === true && response.redirectUrl) {
                            window.location.href = response.redirectUrl;
                        }

                        if (response.printData) {
                            console.log(response.printData, 'PRINT DATA');
                            // fetchEscposLogo().then(escposLogo => {
                            //     var receiptText = generatePlainTextReceipt(
                            //         response.printData.dataTransaksi,
                            //         response.printData.detailTransaksi,
                            //         response.printData.detailBayar,
                            //         escposLogo
                            //     );
                            //     BtPrint(receiptText);
                            // }).catch(error => {
                            //     console.error("Failed to load logo:", error);
                            // });
                            var receiptText = generatePlainTextReceipt(
                                response.printData.dataTransaksi,
                                response.printData.detailTransaksi,
                                response.printData.detailBayar
                            );
                            BtPrint(receiptText);
                            // BtPrint("Hello, World!");
                        }
                        
                    });
                }, 'json');
            }
        });
    }

</script>
