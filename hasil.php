<?php
include "config/koneksi.php";

// ambil data terakhir
$query = mysqli_query($conn, "
    SELECT 
        input_produksi.*,
        hasil_produksi.nilai_produksi,
        hasil_produksi.kategori_produksi
    FROM input_produksi
    JOIN hasil_produksi
    ON input_produksi.id = hasil_produksi.input_id
    ORDER BY hasil_produksi.id DESC
    LIMIT 1
");

$data = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hasil Produksi Fuzzy</title>

    <!-- Bootstrap -->
    <link href="bootstrap-5/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #198754, #14532d);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .card-custom {
            border: none;
            border-radius: 20px;
            overflow: hidden;
        }

        .header-custom {
            background: #198754;
            color: white;
            padding: 30px;
        }

        .result-box {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
        }

        .result-number {
            font-size: 40px;
            font-weight: bold;
            color: #198754;
        }

        .badge-custom {
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 30px;
        }

        .btn-custom {
            border-radius: 12px;
            padding: 10px;
            font-weight: 600;
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-6">

                <div class="card shadow-lg card-custom">

                    <!-- HEADER -->
                    <div class="header-custom text-center">

                        <h2 class="fw-bold">
                            <i class="bi bi-cpu-fill"></i>
                            Hasil Perhitungan Fuzzy
                        </h2>

                        <p class="mb-0">
                            Sistem Kontrol Produksi Minyak Sawit
                        </p>

                    </div>

                    <!-- BODY -->
                    <div class="card-body p-4">

                        <!-- INPUT -->
                        <div class="row mb-4">

                            <div class="col-md-6 mb-3">

                                <div class="result-box text-center">

                                    <i class="bi bi-bar-chart-fill text-success fs-1"></i>

                                    <h5 class="mt-2">
                                        Permintaan
                                    </h5>

                                    <h3 class="fw-bold">
                                        <?= $data['permintaan']; ?>
                                    </h3>

                                </div>

                            </div>

                            <div class="col-md-6 mb-3">

                                <div class="result-box text-center">

                                    <i class="bi bi-box-seam-fill text-success fs-1"></i>

                                    <h5 class="mt-2">
                                        Persediaan
                                    </h5>

                                    <h3 class="fw-bold">
                                        <?= $data['persediaan']; ?>
                                    </h3>

                                </div>

                            </div>

                        </div>

                        <!-- HASIL -->
                        <div class="result-box text-center mb-4">

                            <h5 class="mb-3">
                                Hasil Produksi
                            </h5>

                            <div class="result-number">
                                <?= round($data['nilai_produksi'], 2); ?>
                            </div>

                            <p class="text-muted">
                                Jumlah Produksi Minyak Sawit
                            </p>

                            <span class="badge bg-success badge-custom">
                                <?= $data['kategori_produksi']; ?>
                            </span>

                        </div>

                        <!-- BUTTON -->
                        <div class="d-grid">

                            <a href="index.php"
                                class="btn btn-success btn-custom">

                                <i class="bi bi-arrow-repeat"></i>
                                Hitung Lagi

                            </a>

                        </div>

                    </div>

                    <!-- FOOTER -->
                    <div class="card-footer text-center bg-white">

                        <small class="text-muted">
                            © 2026 Sistem Fuzzy Mamdani
                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>