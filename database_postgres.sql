CREATE TABLE admins (
  id SERIAL PRIMARY KEY,
  username varchar(50) NOT NULL,
  password varchar(255) NOT NULL,
  created_at timestamp NOT NULL DEFAULT current_timestamp
);

INSERT INTO admins (id, username, password, created_at) VALUES
(1, 'admin', 'admin123', '2025-12-29 09:08:56');

CREATE TABLE services (
  id SERIAL PRIMARY KEY,
  nama_layanan varchar(100) NOT NULL,
  deskripsi text,
  harga numeric(10,2) NOT NULL,
  gambar varchar(255),
  created_at timestamp NOT NULL DEFAULT current_timestamp
);

INSERT INTO services (id, nama_layanan, deskripsi, harga, gambar, created_at) VALUES
(2, 'WEDDING DOCUMENTATION', 'Foto & Video liputan akad + resepsi, Cinematic Video', 5000000.00, 'wedding.jpg', '2025-12-29 09:08:56'),
(4, 'EVENT DOCUMENTATION', 'Foto & Cinematic Video', 2000000.00, '2428_IMG_4291.jpg', '2026-01-23 16:29:19'),
(5, 'HUNTING', 'Butuh Teman Hunting 😊', 100000.00, '7311_IMG_0655.JPG', '2026-01-24 13:22:51');

CREATE TABLE bookings (
  id SERIAL PRIMARY KEY,
  nama_pemesan varchar(100) NOT NULL,
  no_wa varchar(20) NOT NULL,
  email varchar(100) DEFAULT NULL,
  tanggal_acara date NOT NULL,
  lokasi_acara text NOT NULL,
  service_id int REFERENCES services(id),
  status varchar(20) DEFAULT 'Pending' CHECK (status IN ('Pending','Confirmed','Completed','Cancelled')),
  created_at timestamp NOT NULL DEFAULT current_timestamp
);

INSERT INTO bookings (id, nama_pemesan, no_wa, email, tanggal_acara, lokasi_acara, service_id, status, created_at) VALUES
(1, 'fatur', '0987656782', NULL, '2026-01-05', 'cikarang', 2, 'Confirmed', '2025-12-29 09:18:33'),
(5, 'ALYA', '214152352352', NULL, '2026-01-27', 'awaes', 4, 'Confirmed', '2026-01-23 18:22:14'),
(6, 'andi', '0918247141892', NULL, '2026-01-25', 'bekasi', 4, 'Confirmed', '2026-01-24 12:29:44'),
(8, 'salma', '3829451011', NULL, '2026-01-31', 'jakarta', 4, 'Confirmed', '2026-01-24 13:19:42'),
(9, 'hadyan', '98698882491', NULL, '2026-02-01', 'mana ge', 2, 'Confirmed', '2026-01-31 11:18:23'),
(11, 'rian', '098987241', NULL, '2026-02-02', 'jakarta', 4, 'Confirmed', '2026-02-01 13:00:40'),
(12, 'nana', '0927357215', NULL, '2026-02-01', 'jepang', 4, 'Confirmed', '2026-02-01 16:14:56'),
(13, 'y', '0', NULL, '2026-02-02', 'y', 4, 'Confirmed', '2026-02-02 06:25:08'),
(14, 'ris', '065894', NULL, '2026-02-17', 'mana ge', 2, 'Confirmed', '2026-02-02 07:06:38');

CREATE TABLE portfolios (
  id SERIAL PRIMARY KEY,
  service_id int REFERENCES services(id) ON DELETE CASCADE,
  judul_karya varchar(100) DEFAULT NULL,
  file_gambar varchar(255) NOT NULL
);

INSERT INTO portfolios (id, service_id, judul_karya, file_gambar) VALUES
(1, 2, 'Wedding Bekasi', 'portofolio_8289.jpg'),
(2, 2, 'Wedding Bekasi', 'portofolio_1420.jpg'),
(3, 2, 'Wedding Bekasi', 'portofolio_57.jpg'),
(4, 2, 'Wedding Bekasi', 'portofolio_8404.jpg'),
(6, 2, 'Wedding Bekasi', 'portofolio_786.jpg'),
(7, 2, 'Wedding Bekasi', 'portofolio_3689.jpg'),
(8, 4, 'Lailatul Wada'' Ponpes Nurul Huda Setu', 'portofolio_4537.jpg'),
(9, 4, 'Lailatul Wada'' Ponpes Nurul Huda Setu', 'portofolio_9359.jpg'),
(10, 4, 'Lailatul Wada'' Ponpes Nurul Huda Setu', 'portofolio_9274.jpg'),
(11, 4, 'Lailatul Wada'' Ponpes Nurul Huda Setu', 'portofolio_7596.jpg'),
(12, 4, 'Lailatul Wada'' Ponpes Nurul Huda Setu', 'portofolio_336.jpg'),
(13, 4, 'Lailatul Wada'' Ponpes Nurul Huda Setu', 'portofolio_9358.jpg'),
(14, 4, 'Sholawat Kebangsaan Bersama Ganjar Pranowo di Ponpes Nurul Huda Setu', 'portofolio_4371.jpg'),
(15, 4, 'Rieke Diah Pitaloka di Acara Ponpes Nurul Huda', 'portofolio_4119.jpg'),
(16, 4, 'Kunjungan Rieke Diah Pitaloka di Ponpes Nurul Huda', 'portofolio_6248.jpg');

SELECT setval('admins_id_seq', (SELECT MAX(id) FROM admins));
SELECT setval('services_id_seq', (SELECT MAX(id) FROM services));
SELECT setval('bookings_id_seq', (SELECT MAX(id) FROM bookings));
SELECT setval('portfolios_id_seq', (SELECT MAX(id) FROM portfolios));
