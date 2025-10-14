<?php
/*
8) Praktik logging
- Gunakan error_log() untuk sederhana.
- Untuk aplikasi medium/large, gunakan library logging (PSR-3 / Monolog) — tapi prinsip sama: jangan menulis ke public output di production.
Contoh sederhana:
*/
// contoh logging ke file
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/logs/app.log'); // pastikan folder logs writable

error_log("Aplikasi mulai pada " . date('c'));
