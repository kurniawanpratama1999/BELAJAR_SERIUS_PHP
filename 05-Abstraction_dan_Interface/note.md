5. ABSTRACTION & INTERFACE
Fondasi desain class besar dan sistem yang fleksibel.

a. Abstract Class dan Abstract Method
   - Abstract class adalah class yang tidak bisa dibuat objeknya langsung.
   - Digunakan sebagai blueprint untuk class turunan.
   - Abstract method = method tanpa isi (wajib diimplementasi di class turunan).
   - Contoh:
       abstract class Hewan {
           abstract public function suara(); // wajib diimplementasi oleh anak class
           public function jenis() {
               echo "Ini adalah hewan.";
           }
       }

       class Kucing extends Hewan {
           public function suara() {
               echo "Meong!";
           }
       }

       $kucing = new Kucing();
       $kucing->suara(); // Output: Meong!

   🔹 Abstract class bisa memiliki:
       - Property dan method biasa
       - Abstract method (yang belum diimplementasi)
       - Constructor
       - Visibility: public, protected, private

b. Interface dan Implementasi Multipel
   - Interface adalah kontrak (aturan) yang harus diikuti oleh class yang mengimplementasikannya.
   - Semua method di dalam interface bersifat abstract (tanpa isi).
   - Class bisa mengimplementasi lebih dari satu interface.
   - Contoh:
       interface Bentuk {
           public function luas();
       }

       interface Warna {
           public function getWarna();
       }

       class Persegi implements Bentuk, Warna {
           private $sisi = 4;
           public function luas() {
               return $this->sisi * $this->sisi;
           }
           public function getWarna() {
               return "Biru";
           }
       }

       $obj = new Persegi();
       echo $obj->luas();      // Output: 16
       echo $obj->getWarna();  // Output: Biru

   🔹 Interface tidak bisa punya:
       - Property
       - Constructor
       - Implementasi method (semuanya harus didefinisikan di class turunan)

c. Perbedaan Abstract Class vs Interface
   | Fitur / Konsep                     | Abstract Class            | Interface                    |
   |------------------------------------|---------------------------|------------------------------|
   | Bisa punya property                | ✅ Ya                     | ❌ Tidak                     |
   | Bisa punya implementasi method     | ✅ Ya                     | ❌ Tidak                     |
   | Bisa memiliki constructor          | ✅ Ya                     | ❌ Tidak                     |
   | Multiple inheritance               | ❌ Tidak bisa             | ✅ Bisa                      |
   | Cocok digunakan untuk              | Base class (template)     | Aturan kontrak (kontrak API) |

d. Dependency Injection (Konsep Dasar)
   - Cara menyuntikkan (inject) dependency ke dalam class, bukan membuatnya langsung di dalam class.
   - Membuat kode lebih fleksibel, mudah diuji, dan tidak saling bergantung keras.
   - Contoh:
       interface DatabaseInterface {
           public function connect();
       }

       class MySQLDatabase implements DatabaseInterface {
           public function connect() {
               echo "Terhubung ke MySQL Database";
           }
       }

       class UserRepository {
           private $db;
           // Dependency disuntikkan melalui constructor
           public function __construct(DatabaseInterface $db) {
               $this->db = $db;
           }
           public function getAllUsers() {
               $this->db->connect();
               echo "<br>Menampilkan semua user";
           }
       }

       // Dependency Injection
       $mysql = new MySQLDatabase();
       $repo = new UserRepository($mysql);
       $repo->getAllUsers();

   🔹 Keuntungan Dependency Injection:
       - Class lebih fleksibel dan mudah diubah
       - Tidak bergantung pada implementasi spesifik
       - Mudah untuk melakukan unit testing

🔹 Kesimpulan:
- Abstract class → cetakan dasar dengan perilaku umum.
- Interface → kontrak wajib untuk class-class yang menggunakannya.
- Dependency Injection → membuat hubungan antar class menjadi longgar dan mudah dikelola.

