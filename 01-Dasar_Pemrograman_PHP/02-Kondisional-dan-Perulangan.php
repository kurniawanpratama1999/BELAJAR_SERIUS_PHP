<?php
/*
==========================================================
📘 BAB 2: KONDISIONAL & PERULANGAN DALAM PHP
==========================================================
Tujuan:
- Memahami logika percabangan (if, else, elseif, switch)
- Memahami pengulangan (for, while, do...while, foreach)
==========================================================
*/


/*
----------------------------------------------------------
1️⃣ IF, ELSE, ELSEIF
----------------------------------------------------------
Digunakan untuk menjalankan kode berdasarkan kondisi tertentu.
*/

echo "=== IF, ELSE, ELSEIF ===<br>";

$nilai = 75;

if ($nilai >= 90) {
    echo "Nilai kamu A<br>";
} elseif ($nilai >= 80) {
    echo "Nilai kamu B<br>";
} elseif ($nilai >= 70) {
    echo "Nilai kamu C<br>";
} else {
    echo "Nilai kamu D<br>";
}

// Output: Nilai kamu C



/*
----------------------------------------------------------
2️⃣ SWITCH
----------------------------------------------------------
Digunakan untuk membandingkan satu variabel dengan banyak kemungkinan nilai.
*/

echo "<br>=== SWITCH ===<br>";

$hari = "Minggu";

switch ($hari) {
    case "Senin":
        echo "Hari ini adalah awal minggu.<br>";
        break;
    case "Jumat":
        echo "Hari ini adalah akhir minggu kerja.<br>";
        break;
    case "Minggu":
        echo "Hari libur!<br>";
        break;
    default:
        echo "Hari biasa.<br>";
        break;
}

// Output: Hari libur!



/*
----------------------------------------------------------
3️⃣ FOR LOOP
----------------------------------------------------------
Digunakan untuk perulangan dengan jumlah yang sudah diketahui.
*/

echo "<br>=== FOR LOOP ===<br>";

for ($i = 1; $i <= 5; $i++) {
    echo "Perulangan ke-$i <br>";
}

/*
Output:
Perulangan ke-1
Perulangan ke-2
Perulangan ke-3
Perulangan ke-4
Perulangan ke-5
*/



/*
----------------------------------------------------------
4️⃣ WHILE LOOP
----------------------------------------------------------
Digunakan untuk perulangan selama kondisi masih bernilai true.
*/

echo "<br>=== WHILE LOOP ===<br>";

$i = 1;
while ($i <= 3) {
    echo "Angka: $i <br>";
    $i++;
}

/*
Output:
Angka: 1
Angka: 2
Angka: 3
*/



/*
----------------------------------------------------------
5️⃣ DO...WHILE LOOP
----------------------------------------------------------
Selalu dijalankan minimal satu kali meskipun kondisi false.
*/

echo "<br>=== DO...WHILE LOOP ===<br>";

$i = 5;

do {
    echo "Nilai: $i <br>";
    $i++;
} while ($i <= 3);

/*
Output:
Nilai: 5
*/



/*
----------------------------------------------------------
6️⃣ FOREACH LOOP
----------------------------------------------------------
Digunakan untuk mengulang setiap elemen dalam array.
*/

echo "<br>=== FOREACH LOOP ===<br>";

$buah = ["Apel", "Jeruk", "Mangga"];

foreach ($buah as $item) {
    echo "Buah: $item <br>";
}

/*
Output:
Buah: Apel
Buah: Jeruk
Buah: Mangga
*/

echo "<br>=== FOREACH DENGAN INDEX ===<br>";

foreach ($buah as $index => $item) {
    echo "Buah ke-$index adalah $item <br>";
}

/*
Output:
Buah ke-0 adalah Apel
Buah ke-1 adalah Jeruk
Buah ke-2 adalah Mangga
*/


/*
📚 RANGKUMAN:
--------------------------------------------------------------------------------------
| Jenis         | Fungsi                          | Kapan Dipakai                    |
|---------------|---------------------------------|----------------------------------|
| if / else     | Mengecek kondisi kompleks       | Logika fleksibel                 |
| switch        | Mengecek satu nilai pasti       | Banyak case                      |
| for           | Loop dengan batas pasti         | Saat tahu jumlah iterasi         |
| while         | Loop dengan kondisi dinamis     | Saat belum tahu jumlah iterasi   |
| do...while    | Jalankan dulu baru cek kondisi  | Minimal dijalankan sekali        |
| foreach       | Loop khusus untuk array         | Iterasi data koleksi             |
==========================================================
*/
?>