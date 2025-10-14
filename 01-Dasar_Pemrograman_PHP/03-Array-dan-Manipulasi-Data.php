<?php
/*
===========================================================
📘 BAB: ARRAY & MANIPULASI DATA DI PHP (TERPERINCI)
===========================================================
Isi:
- Tipe array: indexed, associative, multidimensional
- Sintaks singkat & catatan (short array syntax, list/destructuring)
- Operasi dasar: count, array_push, array_pop, array_shift, array_unshift
- Penggabungan & potong: array_merge, array_slice, array_splice
- Pencarian & cek: in_array, array_search, array_key_exists
- Konversi: implode (join), explode (split)
- Sorting: sort, rsort, asort, arsort, ksort, krsort, usort
- Utility lanjutan: array_keys, array_values, array_map, array_filter, array_reduce
- Referensi vs copy behavior
===========================================================

Catatan singkat:
- PHP array adalah struktur ordered map: bisa berfungsi sebagai list (indexed) atau map (associative).
- Gunakan var_dump() atau print_r() untuk debugging / melihat struktur array.
- Semua contoh di bawah menyertakan komentar "Output:" yang menunjukkan apa yang akan tercetak ketika dijalankan.
===========================================================
*/


echo "=== A. Indexed Array (array berindeks numerik) ===<br>";

// short array syntax (direkomendasikan)
$buah = ["Apel", "Jeruk", "Mangga"];

// akses elemen
echo $buah[0] . "<br>"; // Output: Apel
echo $buah[1] . "<br>"; // Output: Jeruk

// menampilkan struktur
echo "<pre>";
var_dump($buah);
/*
Output (ringkas, var_dump):
array(3) {
  [0]=>
  string(4) "Apel"
  [1]=>
  string(5) "Jeruk"
  [2]=>
  string(6) "Mangga"
}
*/
echo "</pre>";


echo "<br>=== B. Associative Array (key => value) ===<br>";

$user = [
    "nama" => "Andi",
    "email" => "andi@example.com",
    "umur" => 28
];

echo $user["nama"] . "<br>"; // Output: Andi

echo "<pre>";
print_r($user);
/*
Output (print_r):
Array
(
    [nama] => Andi
    [email] => andi@example.com
    [umur] => 28
)
*/
echo "</pre>";


echo "<br>=== C. Multidimensional Array ===<br>";

// Array 2 dimensi (list of associative arrays)
$produk = [
    ["id" => 1, "nama" => "Keyboard", "harga" => 150000],
    ["id" => 2, "nama" => "Mouse", "harga" => 70000],
    ["id" => 3, "nama" => "Monitor", "harga" => 1250000],
];

// Akses: produk ke-1 nama
echo $produk[1]["nama"] . "<br>"; // Output: Mouse

// Loop nested untuk menampilkan semua
foreach ($produk as $p) {
    echo "Produk #{$p['id']}: {$p['nama']} - Rp{$p['harga']}<br>";
}

/*
Output:
Produk #1: Keyboard - Rp150000
Produk #2: Mouse - Rp70000
Produk #3: Monitor - Rp1250000
*/


echo "<br>=== D. Fungsi Array Dasar ===<br>";

// count()
echo "Jumlah buah: " . count($buah) . "<br>"; // Output: Jumlah buah: 3

// array_push() -> menambahkan di akhir
array_push($buah, "Pisang");
echo "Setelah array_push: ";
print_r($buah);
// Output: Array ( [0]=>Apel [1]=>Jeruk [2]=>Mangga [3]=>Pisang )

// array_pop() -> hapus elemen terakhir dan kembalikan nilainya
$last = array_pop($buah);
echo "<br>POP: $last<br>"; // Output: POP: Pisang
echo "Setelah pop: ";
print_r($buah); // Pisang sudah hilang

// array_unshift() -> tambahkan di awal
array_unshift($buah, "Strawberry");
echo "<br>Setelah unshift: ";
print_r($buah); // Strawberry jadi indeks 0

