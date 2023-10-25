<?php
// koneksi dengan database
include_once("koneksi.php");

if (isset($_POST['Submit'])) {
    if (!empty($_POST['nama']) && isset($_POST['kelas']) && !empty($_POST['Keterangan']) || !empty($_POST['alasan'])) {

        $nama = $_POST['nama'];
        $kelas = $_POST['kelas'];
        $Keterangan = $_POST['Keterangan'];
        $alasan = $_POST['alasan'];

        // Menentukan keterangan berdasarkan Keterangan
        if ($Keterangan == 'Hadir') {
            $keterangan = 'Hadir';
        } elseif ($Keterangan == 'Izin') {
            $keterangan = 'Izin';
        } elseif ($Keterangan == 'Sakit') {
            $keterangan = 'Sakit';
        }

        // Memasukkan data ke dalam database
        $add = mysqli_query($mysqli, "INSERT INTO absensi (nama, kelas, keterangan, alasan) VALUES ('$nama', '$kelas', '$keterangan','$alasan' )");

        if ($add) {
            echo "Data berhasil ditambahkan.";
        } else {
            echo "Terjadi kesalahan saat menambahkan data: " . mysqli_error($mysqli);
        }
    }
}

// Mengambil semua data dari database
$results = mysqli_query($mysqli, "SELECT * FROM Absensi ORDER BY id DESC");
?>

<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="">
    <title>Abeasy</title>
</head>
<style>
    /* CSS untuk membuat navbar tetap di atas saat discroll */
    .sticky-navbar {
        position: sticky;
        top: 0;
        z-index: 100;
    }
</style>

<body>

    <nav class="navbar navbar-dark bg-dark sticky-navbar">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">ABEASY</span>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Log Out</a>
                </li>
            </ul>
        </div>
    </nav>


    <div class="bg-success p-2 text-dark bg-opacity-10">
        <h1 class="p-4 text-center">ABSENSI PPLG JAYA</h1>
        <div class="container">
            <form action="" method="post" name="form_absen">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" placeholder="Nama">
                </div>
                <div class="mb-3">
                    <label class="form-label">Kelas</label>
                    <input type="text" class="form-control" name="kelas" placeholder="Kelas">
                </div>
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="Keterangan" value="Hadir">
                        <label class="form-check-label">Hadir</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="Keterangan" value="Izin">
                        <label class="form-check-label">Izin</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="Keterangan" value="Sakit">
                        <label class="form-check-label">Sakit</label>
                    </div>
                </div>
                <div class="mb-3" id="alasan_div" style="display: none;">
                    <label class="form-label">Alasan</label>
                    <input type="text" class="form-control" name="alasan" placeholder="Alasan">
                    <div id="alasan_error" class="text-danger"></div>
                </div>

                <div class="text-center">
                    <button type="reset" class="btn btn-danger" name="Reset">Reset</button>
                    <button type="submit" class="btn btn-success" name="Submit">Submit</button>
                </div>
            </form>

            <table class="my-5 table table-striped">
                <tr class="table-dark">
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Keterangan</th>
                    <th>Waktu Kehadiran</th>
                    <th>Alasan</th>
                </tr>

                <?php
                $results->fetch_all(MYSQLI_ASSOC);
                foreach ($results as $result):
                    ?>
                    <tr>

                        <td>
                            <?= $result['nama'] ?>
                        </td>
                        <td>
                            <?= $result['kelas'] ?>
                        </td>
                        <td>
                            <?= $result['keterangan'] ?>
                        </td>
                        <td>
                            <?= $result['waktu_kehadiran'] ?>
                        </td>
                        <td>
                            <?= $result['alasan'] ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity=""></script>
    <script>
        var keteranganRadios = document.querySelectorAll('input[name="Keterangan"]');
        var alasanDiv = document.getElementById('alasan_div');

        keteranganRadios.forEach(function (radio) {
            radio.addEventListener('change', function () {
                if (radio.value === 'Sakit' || radio.value === 'Izin') {
                    // Tampilkan form alasan jika Sakit atau Izin dipilih
                    alasanDiv.style.display = 'block';
                } else {
                    // Sembunyikan form alasan jika Hadir dipilih
                    alasanDiv.style.display = 'none';
                }
            });
        });
    </script>

<script>
    var keteranganRadios = document.querySelectorAll('input[name="Keterangan"]');
    var alasanInput = document.querySelector('input[name="alasan"]');
    var alasanError = document.getElementById('alasan_error');
    var formAbsen = document.forms['form_absen'];

    keteranganRadios.forEach(function (radio) {
        radio.addEventListener('change', function () {
            if (radio.value === 'Sakit' || radio.value === 'Izin') {
                // Tampilkan form alasan jika Sakit atau Izin dipilih
                alasanDiv.style.display = 'block';
            } else {
                // Sembunyikan form alasan jika Hadir dipilih
                alasanDiv.style.display = 'none';
                alasanError.textContent = ''; // Hapus pesan kesalahan
            }
        });
    });

    formAbsen.addEventListener('submit', function (event) {
        // Cek apakah Izin atau Sakit dipilih
        var selectedKeterangan = document.querySelector('input[name="Keterangan"]:checked');
        if (selectedKeterangan && (selectedKeterangan.value === 'Izin' || selectedKeterangan.value === 'Sakit')) {
            // Izin atau Sakit dipilih, maka validasi alasan
            if (alasanInput.value.trim() === '') {
                alasanError.textContent = 'Alasan harus diisi.'; // Tampilkan pesan kesalahan
                alasanInput.focus();
                event.preventDefault(); // Mencegah pengiriman formulir
            }
        } else {
            alasanError.textContent = ''; // Hapus pesan kesalahan jika Hadir dipilih
        }
    });
</script>


</body>

</html>