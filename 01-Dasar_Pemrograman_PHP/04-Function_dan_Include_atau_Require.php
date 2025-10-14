<?php
/*
===========================================================
04 - FUNCTION & INCLUDE/REQUIRE (TERPERINCI)
===========================================================
Isi:
- Membuat fungsi biasa
- Parameter (tipe, default, nullable, union)
- Return type & void
- Passing by value vs by reference (&)
- Variadic functions (...$args)
- Named arguments (PHP 8+)
- Arrow functions dan anonymous functions
- Closures & `use`
- Callables (string, [obj, method], closure)
- Generators (yield)
- include(), require(), include_once(), require_once()
  - Perbedaan perilaku (warning vs fatal error) & penggunaan __DIR__
- Best practices & tips
===========================================================
*/

// ===========================================================
// 1) Membuat fungsi sederhana
// ===========================================================
function sapa($nama)
{
    return "Halo, $nama!";
}

echo sapa("Kurniawan") . "<br>";
// Output: Halo, Kurniawan!

// ===========================================================
// 2) Parameter: default value, type hints, nullable, union (PHP 8+)
// ===========================================================

// Scalar type hints + return type + default parameter
function tambah(int $a, int $b = 0): int
{
    return $a + $b;
}

echo "tambah(3,4): " . tambah(3, 4) . "<br>"; // Output: 7
echo "tambah(5): " . tambah(5) . "<br>";       // Output: 5 (karena $b default 0)

// Nullable parameter (boleh null) dan nullable return
function salam(?string $nama): ?string
{
    if ($nama === null)
        return null;
    return "Halo, $nama";
}

var_dump(salam("Andi")); // string(9) "Halo, Andi"
var_dump(salam(null));   // NULL

// Union types (PHP 8.0+): int|float
function kali(int|float $x, int|float $y): float
{
    return $x * $y;
}

echo "kali(2, 2.5): " . kali(2, 2.5) . "<br>"; // Output: 5

// ===========================================================
// 3) Passing by value vs passing by reference
// ===========================================================

function tambahSatu($n)
{
    $n = $n + 1;
}
$a = 5;
tambahSatu($a);
echo "a after pass-by-value: $a <br>"; // Output: 5 (tetap 5)

function tambahSatuRef(&$n)
{
    $n = $n + 1;
}
$b = 5;
tambahSatuRef($b);
echo "b after pass-by-reference: $b <br>"; // Output: 6

// ===========================================================
// 4) Variadic functions (terima banyak argumen)
// ===========================================================
function jumlahkan(...$numbers): float
{
    $sum = 0;
    foreach ($numbers as $n)
        $sum += $n;
    return $sum;
}

echo "jumlahkan(1,2,3,4): " . jumlahkan(1, 2, 3, 4) . "<br>"; // Output: 10

// ===========================================================
// 5) Named arguments (PHP 8+)
// ===========================================================
function buatUser(string $nama, int $umur, string $role = "user")
{
    return "User: $nama, Umur: $umur, Role: $role";
}

// Bisa menggunakan named args sehingga urutan tidak penting:
echo buatUser(umur: 30, nama: "Sinta") . "<br>";
// Output: User: Sinta, Umur: 30, Role: user

// ===========================================================
// 6) Return type void (PHP 7.1+)
// ===========================================================
function cetakPesan(string $pesan): void
{
    echo "[Pesan] $pesan<br>";
}
cetakPesan("Ini contoh void");
// Output: [Pesan] Ini contoh void

// ===========================================================
// 7) Anonymous functions (closures) & arrow functions (PHP 7.4+)
// ===========================================================

// Anonymous / closure
$g = function ($x) {
    return $x * 2;
};
echo "closure 5*2: " . $g(5) . "<br>"; // Output: 10

// Arrow function (lebih ringkas; otomatis capture by value)
$nums = [1, 2, 3];
$doubled = array_map(fn($n) => $n * 2, $nums);
echo "doubled: ";
print_r($doubled); // Output: Array ( [0] => 2 [1] => 4 [2] => 6 )

// Closure dengan `use` (capture variable dari luar, bisa by value)
$prefix = "=> ";
$printer = function ($msg) use ($prefix) {
    echo $prefix . $msg . "<br>";
};
$printer("Halo Closure");
// Output: => Halo Closure

// Jika ingin menangkap by reference:
$count = 0;
$inc = function () use (&$count) {
    $count++;
};
$inc();
$inc();
echo "count after inc: $count <br>"; // Output: 2

// ===========================================================
// 8) Callables (memanggil fungsi/method lewat variable atau callback)
// ===========================================================
function panggil(callable $fn, $arg)
{
    return $fn($arg);
}

echo panggil('strtoupper', 'kurniawan') . "<br>"; // Output: KURNIAWAN

class Util
{
    public static function hi($name)
    {
        return "Hi, $name";
    }
}
echo panggil([Util::class, 'hi'], 'Ani') . "<br>"; // Output: Hi, Ani

// ===========================================================
// 9) Generators: yield (hemat memori untuk iterasi besar)
// ===========================================================
function counter($max)
{
    for ($i = 1; $i <= $max; $i++) {
        yield $i;
    }
}

foreach (counter(3) as $c) {
    echo "generator: $c<br>";
}
/*
Output:
generator: 1
generator: 2
generator: 3
*/

// ===========================================================
// 10) Mengembalikan array / multiple values (return array)
// ===========================================================
function operasi($a, $b): array
{
    return ['sum' => $a + $b, 'diff' => $a - $b];
}
$res = operasi(10, 4);
echo "sum: {$res['sum']}, diff: {$res['diff']}<br>"; // Output: sum: 14, diff: 6

