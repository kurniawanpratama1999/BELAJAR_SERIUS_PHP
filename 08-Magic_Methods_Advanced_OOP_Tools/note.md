8️⃣ MAGIC METHODS & ADVANCED OOP TOOLS
Fitur "ajaib" PHP untuk mengontrol perilaku objek secara dinamis.

a. Magic Methods — apa itu?
   - Magic methods adalah method spesial yang dimulai dengan dua garis bawah `__`.
   - Dipanggil secara otomatis oleh PHP saat kondisi tertentu terjadi.
   - Beberapa contoh umum: __construct(), __get(), __set(), __toString(), __call(), dll.

🔹 DAFTAR MAGIC METHODS PENTING

1️⃣ __construct() dan __destruct()
   - Sudah kamu pelajari sebelumnya.
   - __construct() → otomatis dijalankan saat objek dibuat.
   - __destruct() → otomatis dijalankan saat objek dihapus atau keluar dari scope.

2️⃣ __get($property)
   - Dipanggil saat kamu mencoba mengakses properti **yang tidak bisa diakses langsung** (private / protected / tidak ada).
   - Contoh:
       class User {
           private $data = ['nama' => 'Andi', 'email' => 'andi@mail.com'];

           public function __get($name) {
               if (array_key_exists($name, $this->data)) {
                   return $this->data[$name];
               }
               return "Property '$name' tidak ditemukan!";
           }
       }

       $u = new User();
       echo $u->nama;   // Output: Andi
       echo $u->umur;   // Output: Property 'umur' tidak ditemukan!

3️⃣ __set($property, $value)
   - Dipanggil saat mencoba **mengisi nilai** ke properti yang tidak bisa diakses langsung.
   - Contoh:
       class Produk {
           private $harga = 0;

           public function __set($name, $value) {
               if ($name == 'harga' && $value > 0) {
                   $this->harga = $value;
               } else {
                   echo "Properti tidak valid atau nilai harus positif.";
               }
           }

           public function getHarga() {
               return $this->harga;
           }
       }

       $p = new Produk();
       $p->harga = 50000;   // __set() dipanggil otomatis
       echo $p->getHarga(); // Output: 50000

4️⃣ __call($method, $arguments)
   - Dipanggil saat kamu memanggil method yang tidak ada.
   - Contoh:
       class Contoh {
           public function __call($name, $args) {
               echo "Method '$name' tidak ditemukan. Argumen: " . implode(', ', $args);
           }
       }

       $obj = new Contoh();
       $obj->halo('dunia'); // Output: Method 'halo' tidak ditemukan. Argumen: dunia

5️⃣ __toString()
   - Dipanggil saat objek dikonversi menjadi string (misalnya dalam `echo`).
   - Contoh:
       class Buku {
           private $judul;
           public function __construct($judul) {
               $this->judul = $judul;
           }
           public function __toString() {
               return "Judul Buku: " . $this->judul;
           }
       }

       $b = new Buku("Belajar OOP");
       echo $b; // Output: Judul Buku: Belajar OOP

6️⃣ __clone()
   - Dipanggil saat objek di-clone menggunakan `clone`.
   - Berguna untuk mengatur perilaku cloning.
   - Contoh:
       class Siswa {
           public $nama;
           public function __clone() {
               $this->nama = "Salinan dari " . $this->nama;
           }
       }

       $a = new Siswa();
       $a->nama = "Budi";
       $b = clone $a;

       echo $b->nama; // Output: Salinan dari Budi

7️⃣ __invoke()
   - Membuat objek bisa dipanggil seperti fungsi.
   - Contoh:
       class Hitung {
           public function __invoke($a, $b) {
               return $a + $b;
           }
       }

       $hitung = new Hitung();
       echo $hitung(3, 4); // Output: 7

8️⃣ __sleep() dan __wakeup()
   - Digunakan saat objek diserialisasi (serialize) dan di-unserialize.
   - __sleep() → menentukan property mana yang disimpan.
   - __wakeup() → memulihkan koneksi atau resource setelah unserialize.
   - Contoh:
       class Koneksi {
           private $link;
           public function __sleep() {
               return []; // tidak menyimpan resource
           }
           public function __wakeup() {
               $this->link = "Koneksi database dipulihkan.";
           }
       }

       $obj = new Koneksi();
       serialize($obj); // __sleep() dipanggil
       unserialize(serialize($obj)); // __wakeup() dipanggil

9️⃣ instanceof operator
   - Mengecek apakah objek adalah instance dari class tertentu.
   - Contoh:
       class A {}
       class B extends A {}

       $obj = new B();

       var_dump($obj instanceof A); // true
       var_dump($obj instanceof B); // true
       var_dump($obj instanceof stdClass); // false

🔹 Sangat berguna untuk validasi tipe objek di runtime.

🔟 final class dan final method
   - `final class` → tidak bisa diturunkan.
   - `final function` → tidak bisa dioverride oleh class turunan.
   - Contoh:
       final class Config {
           public static function show() {
               echo "Aplikasi berjalan!";
           }
       }

       // class App extends Config {} // ❌ Error: Cannot extend final class Config

       class Base {
           final public function halo() {
               echo "Halo dari Base!";
           }
       }

       class Child extends Base {
           // public function halo() {} ❌ Error: Cannot override final method
       }

🔹 Kesimpulan:
- Magic methods membuat objek lebih fleksibel dan dinamis.
- Bisa memanipulasi property, method, dan perilaku runtime.
- `final` digunakan untuk melindungi struktur dari modifikasi turunan.
- Digunakan luas dalam framework modern (seperti model Laravel, CI4, dsb).