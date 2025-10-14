2. KONSEP DASAR OOP
Mulai masuk ke pola pikir “berbasis objek”.

a. Apa itu Object-Oriented Programming (OOP)
   - Paradigma pemrograman yang berfokus pada objek.
   - Objek = gabungan data (property) dan perilaku (method).
   - Tujuan: membuat kode yang modular, reusable, dan mudah di-maintain.

b. Class & Object
   - Class adalah blueprint (cetakan) untuk membuat objek.
   - Object adalah instance dari class.
   - Contoh:
       class Mobil { }
       $mobil1 = new Mobil();

c. Property dan Method
   - Property = variabel dalam class (menyimpan data/keadaan objek).
   - Method = fungsi dalam class (menentukan perilaku objek).
   - Contoh:
       class Mobil {
           public $warna;
           public function nyalakanMesin() {
               echo "Mesin dinyalakan!";
           }
       }

d. $this Keyword
   - Menunjuk ke objek saat ini (instance yang sedang aktif).
   - Digunakan untuk mengakses property atau method di dalam class itu sendiri.
   - Contoh:
       $this->warna = "Merah";

e. Constructor (__construct) dan Destructor (__destruct)
   - __construct() otomatis dijalankan ketika objek dibuat.
   - __destruct() otomatis dijalankan ketika objek dihapus atau script selesai.
   - Contoh:
       class Mobil {
           public function __construct() {
               echo "Objek Mobil dibuat!";
           }
           public function __destruct() {
               echo "Objek Mobil dihapus!";
           }
       }

f. Visibility: public, protected, private
   - Mengatur akses ke property dan method dalam class.
   - public    → bisa diakses dari mana saja.
   - protected → hanya bisa diakses oleh class itu sendiri dan turunannya.
   - private   → hanya bisa diakses oleh class itu sendiri.
   - Contoh:
       class Mobil {
           public $merk;       // bebas diakses
           protected $warna;   // hanya class & turunan
           private $kecepatan; // hanya class ini
       }

