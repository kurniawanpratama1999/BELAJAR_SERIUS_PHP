<?php
// upload.php
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['avatar'])) {
        $errors[] = 'Tidak ada file yang diunggah.';
    } else {
        $file = $_FILES['avatar'];

        // Periksa error upload
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errors[] = 'Upload gagal (error code: ' . $file['error'] . ').';
        } else {
            // Validasi tipe & ukuran (contoh: hanya gambar, max 2MB)
            $allowedMime = ['image/jpeg', 'image/png', 'image/gif'];
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $file['tmp_name']);
            finfo_close($finfo);

            if (!in_array($mime, $allowedMime, true)) {
                $errors[] = 'Tipe file tidak diperbolehkan.';
            }

            if ($file['size'] > 2 * 1024 * 1024) {
                $errors[] = 'Ukuran file terlalu besar (max 2MB).';
            }

            if (empty($errors)) {
                $targetDir = __DIR__ . '/uploads';
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }

                // Buat nama file unik untuk mencegah overwrite
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                $newName = uniqid('avatar_', true) . '.' . $ext;
                $target = $targetDir . '/' . $newName;

                if (move_uploaded_file($file['tmp_name'], $target)) {
                    $success = 'File berhasil diunggah: ' . htmlspecialchars($newName);
                } else {
                    $errors[] = 'Gagal memindahkan file.';
                }
            }
        }
    }
}
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Upload</title>
</head>

<body>
    <?php if (!empty($errors)): ?>
        <?php foreach ($errors as $e): ?>
            <div style="color:red;"><?= htmlspecialchars($e) ?></div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div style="color:green"><?= $success ?></div>
    <?php endif; ?>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="avatar" accept="image/*">
        <button type="submit">Upload</button>
    </form>
</body>

</html>


<?php
/*
6) CSRF (Cross-Site Request Forgery) — perlindungan dasar
- Generate token saat menampilkan form, simpan di $_SESSION.
- Sertakan token sebagai input hidden.
- Saat proses POST, bandingkan token dari form dengan token di session.

Contoh potongan:
// saat menampilkan form
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf = $_SESSION['csrf_token'];
?>
<form method="post" action="...">
  <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
  ...
</form>
*/
?>

<?php
/*
// saat memproses POST
session_start();
$token = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';
if (!hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
    // token tidak cocok — tolak request
    http_response_code(400);
    die('Permintaan tidak valid (CSRF token salah).');
}
*/

// Gunakan hash_equals untuk melawan timing attacks.
?>