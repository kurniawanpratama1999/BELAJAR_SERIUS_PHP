<?php
/*
1. Variable
(+) Pengertian:
- Variabel adalah wadah untuk menyimpan data.
- Dalam PHP, semua variabel diawali dengan tanda $.

(+) Aturan penamaan:
- Harus diawali dengan $
- Nama variabel tidak boleh diawali angka
- Hanya boleh berisi huruf, angka, dan underscore _
- Bersifat case-sensitive ($nama ≠ $Nama)
*/

$nama = "Kurniawan";   // string
$umur = 25;            // integer
$tinggi = 170.5;       // float
$aktif = true;         // boolean

echo "Nama saya $nama <br>";
echo "Umur saya $umur tahun <br>";
echo "Tinggi badan saya $tinggi cm <br>";
echo "Status aktif: $aktif"; // true akan ditampilkan sebagai 1

/*
Catatan:
(+) PHP adalah loosely typed language, artinya:
Kamu tidak perlu mendeklarasikan tipe data variabel secara eksplisit.
*/

$nilai = 10;     // integer
$nilai = "Sepuluh"; // sekarang berubah jadi string, dan ini sah di PHP
?>

<?php
/*
2. Tipe Data
|--------------------|----------------------|-------------------------|
| Tipe Data          | Contoh Nilai         | Penjelasan              |
| ------------------ | -------------------- | ----------------------- |
| **String**         | `"Halo Dunia"`       | Teks diapit tanda kutip |
| **Integer**        | 42                   | Bilangan bulat          |
| **Float / Double** | 3.14                 | Bilangan pecahan        |
| **Boolean**        | true / false         | Benar atau salah        |
| **Array**          | ["apel", "pisang"]   | Kumpulan data           |
| **Object**         | new User()           | Representasi dari class |
| **NULL**           | null                 | Tidak ada nilai         |

*/

$teks = "Belajar PHP";    // String
$angka = 100;             // Integer
$desimal = 99.99;         // Float
$benar = true;            // Boolean
$data = ["apel", "pisang", "jeruk"]; // Array
$kosong = null;           // NULL

var_dump($teks);
// output: string(11) "Belajar PHP"

var_dump($angka);
// output: int(100)

var_dump($desimal);
// output: float(99.99)

var_dump($benar);
// output: bool(true)

var_dump($data);
// output: array(3) { [0]=> string(4) "apel" [1]=> string(6) "pisang" [2]=> string(5) "jeruk" }

var_dump($kosong);
// output: NULL

/*
Catatan tambahan:
- var_dump() sangat penting untuk mengecek tipe data dan nilai variabel.
- Saat debugging nanti (di OOP dan framework), ini jadi alat wajib.
*/
?>

<?php
/*
3. Operator
Operator adalah simbol yang digunakan untuk melakukan operasi terhadap variabel atau nilai.

3A. Aritmatika
Digunakan untuk operasi matematika dasar.

|----------|-------------|-----------|-------------------|
| Operator | Nama        | Contoh    | Hasil             |
| -------- | ----------- | --------- | ----------------- |
| `+`      | Penjumlahan | `$a + $b` | Jumlah dua nilai  |
| `-`      | Pengurangan | `$a - $b` | Selisih dua nilai |
| `*`      | Perkalian   | `$a * $b` | Hasil kali        |
| `/`      | Pembagian   | `$a / $b` | Hasil bagi        |
| `%`      | Modulus     | `$a % $b` | Sisa pembagian    |
*/

$a = 10;
$b = 3;

echo $a + $b; // output: 13
echo $a - $b; // output: 7
echo $a * $b; // output: 30
echo $a / $b; // output: 3.3333
echo $a % $b; // output: 1

/*
3B. Operator Perbandingan
Digunakan untuk membandingkan dua nilai (hasilnya boolean: true / false).

|----------|-----------------------------|-------------|-------|
| Operator | Makna                       | Contoh      | Hasil |
| -------- | --------------------------- | ----------- | ----- |
| `==`     | Sama dengan (nilai saja)    | `5 == "5"`  | true  |
| `===`    | Identik (nilai + tipe data) | `5 === "5"` | false |
| `!=`     | Tidak sama                  | `5 != 3`    | true  |
| `!==`    | Tidak identik               | `5 !== "5"` | true  |
| `>`      | Lebih besar                 | `10 > 5`    | true  |
| `<`      | Lebih kecil                 | `10 < 5`    | false |
| `>=`     | Lebih besar atau sama       | `10 >= 10`  | true  |
| `<=`     | Lebih kecil atau sama       | `5 <= 10`   | true  |

*/

$sama_dengan = 5 == "5";
echo $sama_dengan; //output: true    

$identik = 5 === "5";
echo $identik; //output: false

$tidak_sama = 5 != 3;
echo $tidak_sama; //output: true

$tidak_identik = 5 !== "5";
echo $tidak_identik; //output: true

$lebih_besar = 10 > 5;
echo $lebih_besar; //output: true

$lebih_kecil = 10 < 5;
echo $lebih_kecil; //output: false

$lebih_besar_atau_sama = 10 >= 10;
echo $lebih_besar_atau_sama; //output: true

$lebih_kecil_atau_sama = 5 <= 10;
echo $lebih_kecil_atau_sama; //output: true


/*
3C. Operator Logika
Digunakan untuk menggabungkan ekspresi boolean.
|----------|------|-----------------|-------|
| Operator | Nama | Contoh          | Hasil |
| -------- | ---- | --------------- | ----- |
| `&&`     | AND  | `true && false` | false |
| `||`     | OR   | `true || false` | true  |
| `!`      | NOT  | `!true`         | false |

*/
$usia = 20;
$member = true;


if ($usia >= 18 && $member) { // Kalau variable usia lebih dari atau sama dengan 18 dan kalau variable member adalah true
    echo "Boleh masuk!"; // Kalau memenuhi maka tampilkan "Boleh Masuk"
} else { // Kalau tidak Memenuhi maka tampilkan yg else
    echo "Tidak memenuhi syarat.";
}

//output: Boleh masuk!
//karena: variabel usia lebih dari 20 dan variabel member adalah true


/*
3D. Operator Penugasan
Untuk mengisi nilai ke variabel.

| Operator | Contoh         | Sama dengan          |
| -------- | -------------- | -------------------- |
| `=`      | `$a = 10`      | Menetapkan nilai     |
| `+=`     | `$a += 5`      | `$a = $a + 5`        |
| `-=`     | `$a -= 2`      | `$a = $a - 2`        |
| `*=`     | `$a *= 3`      | `$a = $a * 3`        |
| `/=`     | `$a /= 2`      | `$a = $a / 2`        |
| `.=`     | `$a .= "teks"` | Menggabungkan string |

*/

$a = 10; //Menetapkan Nilai
echo $a; //output: 10

$a += 5; //sama aja kayak $a = $a + 5
echo $a; //output: 15

$a -= 2; //sama aja kayak $a = $a - 2
echo $a; //output: 13

$a *= 3; //sama aja kayak $a = $a * 3
echo $a; //output: 39

$a /= 2; //sama aja kayak $a = $a / 2
echo $a; //output: 19.5

$nama = "Kurniawan";
echo $nama; //output: Kurniawan

$nama .= " Pratama";
echo $nama; //output: Kurniawan Pratama

/*
3E. Operator Gabungan
Khusus string dan ternary:
*/

// Gabung string
$pesan = "Halo, " . "Dunia!";

// Operator ternary (if versi singkat)
$umur = 17;
$status = ($umur >= 18) ? "Dewasa" : "Anak-anak";
echo $status; // Output: Anak-anak
?>