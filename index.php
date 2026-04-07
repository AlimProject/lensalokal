<?php include 'config/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LensaLokal - Jasa Dokumentasi Profesional</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('assets/img/Banner.JPG');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .service-card {
            border: none;
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 12px;
            overflow: hidden;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .service-img {
            height: 220px;
            object-fit: cover;
        }

        .price-tag {
            font-size: 1.2rem;
            font-weight: 700;
            color: #0d6efd;
        }

        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 3rem;
            font-weight: 700;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: #0d6efd;
            margin: 10px auto 0;
            border-radius: 2px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top py-3 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php">
                <img src="assets/img/Logo.png" alt="Logo" height="40" class="me-2">
                <span>LensaLokal</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active fw-bold" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#services">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="portfolio.php">Portofolio</a></li>
                    <ul class="navbar-nav ms-auto align-items-center">
                        <a class="btn btn-outline-light btn-sm px-4 rounded-pill d-inline-flex align-items-center" href="admin/index.php">
                            <i class="bi bi-person-circle me-2"></i> Admin
                        </a>
                        </li>
                    </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section">
        <div class="container">
            <h1 class="display-3 fw-bold mb-3">Abadikan Momen Terbaikmu</h1>
            <p class="lead mb-4">Jasa fotografi & videografi profesional dengan sentuhan kearifan lokal.</p>
            <a href="#services" class="btn btn-primary btn-lg rounded-pill px-5 py-3 shadow">
                Pesan Sekarang <i class="bi bi-arrow-right-short"></i>
            </a>
        </div>
    </header>

    <section class="py-5 bg-white">
        <div class="container text-center">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-3">
                        <i class="bi bi-star-fill text-warning display-4 mb-3"></i>
                        <h5 class="fw-bold">Hasil Profesional</h5>
                        <p class="text-muted">Didukung peralatan modern dan editor berpengalaman untuk hasil maksimal.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3">
                        <i class="bi bi-people-fill text-primary display-4 mb-3"></i>
                        <h5 class="fw-bold">Talenta Lokal</h5>
                        <p class="text-muted">Memberdayakan fotografer daerah untuk ekonomi yang berkelanjutan (SDG 8).</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3">
                        <i class="bi bi-wallet2 text-success display-4 mb-3"></i>
                        <h5 class="fw-bold">Harga Transparan</h5>
                        <p class="text-muted">Tidak ada biaya tersembunyi. Paket hemat dengan kualitas premium.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="py-5 bg-light" style="scroll-margin-top: 80px;">
        <div class="container">
            <div class="text-center">
                <h2 class="section-title">Pilihan Paket Layanan</h2>
            </div>

            <div class="row g-4 justify-content-center">
                <?php
                $query = $conn->query("SELECT * FROM services ORDER BY harga ASC");
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <div class="col-md-4 col-sm-6">
                        <div class="card service-card h-100 shadow-sm">
                            <img src="assets/img/<?php echo $row['gambar']; ?>" class="card-img-top service-img" alt="<?php echo $row['nama_layanan']; ?>">

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold"><?php echo $row['nama_layanan']; ?></h5>
                                <p class="card-text text-muted small flex-grow-1">
                                    <?php echo substr($row['deskripsi'], 0, 100); ?>...
                                </p>

                                <hr class="my-3">

                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="price-tag">Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></span>
                                </div>

                                <a href="booking.php?id=<?php echo $row['id']; ?>" class="btn btn-dark w-100 mt-3 rounded-pill">
                                    Booking Jadwal <i class="bi bi-calendar-check ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <section class="py-5 bg-primary text-white text-center">
        <div class="container">
            <h2 class="fw-bold mb-3">Siap Mengabadikan Momenmu?</h2>
            <p class="mb-4">Konsultasikan kebutuhan dokumentasi acaramu bersama kami.</p>
            <a href="https://wa.me/85657282014" target="_blank" class="btn btn-light btn-lg rounded-pill px-4 text-primary fw-bold">
                <i class="bi bi-whatsapp me-2"></i> Chat WhatsApp
            </a>
        </div>
    </section>

    <footer class="bg-dark text-white pt-5 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <img src="assets/img/LoGo.png" alt="Logo LensaLokal" height="40" class="me-2">
                        <h5 class="fw-bold text-white mb-0">LensaLokal</h5>
                    </div>
                    <p class="small text">Platform booking jasa foto & video yang mendukung pertumbuhan ekonomi kreatif lokal.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3">Link Cepat</h5>
                    <ul class="list-unstyled small">
                        <li><a href="#" class="text text-decoration-none">Beranda</a></li>
                        <li><a href="#services" class="text text-decoration-none">Layanan</a></li>
                        <li><a href="portfolio.php" class="text text-decoration-none">Portofolio</a></li>
                        <li><a href="admin/index.php" class="text text-decoration-none">Login Admin</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3">Hubungi Kami</h5>
                    <p class="small text">
                        <i class="bi bi-geo-alt me-2"></i> Jl. Kreatif No. 8, Jakarta<br>
                        <i class="bi bi-envelope me-2"></i> halo@lensalokal.com
                    </p>
                </div>
            </div>
            <hr class="border-secondary">
            <div class="text-center small text">
                &copy; 2025 LensaLokal. All Rights Reserved.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>