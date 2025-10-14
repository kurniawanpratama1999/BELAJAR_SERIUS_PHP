4. ENCAPSULATION
Menyembunyikan data agar aman, terstruktur, dan mudah dikontrol.

a. Private / Protected Property
   - Property (atau method) bisa dibuat private atau protected agar tidak bisa diakses langsung dari luar class.
   - Tujuannya untuk melindungi data internal agar tidak diubah sembarangan.
   - Contoh:
       class AkunBank {
           private $saldo = 0; // Tidak bisa diakses langsung dari luar class
       }

       $akun = new AkunBank();
       // echo $akun->saldo; // ❌ Error: Cannot access private property

b. Getter & Setter Method
   - Digunakan untuk mengatur (set) dan mengambil (get) nilai property private.
   - Memberikan kontrol dan validasi terhadap data yang masuk.
   - Contoh:
       class AkunBank {
           private $saldo = 0;

           public function setSaldo($jumlah) {
               if ($jumlah >= 0) {
                   $this->saldo = $jumlah;
               } else {
                   echo "Jumlah saldo tidak valid.";
               }
           }

           public function getSaldo() {
               return $this->saldo;
           }
       }

       $akun = new AkunBank();
       $akun->setSaldo(100000);
       echo $akun->getSaldo(); // Output: 100000

c. Data Validation dalam Setter
   - Setter dapat digunakan untuk memastikan data yang disimpan sudah benar.
   - Contoh validasi sederhana:
       class User {
           private $email;

           public function setEmail($email) {
               if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                   $this->email = $email;
               } else {
                   echo "Format email tidak valid.";
               }
           }

           public function getEmail() {
               return $this->email;
           }
       }

       $user = new User();
       $user->setEmail("contoh@domain.com"); // ✅ valid
       $user->setEmail("salah_format");      // ❌ invalid

d. Penggunaan Konstanta (const)
   - Konstanta digunakan untuk menyimpan nilai tetap di dalam class.
   - Tidak bisa diubah setelah didefinisikan.
   - Diakses menggunakan `self::NAMA_KONSTANTA`.
   - Contoh:
       class Config {
           public const VERSION = "1.0.0";
           public const APP_NAME = "Sistem Manajemen Produk";
       }

       echo Config::APP_NAME;   // Output: Sistem Manajemen Produk
       echo Config::VERSION;    // Output: 1.0.0

===========================================
🔹 Kesimpulan:
Encapsulation = "menyembunyikan data" agar:
   - Tidak bisa diubah langsung dari luar class.
   - Hanya bisa diubah lewat method resmi (getter/setter).
   - Data lebih aman dan mudah dikontrol.
