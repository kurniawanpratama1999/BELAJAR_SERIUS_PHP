<?php
/*
6) Custom global handlers: set_exception_handler & shutdown handler
- Tangani uncaught exceptions dan fatal errors:
*/

// global_handlers.php

// 1) Global uncaught exception handler
set_exception_handler(function (Throwable $e) {
    // Simpan log
    error_log("[Uncaught Exception] " . $e->getMessage() . " in " . $e->getFile() . ":" . $e->getLine());

    // Untuk environment produksi: tampilkan pesan generik
    if (ini_get('display_errors')) {
        // Jika di dev, beri detail
        echo "<pre>Uncaught Exception: " . $e . "</pre>";
    } else {
        // Production: tampilkan pesan aman
        http_response_code(500);
        echo "Terjadi kesalahan internal. Silakan coba lagi nanti.";
    }
});

// 2) Shutdown handler untuk fatal errors
register_shutdown_function(function () {
    $err = error_get_last();
    if ($err !== null) {
        $fatalTypes = [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR];
        if (in_array($err['type'], $fatalTypes, true)) {
            // Log detail
            $msg = sprintf("Fatal error: %s in %s on line %d", $err['message'], $err['file'], $err['line']);
            error_log($msg);

            // Jika di web context dan tidak menampilkan errors, kirim 500
            if (!ini_get('display_errors')) {
                http_response_code(500);
                echo "Terjadi kesalahan fatal. Silakan hubungi admin.";
            } else {
                // Dev: tampilkan info
                echo "<pre>Shutdown error: " . print_r($err, true) . "</pre>";
            }
        }
    }
});