// array_shift() -> hapus dan kembalikan elemen pertama
$first = array_shift($buah);
echo "<br>SHIFT: $first<br>"; // Output: SHIFT: Strawberry
echo "Setelah shift: ";
print_r($buah);

// array_merge() -> gabungkan dua array (reindex jika indexed)
$angka1 = [1, 2, 3];
$angka2 = [4, 5];
$gabung = array_merge($angka1, $angka2);
echo "<br>array_merge result: ";
print_r($gabung); // Output: Array (1,2,3,4,5)

// array_slice() -> ambil subset tanpa merubah array asli
$subset = array_slice($gabung, 1, 3); // mulai indeks 1 ambil 3 elemen
echo "<br>array_slice (1,3): ";
print_r($subset); // Output: [2,3,4]

// array_splice() -> memotong & bisa menyisipkan (merubah array asli)
$arr = [10, 20, 30, 40, 50];
$removed = array_splice($arr, 2, 2, [99, 100]); // dari indeks2 hapus 2, masukkan [99,100]
echo "<br>array_splice removed: ";
print_r($removed); // Output: [30,40]
echo "array setelah splice: ";
print_r($arr); // Output: [10,20,99,100,50]


echo "<br>=== E. Pencarian & Cek ===<br>";

// in_array() -> cek apakah nilai ada di array (untuk values)
echo "Apakah 'Jeruk' ada? " . (in_array("Jeruk", $buah) ? "Ya" : "Tidak") . "<br>"; // Ya

// array_search() -> cari index/key berdasarkan nilai
$idx = array_search("Mangga", $buah); // bisa mengembalikan index (0,1,...)
echo "Index Mangga: ";
var_dump($idx); // int(2) (atau NULL jika tidak ada)

// array_key_exists() -> cek key pada associative array
echo "Key 'email' ada? " . (array_key_exists("email", $user) ? "Ya" : "Tidak") . "<br>"; // Ya


echo "<br>=== F. Konversi String <-> Array ===<br>";

// explode() -> string -> array
$kalimat = "saya,suka,php";
$parts = explode(",", $kalimat);
print_r($parts);
/*
Output:
Array ( [0] => saya [1] => suka [2] => php )
*/

// implode() -> array -> string
$joined = implode(" ", $parts);
echo "implode: $joined <br>"; // Output: implode: saya suka php


echo "<br>=== G. Sorting (cara & perbedaan) ===<br>";

$nums = [3, 1, 4, 2];
sort($nums); // ascending, reindex (0..n)
echo "sort -> ";
print_r($nums); // [1,2,3,4]

rsort($nums); // descending, reindex
echo "<br>rsort -> ";
print_r($nums); // [4,3,2,1]

// untuk associative arrays, gunakan asort/arsort (urut by value, preserve keys)
$grades = ["Ani" => 80, "Budi" => 95, "Cici" => 70];
asort($grades); // naik berdasarkan value, mempertahankan key
echo "<br>asort -> ";
print_r($grades); // Cici(70), Ani(80), Budi(95)

arsort($grades); // turun by value
echo "<br>arsort -> ";
print_r($grades); // Budi, Ani, Cici

// ksort / krsort -> sort by keys
ksort($grades);
echo "<br>ksort -> ";
print_r($grades);

// usort -> custom comparator untuk indexed array (memodifikasi array, tidak mempertahankan key)
$people = [
    ["nama" => "Andi", "umur" => 28],
    ["nama" => "Budi", "umur" => 24],
    ["nama" => "Citra", "umur" => 30]
];

usort($people, function ($a, $b) {
    return $a['umur'] <=> $b['umur']; // ascending by umur
});
echo "<br>usort by umur -> ";
print_r($people);


/*
Output usort by umur:
Array
(
  [0] => Array ( [nama] => Budi [umur] => 24 )
  [1] => Array ( [nama] => Andi [umur] => 28 )
  [2] => Array ( [nama] => Citra [umur] => 30 )
)
*/


