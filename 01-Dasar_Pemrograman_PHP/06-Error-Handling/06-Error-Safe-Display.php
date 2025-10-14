<?php
/*
7) Menampilkan pesan error dengan aman

Prinsip:
- Di development: tampilkan detail lengkap (stack trace) agar cepat debugging.
- Di production: jangan tampilkan detail sensitif — tampilkan pesan generik dan simpan detail ke log.
Contoh pola:
*/
function renderErrorToUser(Throwable $e)
{
    // Simpan log untuk admin
    error_log(sprintf(
        "[%s] %s in %s:%d\nStack trace:\n%s\n",
        date('c'),
        $e->getMessage(),
        $e->getFile(),
        $e->getLine(),
        $e->getTraceAsString()
    ));

    // Tampilkan aman ke user
    if (ini_get('display_errors')) {
        // DEV
        echo "<h1>Kesalahan:</h1><pre>" . htmlspecialchars($e) . "</pre>";
    } else {
        // PROD
        http_response_code(500);
        echo "<h1>Terjadi kesalahan</h1><p>Silakan coba lagi nanti atau hubungi support.</p>";
    }
}
