<?php
/*
4) Custom error handler (set_error_handler) — convert error → exception
- PHP error (warning/notice) bukan exception secara default. Untuk menyatukan flow, sering kita konversi menjadi ErrorException sehingga bisa ditangani oleh try...catch.
*/
// Convert PHP error menjadi ErrorException
set_error_handler(function (int $errno, string $errstr, string $errfile, int $errline) {
    // Jika error_reporting mengabaikan level ini, kembalikan false untuk biarkan default handler memutuskan.
    if (!(error_reporting() & $errno)) {
        return false;
    }
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

// contoh: memicu warning (mis. pembagian dengan string)
try {
    // memicu notice/warning: use of undefined variable
    echo $undefinedVar;
} catch (Throwable $t) {
    echo "Tertangkap: " . get_class($t) . " - " . $t->getMessage() . PHP_EOL;
}

/*
Catatan:
- set_error_handler hanya menangani non-fatal errors; fatal error tetap memicu shutdown.
*/