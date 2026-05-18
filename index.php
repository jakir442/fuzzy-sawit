<?php
include "config/koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Fuzzy Produksi Minyak Sawit</title>
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

        .card-header-custom {
            background: #198754;
            color: white;
            padding: 30px 20px;
        }

        .icon-box {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: auto;
            margin-bottom: 15px;
        }

        .icon-box i {
            font-size: 40px;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px;
        }

        .btn-custom {
            background: #198754;
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-custom:hover {
            background: #157347;
            transform: translateY(-2px);
        }

        .info-box {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 15px;
            font-size: 16px;
        }

        .footer-text {
            font-size: 15px;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card shadow-lg card-custom">
                    <!-- HEADER -->
                    <div class="card-header-custom text-center">
                        <div class="icon-box">
                            <i class="bi bi-droplet-half"></i>
                        </div>
                        <h2 class="fw-bold mb-1">
                            Fuzzy Mamdani
                        </h2>
                        <p class="mb-0">
                            Sistem Kontrol Produksi Minyak Sawit
                        </p>
                    </div>

                    <!-- BODY -->
                    <div class="card-body p-4">
                        <div class="info-box mb-4">
                            <i class="bi bi-info-circle-fill text-success"></i>
                            Sistem ini membantu perusahaan menentukan jumlah produksi
                            minyak sawit berdasarkan permintaan dan persediaan menggunakan
                            metode Fuzzy Mamdani.
                        </div>
                        <form action="proses.php" method="POST">

                            <!-- PERMINTAAN -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-bar-chart-fill text-success"></i>
                                    Permintaan
                                </label>
                                <input
                                    type="number"
                                    name="permintaan"
                                    class="form-control"
                                    placeholder="Contoh: 70"
                                    required>
                            </div>

                            <!-- PERSEDIAAN -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-box-seam-fill text-success"></i>
                                    Persediaan
                                </label>
                                <input
                                    type="number"
                                    name="persediaan"
                                    class="form-control"
                                    placeholder="Contoh: 40"
                                    required>
                            </div>

                            <!-- BUTTON -->
                            <button
                                type="submit"
                                name="submit"
                                class="btn btn-success btn-custom w-100">
                                <i class="bi bi-cpu-fill"></i>
                                Proses Fuzzy
                            </button>
                        </form>
                    </div>

                    <!-- FOOTER -->
                    <div class="card-footer bg-white text-center py-3">
                        <span class="footer-text">
                            © 2026 Sistem Fuzzy Produksi Minyak Sawit - KELOMPOK 4
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>