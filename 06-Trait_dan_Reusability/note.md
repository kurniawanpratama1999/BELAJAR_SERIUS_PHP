6. TRAIT & REUSABILITY
Cara menulis kode reusable tanpa harus menggunakan inheritance.

a. Trait dan use
   - Trait adalah kumpulan method yang bisa digunakan kembali oleh beberapa class.
   - Trait tidak bisa dibuat objek, tapi bisa “disisipkan” ke dalam class menggunakan keyword `use`.
   - Tujuan utama: menghindari duplikasi kode (code reuse).
   - Contoh:
       trait Logger {
           public function log($pesan) {
               echo "[LOG]: $pesan<br>";
           }
       }

       class User {
           use Logger;
           public function login() {
               $this->log("User login berhasil.");
           }
       }

       class Produk {
           use Logger;
           public function tambah() {
               $this->log("Produk baru ditambahkan.");
           }
       }

       $user = new User();
       $user->login();

       $produk = new Produk();
       $produk->tambah();

   🔹 Trait seperti "mixin" di bahasa lain — bukan class, tapi bisa ditanam ke banyak class.

b. Trait vs Inheritance
   - Inheritance hanya bisa dilakukan satu kali (single inheritance).
   - Trait bisa digunakan oleh banyak class sekaligus tanpa hubungan pewarisan.
   - Contoh perbedaan:
       class A {
           public function halo() {
               echo "Halo dari Class A";
           }
       }

       trait B {
           public function sapa() {
               echo "Halo dari Trait B";
           }
       }

       class C extends A {
           use B;
       }

       $obj = new C();
       $obj->halo(); // dari class A
       $obj->sapa(); // dari trait B

   🔹 Dengan trait, kita bisa gabungkan banyak fitur tanpa perlu pewarisan berlapis.

c. Conflict Resolution di Trait
   - Jika dua trait memiliki method dengan nama sama, PHP akan menimbulkan konflik.
   - Untuk mengatasinya, gunakan `insteadof` dan `as`.
   - Contoh:
       trait A {
           public function hello() {
               echo "Hello dari Trait A";
           }
       }

       trait B {
           public function hello() {
               echo "Hello dari Trait B";
           }
       }

       class C {
           use A, B {
               A::hello insteadof B; // Gunakan hello() dari A
               B::hello as helloB;   // Alias untuk hello() dari B
           }
       }

       $obj = new C();
       $obj->hello();  // Output: Hello dari Trait A
       $obj->helloB(); // Output: Hello dari Trait B

   🔹 Gunakan alias (`as`) untuk memanggil method dari trait lain tanpa konflik.

d. Case: Membuat LoggerTrait dan TimestampTrait
   - Contoh nyata penggunaan trait untuk sistem logging dan timestamp.
   - Contoh:
       trait LoggerTrait {
           public function log($msg) {
               echo "[LOG] " . date('Y-m-d H:i:s') . " - $msg<br>";
           }
       }

       trait TimestampTrait {
           public function createdAt() {
               return date('Y-m-d H:i:s');
           }
       }

       class Artikel {
           use LoggerTrait, TimestampTrait;

           public function publish() {
               $this->log("Artikel diterbitkan pada " . $this->createdAt());
           }
       }

       $artikel = new Artikel();
       $artikel->publish();

   🔹 Trait membantu membuat kode modular, bersih, dan mudah dipelihara.

🔹 Kesimpulan:
- Trait digunakan untuk menambahkan fitur ke banyak class tanpa inheritance.
- Bisa digabung, dikombinasi, dan dikonfigurasi dengan `insteadof` & `as`.
- Sangat berguna untuk logging, timestamp, helper, dan fitur umum lainnya.