// ===========================================================
// 11) Error handling dalam fungsi (throw exceptions)
// ===========================================================
function bagi($a, $b): float
{
    if ($b === 0) {
        throw new InvalidArgumentException("Pembagi tidak boleh 0");
    }
    return $a / $b;
}

try {
    echo "bagi 10/2: " . bagi(10, 2) . "<br>"; // Output: 5
    // echo bagi(10, 0); // jika diaktifkan akan me-throw exception
} catch (Throwable $e) {
    echo "Error: " . $e->getMessage() . "<br>";
}

// ===========================================================
// 12) include(), require(), include_once(), require_once()
// ===========================================================
/*
Perbedaan utama:
- include 'file.php': jika file tidak ditemukan -> PHP mengeluarkan WARNING (E_WARNING) tetapi script *lanjut*.
- require 'file.php': jika file tidak ditemukan -> PHP mengeluarkan FATAL ERROR dan script *berhenti*.
- include_once / require_once: sama seperti versi tanpa _once, tetapi mencegah file yang sama di-include lebih dari sekali.

Best practice:
- Gunakan require / require_once untuk file yang wajib ada (config, autoload).
- Gunakan include / include_once untuk file opsional (template partial yang boleh tidak ada).
- Selalu gunakan path absolut atau __DIR__ untuk menghindari masalah include_path.

Contoh:
*/

// Misal kamu punya file: includes/config.php
// Conten file (contoh, bukan dieksekusi disini):
// <?php
// return [
//   'app_name' => 'Contoh App',
//   'version' => '1.0'
// ];

echo "<br>=== DEMO INCLUDE/REQUIRE (Contoh penggunaan __DIR__) ===<br>";

// gunakan __DIR__ untuk memastikan path relatif terhadap file saat ini
$configPath = __DIR__ . '/includes/config.php';

if (file_exists($configPath)) {
    // require_once akan menghentikan eksekusi jika file tidak ditemukan; 
    // karena kita cek file_exists, ini aman. 
    $config = require_once $configPath;
    echo "Config loaded: " . ($config['app_name'] ?? 'n/a') . "<br>";
} else {
    echo "File config.php tidak ada — demonstrasi behavior:<br>";
    echo "- Jika kita menggunakan include('includes/config.php') tanpa file_exists, PHP akan menampilkan WARNING tetapi script terus berjalan.<br>";
    echo "- Jika kita menggunakan require('includes/config.php') tanpa file_exists, PHP akan FATAL ERROR (script berhenti).<br>";
}

/*
Contoh expected behaviors (tidak langsung dijalankan di sini):
1) include 'notfound.php'; // -> Warning: include(notfound.php): failed to open stream...
   Script akan lanjut.

2) require 'notfound.php'; // -> Fatal error: Uncaught Error: failed to open stream: No such file or directory
   Script akan berhenti.
*/

// ===========================================================
// 13) Praktik terbaik include/require
// ===========================================================
/*
- Taruh file konfigurasi / autoloader di lokasi tetap dan muat dengan require_once:
    require_once __DIR__ . '/vendor/autoload.php';

- Hindari include dengan path relatif tanpa __DIR__:
    // kurang aman: include '../config.php';
    // lebih aman: include __DIR__ . '/../config.php';

- Gunakan require_once untuk file yang tidak boleh dimuat ulang (misal koneksi db, konfigurasi).

- Jangan meng-include file yang berisi output langsung di dalam logic yang penting tanpa buffering,
  karena include akan mengeksekusi seluruh isi file saat dipanggil.
*/

// ===========================================================
// 14) Contoh praktis: pisahkan fungsi util ke file terpisah lalu include
// ===========================================================
/*
Struktur (contoh):
/project
  /includes
     helpers.php
  04-function-include-require.php  (file ini)

helpers.php contoh isinya:
<?php
function rupiah($n) {
    return 'Rp' . number_format($n, 0, ',', '.');
}
return true;

Lalu di file utama:
require_once __DIR__ . '/includes/helpers.php';
echo rupiah(15000); // Output: Rp15.000
*/

// Demo: kita cek existence dan tunjukkan pesan untuk workflow yang aman
$helpersPath = __DIR__ . '/includes/helpers.php';
if (file_exists($helpersPath)) {
    require_once $helpersPath;
    if (function_exists('rupiah')) {
        echo "rupiah(15000): " . rupiah(15000) . "<br>";
    }
} else {
    echo "File helpers.php tidak ditemukan. Jika ada, require_once akan memuat fungsi-fungsi utilitas seperti rupiah().<br>";
}

// ===========================================================
// 15) Ringkasan singkat & tips
// ===========================================================
/*
- Fungsi:
  - Buat fungsi untuk memisahkan logic jadi lebih modular dan reusable.
  - Gunakan type hints & return types untuk menjaga kestabilan kode.
  - Tangani error dengan exceptions bila operasi dapat gagal.

- Include/Require:
  - require(_once) untuk hal yang wajib (config, autoload).
  - include(_once) untuk template/partial opsional.
  - Gunakan __DIR__ untuk path aman.
  - Prefer require_once for singletons/autoloaders to avoid duplicate definitions.

- Debugging:
  - Gunakan var_dump(), print_r(), atau tools debugging (Xdebug).
  - Saat include, jika file tidak ditemukan, perhatikan warning vs fatal error.

- Modern PHP features:
  - Named arguments, union types, arrow functions, and generators membantu menulis kode lebih jelas dan efisien.

Simpan file ini sebagai 04-function-include-require.php dan jalankan di environment lokalmu.
===========================================================
*/
?>