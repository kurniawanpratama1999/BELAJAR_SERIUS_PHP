7. STATIC & CONSTANT MEMBERS
Fitur untuk properti dan method yang bersifat global di dalam class.

a. Static Property & Method
   - Static property dan method dapat diakses tanpa membuat objek.
   - Menggunakan keyword `static`.
   - Biasanya digunakan untuk menyimpan data global atau fungsi utilitas.
   - Contoh:
       class MathHelper {
           public static $pi = 3.14159;

           public static function tambah($a, $b) {
               return $a + $b;
           }
       }

       // Akses tanpa membuat objek
       echo MathHelper::$pi;              // Output: 3.14159
       echo MathHelper::tambah(5, 7);     // Output: 12

   🔹 Static member milik class, bukan milik instance (objek).
   🔹 Akses dengan `ClassName::method()` atau `self::` di dalam class.

b. Mengakses Static Property/Method dengan self:: dan static::
   - `self::` → Mengacu ke class saat ini.
   - `static::` → Mengacu ke class yang memanggilnya (late static binding).
   - Contoh perbedaan:
       class A {
           public static function siapa() {
               echo "Saya dari class A";
           }

           public static function panggil() {
               self::siapa();   // Panggil versi class ini
           }

           public static function panggilLate() {
               static::siapa(); // Panggil versi class turunan
           }
       }

       class B extends A {
           public static function siapa() {
               echo "Saya dari class B";
           }
       }

       B::panggil();      // Output: Saya dari class A
       B::panggilLate();  // Output: Saya dari class B

   🔹 `self::` = panggil method di class tempat method ditulis.
   🔹 `static::` = panggil method dari class yang memanggil (polymorphism untuk static context).

c. Konstanta Class (const)
   - Nilai tetap di dalam class, tidak bisa diubah.
   - Biasanya digunakan untuk konfigurasi global, tipe, atau kode status.
   - Contoh:
       class AppConfig {
           const APP_NAME = "Belajar OOP PHP";
           const VERSION = "1.0.0";
       }

       echo AppConfig::APP_NAME; // Output: Belajar OOP PHP
       echo AppConfig::VERSION;  // Output: 1.0.0

   🔹 Berbeda dari static property:
       - `const` tidak bisa diubah.
       - `const` tidak butuh `$` di depan nama.
       - `const` langsung terdefinisi saat class di-load.

d. Static Utility Class
   - Class yang hanya berisi method static.
   - Biasanya digunakan untuk helper, converter, formatter, dll.
   - Contoh:
       class StringHelper {
           public static function upper($text) {
               return strtoupper($text);
           }

           public static function lower($text) {
               return strtolower($text);
           }

           public static function title($text) {
               return ucwords($text);
           }
       }

       echo StringHelper::upper("halo dunia");  // Output: HALO DUNIA
       echo StringHelper::title("belajar oop"); // Output: Belajar Oop

   🔹 Tidak perlu membuat objek: semua method bisa langsung dipanggil.

🔹 Kesimpulan:
- `static` = properti/method milik class, bukan objek.
- `self::` untuk referensi dalam class sendiri.
- `static::` untuk late static binding (turunan).
- `const` digunakan untuk nilai tetap.
- Static class berguna untuk utilitas dan helper global.