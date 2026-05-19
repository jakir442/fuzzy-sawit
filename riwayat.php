<?php
include "config/koneksi.php";

// ambil data riwayat
$query = mysqli_query($conn, "
    SELECT 
        hp.id,
        ip.permintaan,
        ip.persediaan,
        hp.nilai_produksi,
        hp.kategori_produksi,
        hp.created_at
    FROM hasil_produksi hp
    JOIN input_produksi ip
    ON hp.input_id = ip.id
    ORDER BY hp.id DESC
");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Produksi</title>

    <!-- Bootstrap -->
    <link href="bootstrap-5/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: #f4f6f9;
        }

        .navbar-custom {
            background: linear-gradient(135deg, #198754, #14532d);
        }

        .card-custom {
            border: none;
            border-radius: 20px;
        }

        .table thead {
            background: #198754;
            color: white;
        }

        .badge-rendah {
            background: #dc3545;
        }

        .badge-sedang {
            background: #ffc107;
            color: black;
        }

        .badge-tinggi {
            background: #198754;
        }

        .title-page {
            font-weight: bold;
            color: #198754;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow">
        <div class="container">

            <a class="navbar-brand fw-bold" href="#">
                <i class="bi bi-droplet-half"></i>
                Fuzzy Sawit
            </a>

            <div>
                <a href="index.php" class="btn btn-light btn-sm">
                    <i class="bi bi-house-fill"></i>
                    Beranda
                </a>
            </div>

        </div>
    </nav>

    <!-- CONTENT -->
    <div class="container mt-5">

        <div class="row mb-4">
            <div class="col-md-12">

                <h2 class="title-page">
                    <i class="bi bi-clock-history"></i>
                    Riwayat Produksi Minyak Sawit
                </h2>

                <p class="text-muted">
                    Data hasil perhitungan fuzzy produksi minyak sawit.
                </p>

            </div>
        </div>

        <div class="card shadow card-custom">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead class="text-center">

                            <tr>
                                <th>No</th>
                                <th>Permintaan</th>
                                <th>Persediaan</th>
                                <th>Nilai Produksi</th>
                                <th>Kategori</th>
                                <th>Tanggal</th>
                            </tr>

                        </thead>

                        <tbody>

                            <?php
                            $no = 1;

                            while ($data = mysqli_fetch_assoc($query)) :

                                // badge kategori
                                if ($data['kategori_produksi'] == "Rendah") {
                                    $badge = "badge-rendah";
                                } elseif ($data['kategori_produksi'] == "Sedang") {
                                    $badge = "badge-sedang";
                                } else {
                                    $badge = "badge-tinggi";
                                }
                            ?>

                                <tr>

                                    <td class="text-center">
                                        <?= $no++; ?>
                                    </td>

                                    <td class="text-center">
                                        <?= $data['permintaan']; ?>
                                    </td>

                                    <td class="text-center">
                                        <?= $data['persediaan']; ?>
                                    </td>

                                    <td class="text-center fw-bold text-success">
                                        <?= $data['nilai_produksi']; ?>
                                    </td>

                                    <td class="text-center">
                                        <span class="badge <?= $badge; ?>">
                                            <?= $data['kategori_produksi']; ?>
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <?= date('d-m-Y H:i', strtotime($data['created_at'])); ?>
                                    </td>

                                </tr>

                            <?php endwhile; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</body>

</html>