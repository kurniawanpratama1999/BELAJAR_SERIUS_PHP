<?php
// search.php
// Menangani form method GET (misal: pencarian sederhana)

/*
1) Konsep dasar
- Form HTML mengirim data ke server menggunakan method="get" atau method="post".
- GET  : data dikirim lewat query string (URL). Berguna untuk pencarian / linkable requests. Batas ukuran, kurang aman untuk data sensitif.
- POST : data dikirim lewat body request. Cocok untuk pengiriman sensitif (password), file upload, atau data besar.

Di PHP:
- $_GET['nama'] — ambil nilai dari method GET.
- $_POST['nama'] — ambil nilai dari method POST.
- isset() — periksa apakah variabel ada (terdefinisi).
- empty() — periksa apakah kosong ("" , 0 , "0", NULL, false, array() dianggap kosong).

Praktik aman: selalu validasi dan sanitasi input sebelum penggunaan (menyimpan ke DB, menampilkan kembali, dsb).
*/
$keyword = isset($_GET['q']) ? trim($_GET['q']) : '';
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Search</title>
</head>

<body>
    <form method="get">
        <label for="q">Cari:</label>
        <input type="text" id="q" name="q" value="<?= htmlspecialchars($keyword) ?>">
        <button type="submit">Cari</button>
    </form>

    <?php if ($keyword !== ''): ?>
        <h2>Hasil pencarian untuk: <?= htmlspecialchars($keyword) ?></h2>
        <!-- Biasanya di sini Anda akan menjalankan query ke DB menggunakan prepared statement -->
    <?php endif; ?>
</body>

</html>

<?php
/*
Penjelasan singkat:
- isset($_GET['q']) memastikan q ada sebelum diakses.
- trim() menghapus whitespace di sekitar.
- htmlspecialchars() untuk mencegah XSS saat menampilkan kembali ke HTML.
*/
?>