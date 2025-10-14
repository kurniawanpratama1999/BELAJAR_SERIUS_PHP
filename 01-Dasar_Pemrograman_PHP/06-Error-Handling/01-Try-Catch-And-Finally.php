<?php

/*
1) Konsep singkat
- Error (notice/warning/fatal): level berbeda — beberapa bisa dilanjutkan (notice/warning), beberapa menghentikan eksekusi (E_ERROR, fatal).
- Exception: objek yang dilempar (throw) dan ditangkap oleh try...catch. Sejak PHP 7 juga ada Error (mis. TypeError) yang mengimplement Throwable.
- Tujuan: jangan tunjukkan stack trace raw atau detail sensitif ke user di production — log ke file dan tampilkan pesan generik ke user.
*/

/*
2) try...catch & finally
- Contoh penggunaan exception handling dasar:
*/

function divide($a, $b)
{
    if ($b === 0) {
        throw new InvalidArgumentException("Pembagi tidak boleh nol.");
    }
    return $a / $b;
}

try {
    echo divide(10, 2) . PHP_EOL; // 5
    echo divide(5, 0) . PHP_EOL;  // akan melempar exception
} catch (InvalidArgumentException $e) {
    // Menangani exception khusus
    echo "Terjadi kesalahan input: " . $e->getMessage() . PHP_EOL;
} catch (Throwable $t) {
    // Menangani semua Error/Exception (PHP 7+)
    echo "Kesalahan tidak terduga: " . $t->getMessage() . PHP_EOL;
} finally {
    // Selalu dijalankan
    echo "Selesai mencoba operasi pembagian." . PHP_EOL;
}

/*
Catatan:
- Tangkap exception paling spesifik lebih dulu; Throwable atau Exception di-catch di blok terakhir.
- finally berguna untuk membersihkan resource.
*/