<?php
session_start();

// Inisialisasi variabel
$errors = [];
$old = ['name' => '', 'email' => '', 'message' => ''];

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil input dengan pemeriksaan isset (menghindari notice)
    $old['name'] = isset($_POST['name']) ? trim($_POST['name']) : '';
    $old['email'] = isset($_POST['email']) ? trim($_POST['email']) : '';
    $old['message'] = isset($_POST['message']) ? trim($_POST['message']) : '';

    // VALIDASI SEDERHANA
    // 1. required
    if ($old['name'] === '') {
        $errors['name'] = 'Nama wajib diisi.';
    }

    if ($old['email'] === '') {
        $errors['email'] = 'Email wajib diisi.';
    } elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Format email tidak valid.';
    }

    if ($old['message'] === '') {
        $errors['message'] = 'Pesan wajib diisi.';
    } elseif (strlen($old['message']) < 10) {
        $errors['message'] = 'Pesan minimal 10 karakter.';
    }

    // Jika tidak ada error, proses (misal simpan atau kirim email)
    if (empty($errors)) {
        // Contoh: simpan / kirim email. Di sini kita hanya menunjukan sukses.
        // Gunakan prepared statements bila menyimpan ke database.
        $_SESSION['success'] = 'Terima kasih! Pesan Anda telah diterima.';
        // POST-Redirect-GET untuk menghindari resubmission form
        header('Location: contact.php');
        exit;
    }
}

// Ambil pesan sukses jika ada
$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;
if ($success) {
    unset($_SESSION['success']);
}
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Contact</title>
</head>

<body>
    <?php if ($success): ?>
        <div style="color: green;"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form action="contact.php" method="post" novalidate>
        <div>
            <label>Nama</label><br>
            <input type="text" name="name" value="<?= htmlspecialchars($old['name']) ?>">
            <?php if (isset($errors['name'])): ?>
                <div style="color:red;"><?= htmlspecialchars($errors['name']) ?></div><?php endif; ?>
        </div>

        <div>
            <label>Email</label><br>
            <input type="email" name="email" value="<?= htmlspecialchars($old['email']) ?>">
            <?php if (isset($errors['email'])): ?>
                <div style="color:red;"><?= htmlspecialchars($errors['email']) ?></div><?php endif; ?>
        </div>

        <div>
            <label>Pesan</label><br>
            <textarea name="message"><?= htmlspecialchars($old['message']) ?></textarea>
            <?php if (isset($errors['message'])): ?>
                <div style="color:red;"><?= htmlspecialchars($errors['message']) ?></div><?php endif; ?>
        </div>

        <button type="submit">Kirim</button>
    </form>
</body>

</html>

<?php
/*
Keterangan:
- Gunakan $_SERVER['REQUEST_METHOD'] untuk memastikan hanya memproses saat POST.
- Kumpulkan error di array $errors lalu tampilkan ke user.
- POST-Redirect-GET mencegah form dikirim ulang jika pengguna me-refresh.
*/
?>

<?php
/*
4) Sanitasi & filter lebih aman
- trim() untuk hapus spasi pinggir.
- htmlspecialchars($str, ENT_QUOTES, 'UTF-8') untuk menampilkan di HTML.
- filter_var($email, FILTER_VALIDATE_EMAIL) untuk validasi email.
- filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT, ['options'=>['min_range'=>1]]) untuk baca dan validasi langsung.

Contoh:

$age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1, 'max_range' => 120]
]);
if ($age === false) {
    $errors['age'] = 'Umur tidak valid';
}
*/
?>