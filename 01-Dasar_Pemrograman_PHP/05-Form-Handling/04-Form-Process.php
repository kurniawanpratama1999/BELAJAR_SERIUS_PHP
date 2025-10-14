<?php
/*
7) Pattern: POST-Redirect-GET (PRG)
- Setelah berhasil memproses POST, redirect ke halaman lain (atau ke halaman yang sama) dengan header('Location: ...') dan exit;.
- Manfaat: mencegah duplikat submission bila user refresh, serta mengizinkan pesan sukses ditampilkan lewat session flash.

8) Tips & checklist praktis
- Selalu gunakan isset() sebelum membaca $_POST/$_GET/$_FILES untuk menghindari notice.
- Gunakan trim() untuk membersihkan whitespace.
- Gunakan htmlspecialchars() saat menampilkan input kembali ke HTML (prevent XSS).
- Gunakan filter_var()/filter_input() untuk validasi tipe data.
- Validasi sisi server selalu wajib — validasi sisi klien (JS/HTML5) hanyalah convenience.
- Saat menyimpan ke DB, selalu gunakan prepared statements (PDO with bound params).
- Untuk file upload: validasi MIME-type, ekstensi, ukuran, dan simpan di folder yang tidak dapat dieksekusi (atau atur permission).
- Implementasikan CSRF protection untuk form yang mengubah data (POST/PUT/DELETE).
- Batasi ukuran POST (post_max_size) dan upload size (upload_max_filesize) di php.ini sesuai kebutuhan.

9) Contoh lengkap — gabungan (form + CSRF + validasi + PRG)
- Saya gabungkan poin-poin utama dalam contoh singkat (struktur file minimal):
*/

session_start();

// generate CSRF token jika belum ada
if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

$errors = [];
$old = ['username' => '', 'email' => ''];

// PROSES POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF check
    $token = $_POST['csrf'] ?? '';
    if (!hash_equals($_SESSION['csrf'], $token)) {
        $errors[] = 'Form tidak valid (CSRF).';
    }

    // ambil input
    $old['username'] = trim($_POST['username'] ?? '');
    $old['email'] = trim($_POST['email'] ?? '');

    // validasi
    if ($old['username'] === '')
        $errors['username'] = 'Username wajib.';
    if ($old['email'] === '')
        $errors['email'] = 'Email wajib.';
    elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL))
        $errors['email'] = 'Email tidak valid.';

    if (empty($errors)) {
        // simpan ke DB atau proses lainnya...
        $_SESSION['flash_success'] = 'Data berhasil disimpan.';
        // refresh CSRF (opsional) agar token tidak reuse
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
        header('Location: form_process.php');
        exit;
    }
}

// ambil pesan sukses
$success = $_SESSION['flash_success'] ?? null;
if ($success)
    unset($_SESSION['flash_success']);
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Form Example</title>
</head>

<body>
    <?php if ($success): ?>
        <div style="color:green"><?= htmlspecialchars($success) ?></div><?php endif; ?>

    <?php if (!empty($errors) && is_array($errors)):
        foreach ($errors as $e): ?>
            <div style="color:red"><?= htmlspecialchars($e) ?></div>
        <?php endforeach; endif; ?>

    <form method="post" action="form_process.php">
        <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
        <div>
            <label>Username</label><br>
            <input type="text" name="username" value="<?= htmlspecialchars($old['username']) ?>">
        </div>
        <div>
            <label>Email</label><br>
            <input type="email" name="email" value="<?= htmlspecialchars($old['email']) ?>">
        </div>
        <button type="submit">Submit</button>
    </form>
</body>

</html>