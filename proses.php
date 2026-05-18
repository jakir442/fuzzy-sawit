<?php

include "config/koneksi.php";

//mencek tombol submit
if (isset($_POST['submit'])) {

    //mengambil input
    $permintaan = $_POST['permintaan'];
    $persediaan = $_POST['persediaan'];

    //menyimpan data input

    $simpan_input = mysqli_query($conn, "
        INSERT INTO input_produksi (permintaan, persediaan)
        VALUES ('$permintaan', '$persediaan')
    ");

    $input_id = mysqli_insert_id($conn);

    //----------------fuzzifikasi-------------

    //===permintaan===

    //rendah
    if ($permintaan <= 40) {
        $permintaan_rendah = 1;
    } elseif ($permintaan > 40 && $permintaan < 60) {
        $permintaan_rendah = (60 - $permintaan) / 20;
    } else {
        $permintaan_rendah = 0;
    }

    //sedang
    if ($permintaan <= 40 || $permintaan >= 80) {
        $permintaan_sedang = 0;
    } elseif ($permintaan >= 40 && $permintaan <= 60) {
        $permintaan_sedang = ($permintaan - 40) / 20;
    } else {
        $permintaan_sedang = (80 - $permintaan) / 20;
    }

    //tinggi
    if ($permintaan >= 80) {
        $permintaan_tinggi = 1;
    } elseif ($permintaan > 60 && $permintaan < 80) {
        $permintaan_tinggi = ($permintaan - 60) / 20;
    } else {
        $permintaan_tinggi = 0;
    }

    //===persediaan===

    // rendah
    if ($persediaan <= 40) {
        $persediaan_rendah = 1;
    } elseif ($persediaan > 40 && $persediaan < 60) {
        $persediaan_rendah = (60 - $persediaan) / 20;
    } else {
        $persediaan_rendah = 0;
    }

    // sedang
    if ($persediaan <= 40 || $persediaan >= 80) {
        $persediaan_sedang = 0;
    } elseif ($persediaan >= 40 && $persediaan <= 60) {
        $persediaan_sedang = ($persediaan - 40) / 20;
    } else {
        $persediaan_sedang = (80 - $persediaan) / 20;
    }

    // tinggi
    if ($persediaan >= 80) {
        $persediaan_tinggi = 1;
    } elseif ($persediaan > 60 && $persediaan < 80) {
        $persediaan_tinggi = ($persediaan - 60) / 20;
    } else {
        $persediaan_tinggi = 0;
    }

    //------------- RULE BASE -------------
  
    //Produksi Rendah
    $r1 = min($permintaan_rendah, $persediaan_tinggi);
    $r2 = min($permintaan_rendah, $persediaan_sedang);
    $r3 = min($permintaan_rendah, $persediaan_rendah);
    $r4 = min($permintaan_sedang, $persediaan_tinggi);

    //Produksi Sedang
    $r5 = min($permintaan_sedang, $persediaan_sedang);

    //Produksi Tinggi
    $r6 = min($permintaan_sedang, $persediaan_rendah);
    $r7 = min($permintaan_tinggi, $persediaan_tinggi);
    $r8 = min($permintaan_tinggi, $persediaan_sedang);
    $r9 = min($permintaan_tinggi, $persediaan_rendah);

    //------- AGREGASI ----------

    $produksi_rendah = max($r1, $r2, $r3, $r4);
    $produksi_sedang = $r5;
    $produksi_tinggi = max($r6, $r7, $r8, $r9);

    //------------DEFUZZIFIKASI----------------

    $hasil =
        (
            ($produksi_rendah * 30) +
            ($produksi_sedang * 60) +
            ($produksi_tinggi * 90)
        )
        /
        (
            $produksi_rendah +
            $produksi_sedang +
            $produksi_tinggi
        );


    //-------- KATEGORI HASIL---------
    // ===============================

    if ($hasil <= 40) {
        $kategori = "Rendah";
    } elseif ($hasil <= 70) {
        $kategori = "Sedang";
    } else {
        $kategori = "Tinggi";
    }

    // --------SIMPAN HASIL----------
    // ===============================

    mysqli_query($conn, "
        INSERT INTO hasil_produksi (
            input_id,
            nilai_produksi,
            kategori_produksi
        ) VALUES (
            '$input_id',
            '$hasil',
            '$kategori'
        )
    ");

} else {

    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hasil Fuzzy Mamdani</title>

    <link href="bootstrap-5/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #198754, #14532d);
            min-height: 100vh;
        }

        .card-custom {
            border-radius: 20px;
            overflow: hidden;
            border: none;
        }

        .header-custom {
            background: #198754;
            color: white;
            padding: 25px;
        }

        .hasil-box {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
        }

        .nilai-hasil {
            font-size: 45px;
            font-weight: bold;
            color: #198754;
        }
    </style>
</head>

<body>

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-md-7">

                <div class="card shadow-lg card-custom">

                    <div class="header-custom text-center">
                        <h2>Hasil Perhitungan Fuzzy Mamdani</h2>
                    </div>

                    <div class="card-body p-4">

                        <div class="row mb-4">

                            <div class="col-md-6">
                                <div class="hasil-box text-center">
                                    <h5>Permintaan</h5>
                                    <h3><?= $permintaan; ?></h3>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="hasil-box text-center">
                                    <h5>Persediaan</h5>
                                    <h3><?= $persediaan; ?></h3>
                                </div>
                            </div>

                        </div>

                        <div class="hasil-box text-center">

                            <h4>Nilai Produksi</h4>

                            <div class="nilai-hasil">
                                <?= round($hasil, 2); ?>
                            </div>

                            <h5 class="mt-3">
                                Kategori:
                                <span class="badge bg-success">
                                    <?= $kategori; ?>
                                </span>
                            </h5>

                        </div>

                        <div class="text-center mt-4">

                            <a href="index.php" class="btn btn-success">
                                Kembali
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>