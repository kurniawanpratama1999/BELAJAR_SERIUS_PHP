3. INHERITANCE & POLYMORPHISM
Mengenal pewarisan dan perluasan perilaku objek.

a. Konsep Inheritance (Pewarisan)
   - Class anak (child) dapat mewarisi properti dan method dari class induk (parent).
   - Menggunakan keyword `extends`.
   - Tujuannya agar kode dapat digunakan kembali (reusability).
   - Contoh:
       class Kendaraan {
           public $roda = 0;
           public function jalan() {
               echo "Kendaraan berjalan";
           }
       }

       class Mobil extends Kendaraan {
           public $merk;
       }

       $mobil = new Mobil();
       $mobil->roda = 4;
       $mobil->jalan(); // Output: Kendaraan berjalan

b. Overriding Method
   - Class turunan bisa menimpa (override) method dari class induk.
   - Berguna untuk mengubah perilaku method bawaan.
   - Contoh:
       class Kendaraan {
           public function jalan() {
               echo "Kendaraan umum berjalan";
           }
       }

       class Mobil extends Kendaraan {
           public function jalan() {
               echo "Mobil pribadi berjalan cepat";
           }
       }

       $mobil = new Mobil();
       $mobil->jalan(); // Output: Mobil pribadi berjalan cepat

c. Penggunaan parent:: dan self::
   - parent:: digunakan untuk memanggil method dari class induk.
   - self:: digunakan untuk mengakses properti atau method statis dari class yang sama.
   - Contoh:
       class Kendaraan {
           public function info() {
               echo "Ini kendaraan umum.<br>";
           }
       }

       class Mobil extends Kendaraan {
           public function info() {
               parent::info(); // Memanggil method parent
               echo "Tapi ini juga kendaraan pribadi.";
           }
       }

       $mobil = new Mobil();
       $mobil->info();

d. Polymorphism (Bentuk Ganda Method)
   - Konsep di mana objek yang berbeda bisa memiliki method dengan nama yang sama,
     tapi implementasi berbeda.
   - Berguna untuk membuat sistem yang fleksibel dan extensible.
   - Contoh:
       class Hewan {
           public function suara() {
               echo "Hewan bersuara.";
           }
       }

       class Kucing extends Hewan {
           public function suara() {
               echo "Meong!";
           }
       }

       class Anjing extends Hewan {
           public function suara() {
               echo "Guk!";
           }
       }

       $hewan = [new Kucing(), new Anjing()];
       foreach ($hewan as $h) {
           $h->suara(); // Output: Meong!Guk!
       }

e. Late Static Binding
   - Digunakan ketika class turunan memanggil method statis yang didefinisikan di parent.
   - Gunakan keyword `static::` agar method merujuk ke class pemanggil (bukan parent-nya).
   - Contoh:
       class A {
           public static function siapa() {
               echo static::class; // Akan menampilkan nama class pemanggil
           }
       }

       class B extends A {}

       B::siapa(); // Output: B
