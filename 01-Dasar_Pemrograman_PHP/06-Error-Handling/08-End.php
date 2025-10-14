<?php
// bootstrap.php (dipanggil di entrypoint aplikasi)
declare(strict_types=1);

// 1. Environment detection (sederhana)
$env = getenv('APP_ENV') ?: 'production';

// 2. Setup error reporting sesuai environment
if ($env === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', '0');
    ini_set('log_errors', '1');
    ini_set('error_log', __DIR__ . '/logs/php-error.log');
}

// 3. Convert error => exception
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    if (!(error_reporting() & $errno)) {
        return false;
    }
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

// 4. Global exception handler
set_exception_handler(function (Throwable $e) use ($env) {
    // log
    error_log("[Uncaught] " . $e->getMessage() . " in " . $e->getFile() . ":" . $e->getLine());
    // render response
    if ($env === 'development') {
        echo "<pre>" . htmlspecialchars($e) . "</pre>";
    } else {
        http_response_code(500);
        echo "Terjadi kesalahan internal. Silakan hubungi admin.";
    }
});

// 5. Shutdown handler for fatal errors
register_shutdown_function(function () use ($env) {
    $err = error_get_last();
    if ($err && in_array($err['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR], true)) {
        error_log("Fatal: " . json_encode($err));
        if ($env === 'development') {
            echo "<pre>Fatal error: " . print_r($err, true) . "</pre>";
        } else {
            http_response_code(500);
            echo "Terjadi kesalahan fatal.";
        }
    }
});

// 6. Example code to trigger error
try {
    // memicu Notice (undefined variable) -> akan dikonversi menjadi ErrorException
    echo $notDefined;
} catch (Throwable $e) {
    // Tertangkap di sini; di aplikasi nyata kamu bisa menampilkan pesan user-friendly
    echo "Ada masalah: " . $e->getMessage();
}

/*
10) Checklist & best practices singkat
- Jangan display_errors=1 di production.
- Gunakan error_reporting(E_ALL) tetapi display_errors=0 + log_errors=1.
- Gunakan set_error_handler untuk menyatukan error menjadi exception jika ingin flow try/catch.
- Tangani uncaught exceptions dengan set_exception_handler.
- Tangani fatal errors dengan register_shutdown_function + error_get_last().
- Log detail teknis ke file (atau service logging) — jangan ke output web.
- Buat custom exceptions untuk klasifikasi error aplikasi (ValidationException, DatabaseException).
- Gunakan HTTP response codes yang sesuai (500 untuk internal error).
- Gunakan finally untuk cleanup resource.
- Jika memakai framework (Laravel, Symfony, dsb.), manfaatkan mekanisme error handling bawaan mereka yang sudah mature.
*/