echo "<br>=== H. Utility Lainnya ===<br>";

// array_keys(), array_values()
$keys = array_keys($user); // ['nama','email','umur']
$values = array_values($user);
echo "keys: ";
print_r($keys);
echo "values: ";
print_r($values);

// array_map() -> transform setiap elemen
$upper = array_map('strtoupper', ["a", "b", "c"]);
echo "<br>array_map strtoupper: ";
print_r($upper); // [A,B,C]

// array_filter() -> filter elemen (mengembalikan elemen yang memenuhi kondisi)
$angka = [1, 2, 3, 4, 5, 6];
$genap = array_filter($angka, fn($n) => $n % 2 === 0);
echo "<br>array_filter genap: ";
print_r($genap); // [2,4,6] (key asli dipertahankan)

// array_reduce() -> reduksi menjadi 1 nilai (mis. sum)
$sum = array_reduce($angka, fn($carry, $item) => $carry + $item, 0);
echo "<br>array_reduce sum: $sum"; // 21


echo "<br><br>=== I. Referensi vs Copy Behavior ===<br>";

// Secara default assignment membuat salinan (copy)
$a = [1, 2, 3];
$b = $a;
$b[0] = 99;
echo "a after copy-modify: ";
print_r($a); // tetap [1,2,3]
echo "b: ";
print_r($b); // [99,2,3]

// Untuk reference (mengubah keduanya), gunakan & 
$c = [1, 2, 3];
$d = &$c; // reference
$d[1] = 88;
echo "<br>c after reference change: ";
print_r($c); // [1,88,3]
echo "d: ";
print_r($d);

// Mengirim array ke fungsi: pass by value (default) — gunakan & untuk pass by reference jika mau modifikasi
function tambah_item(&$arr, $item)
{ // note & untuk memodifikasi array asli
    $arr[] = $item;
}
$my = [10, 20];
tambah_item($my, 30);
echo "<br>my after function tambah_item: ";
print_r($my); // [10,20,30]


echo "<br><br>=== J. Contoh Kasus Kompleks: Hitung Total Harga dengan Filter & Mapping ===<br>";

$cart = [
    ["nama" => "Buku", "qty" => 2, "harga" => 40000],
    ["nama" => "Pulpen", "qty" => 5, "harga" => 3000],
    ["nama" => "Tas", "qty" => 1, "harga" => 150000],
];

// pakai array_map untuk total per item, lalu array_reduce untuk total keseluruhan
$lineTotals = array_map(function ($item) {
    return $item['qty'] * $item['harga'];
}, $cart);

$totalBelanja = array_reduce($lineTotals, fn($carry, $it) => $carry + $it, 0);

echo "Line totals: ";
print_r($lineTotals); // [80000,15000,150000]
echo "<br>Total belanja: Rp" . number_format($totalBelanja, 0, ",", "."); // Rp245.000

/*
Output:
Line totals: Array ( [0] => 80000 [1] => 15000 [2] => 150000 )
Total belanja: Rp245.000
*/

echo "<br><br>=== K. Tips & Best Practice ===<br>";
echo "- Gunakan short array syntax [] (lebih ringkas).\n<br>";
echo "- Gunakan array_keys / array_values jika butuh list key/value terpisah.\n<br>";
echo "- Pakai array_map / array_filter untuk operasi fungsional dan menjadikan kode lebih deklaratif.\n<br>";
echo "- Hati-hati dengan array yang di-sort: sort() merubah indeks; asort() mempertahankan key.\n<br>";
echo '- Untuk data tabel (row), gunakan indexed array of associative arrays (seperti $produk di atas).\n<br>';

/*
===========================================================
Simpan file ini sebagai: 03-array-manipulasi.php
Lalu jalankan di browser lokal: http://localhost/.../03-array-manipulasi.php
===========================================================
*/
?>