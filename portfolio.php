<?php include 'config/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio - LensaLokal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }


        .page-header {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            padding: 80px 0 60px;
            color: white;
            text-align: center;
            margin-bottom: 50px;
        }


        .portfolio-item {
            position: relative;
            overflow: hidden;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            background: white;
            transition: transform 0.3s ease;
        }

        .portfolio-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .portfolio-img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .portfolio-item:hover .portfolio-img {
            transform: scale(1.05);
        }

        .portfolio-content {
            padding: 20px;
            background: white;
            position: relative;
        }

        .category-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255, 255, 255, 0.9);
            color: #0d6efd;
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(4px);
            z-index: 2;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top py-3 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php">
                <img src="assets/img/LoGo.png" alt="Logo" height="40" class="me-2">
                <span>LensaLokal</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#services">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link active fw-bold" href="portfolio.php">Portofolio</a></li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-outline-light btn-sm px-4 rounded-pill" href="admin/index.php">
                            <i class="bi bi-person-circle me-1"></i> Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="page-header">
        <div class="container">
            <h1 class="fw-bold display-5">Galeri Karya</h1>
            <p class="lead opacity-75">Bukti dedikasi kami dalam mengabadikan momen berharga.</p>
        </div>
    </header>

    <div class="container pb-5">

        <div class="d-flex justify-content-center mb-5">
            <span class="text-muted small text-uppercase fw-bold tracking-wide">
                <i class="bi bi-grid-3x3-gap me-1"></i> Menampilkan Semua Karya Terbaru
            </span>
        </div>

        <div class="row g-4">
            <?php
            $query = "SELECT p.*, s.nama_layanan 
              FROM portfolios p 
              JOIN services s ON p.service_id = s.id 
              ORDER BY p.id DESC";
            $result = $conn->query($query);

            if ($result->rowCount() > 0) {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="portfolio-item h-100">
                            <span class="category-badge">
                                <i class="bi bi-tag-fill me-1"></i> <?php echo $row['nama_layanan']; ?>
                            </span>

                            <div class="overflow-hidden" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalFoto<?php echo $row['id']; ?>">
                                <img src="assets/img/<?php echo $row['file_gambar']; ?>" class="portfolio-img" alt="Karya">

                                <div class="d-flex justify-content-center align-items-center mt-2">
                                    <small class="text-primary"><i class="bi bi-zoom-in"></i> Klik untuk memperbesar</small>
                                </div>
                            </div>

                            <div class="portfolio-content">
                                <h5 class="fw-bold mb-1"><?php echo $row['judul_karya']; ?></h5>
                                <p class="text-muted small mb-0">Project Dokumentasi Profesional</p>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modalFoto<?php echo $row['id']; ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content bg-transparent border-0">

                                <div class="text-end mb-2">
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <img src="assets/img/<?php echo $row['file_gambar']; ?>" class="img-fluid rounded shadow-lg" alt="Preview">

                                <div class="text-center mt-3">
                                    <h5 class="text-white fw-bold"><?php echo $row['judul_karya']; ?></h5>
                                    <span class="badge bg-primary"><?php echo $row['nama_layanan']; ?></span>
                                </div>

                            </div>
                        </div>
                    </div>

            <?php
                }
            } else {
                echo "
        <div class='col-12 text-center py-5'>
            <i class='bi bi-images display-1 text mb-3'></i>
            <h4 class='text'>Belum ada portofolio yang diupload.</h4>
        </div>";
            }
            ?>
        </div>

        <div class="card bg-dark text-white mt-5 border-0 rounded-4 overflow-hidden shadow-lg">
            <div class="card-body p-5 text-center position-relative">
                <div style="position:absolute; top:-50px; left:-50px; width:150px; height:150px; background:rgba(255,255,255,0.1); border-radius:50%;"></div>

                <h2 class="fw-bold mb-3">Suka dengan hasil karya kami?</h2>
                <p class="mb-4 text-white-50">Jangan biarkan momen spesialmu berlalu begitu saja tanpa dokumentasi terbaik.</p>
                <a href="index.php#services" class="btn btn-primary btn-lg rounded-pill px-5">
                    Lihat Paket Harga <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>

    </div>

    <footer class="bg-white pt-5 pb-3 border-top mt-5">
        <div class="container text-center">
            <h5 class="fw-bold text-dark mb-3">LensaLokal</h5>
            <div class="mb-3">
                <a href="https://www.instagram.com/alim.visual5/?hl=id" class="text-secondary text-decoration-none mx-2">Instagram</a>
                <a href="https://www.tiktok.com/@alimvisual5?is_from_webapp=1&sender_device=pc" class="text-secondary text-decoration-none mx-2">TikTok</a>
            </div>
            <p class="small text">&copy; 2025 LensaLokal. Powered by Kreativitas Lokal.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>