<?php
/*
3) Mengatur tingkat error (error_reporting, ini_set)
- Atur apa yang dilaporkan dan apakah ditampilkan ke layar:
*/

// config_errors.php

// Development: tampilkan semua error (tidak untuk production)
error_reporting(E_ALL);
ini_set('display_errors', '1');     // Tampilkan error ke output (dev only)
ini_set('display_startup_errors', '1');

// Production: laporkan semua tapi jangan tampilkan ke user
// error_reporting(E_ALL);
// ini_set('display_errors', '0');
// ini_set('log_errors', '1');
// ini_set('error_log', __DIR__ . '/logs/php-error.log');

/*
Penjelasan singkat:
- error_reporting(E_ALL) → aktifkan semua level (warnings, notices).
- display_errors = 1 menampilkan di browser/CLI (JANGAN di production).
- log_errors = 1 + error_log → simpan ke file log.
*/