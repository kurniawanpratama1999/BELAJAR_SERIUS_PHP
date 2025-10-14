9. NAMESPACE & AUTOLOADING
Wajib banget kalau kamu bikin project besar atau framework sendiri.

a. Apa itu Namespace?
   - Namespace digunakan untuk mengelompokkan class agar tidak bentrok dengan nama class lain.
   - Sama seperti folder untuk class.
   - Membantu saat banyak class dengan nama sama di project besar.

   Contoh:
       // File: src/Models/User.php
       namespace App\Models;

       class User {
           public function info() {
               echo "Ini class User dari App\\Models";
           }
       }

       // File: src/Controllers/User.php
       namespace App\Controllers;

       class User {
           public function info() {
               echo "Ini class User dari App\\Controllers";
           }
       }

       // File utama:
       require_once "src/Models/User.php";
       require_once "src/Controllers/User.php";

       $userModel = new App\Models\User();
       $userController = new App\Controllers\User();

       $userModel->info();      // Output: Ini class User dari App\Models
       $userController->info(); // Output: Ini class User dari App\Controllers

   🔹 Keyword `namespace` dideklarasikan di baris pertama file.
   🔹 Gunakan `\` sebagai pemisah seperti path folder.

b. Menggunakan use untuk Import Namespace
   - Keyword `use` memudahkan kita memanggil class panjang.
   - Contoh:
       use App\Models\User;

       $user = new User();
       $user->info();

   🔹 Bisa juga menggunakan alias:
       use App\Controllers\User as UserController;
       $ctrl = new UserController();

c. Struktur Folder Modular
   - Namespace biasanya mengikuti struktur folder.
   - Contoh struktur PSR-4:
       📁 project/
       ├── 📁 src/
       │   ├── 📁 Controllers/
       │   │   └── UserController.php
       │   ├── 📁 Models/
       │   │   └── User.php
       └── index.php

   - File `src/Models/User.php` berisi:
       namespace App\Models;
       class User {}

   - Ini akan memudahkan autoloading otomatis nanti.

d. PSR-4 Autoloading (Composer)
   - PSR-4 = standar autoloading modern di PHP.
   - Composer bisa memuat semua class berdasarkan namespace otomatis.

   1️⃣ Buat file `composer.json`:
       {
         "autoload": {
           "psr-4": {
             "App\\": "src/"
           }
         }
       }

   2️⃣ Jalankan di terminal:
       composer dump-autoload

   3️⃣ Sekarang kamu bisa langsung memanggil class tanpa require:
       require 'vendor/autoload.php';

       use App\Models\User;
       $u = new User();

   🔹 Composer akan otomatis memetakan namespace `App\` ke folder `src/`.
   🔹 Jadi semua class di `src/` akan dikenali otomatis.

e. Manual Autoloading dengan spl_autoload_register()
   - Jika tidak pakai Composer, kamu bisa bikin autoloader manual.
   - Contoh:
       spl_autoload_register(function ($class) {
           $path = str_replace("\\", "/", $class);
           $file = __DIR__ . "/src/" . $path . ".php";
           if (file_exists($file)) {
               require_once $file;
           }
       });

       $user = new App\Models\User(); // otomatis memanggil src/App/Models/User.php

   🔹 Fungsi ini akan dipanggil otomatis setiap kali PHP menemukan class yang belum diload.

🔹 Kesimpulan:
- Namespace = pengelompokan class agar tidak bentrok.
- `use` = untuk mempersingkat nama class panjang.
- Autoloading = cara otomatis memuat class tanpa require manual.
- PSR-4 (via Composer) adalah standar industri modern.
- spl_autoload_register() bisa jadi alternatif autoloading manual.

🎯 Setelah bagian ini kamu resmi memahami seluruh fondasi OOP PHP modern!
Sekarang kamu siap:
   ✅ Membangun arsitektur project OOP sendiri
   ✅ Memahami struktur framework besar seperti Laravel & CodeIgniter 4
   ✅ Membuat autoloader, controller, dan model sendiri dari nol
*/
