<?php
    session_start();

        if(!isset($_SESSION["login"])) {
            header("Location: login.php");
            exit;
        }

    require 'functions.php';

    // PAGINATION
    // konfigurasi
    $jumlahDataPerHalaman = 2;

    // fungsi mysqli_num_rows mengembalikan berupa object untuk menghitung berapa baris data dikembalikan
    // $result = mysqli_query($conn, "SELECT * FROM mahasiswa");
    // $jumlahData = mysqli_num_rows($result);
    // var_dump($jumlahData);
    
    // fungsi count untuk menghitung array associative yang dihasilkan query
    $jumlahData = count(query("SELECT * FROM mahasiswa"));
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
    // cek dahulu apakah ada halamannya atau tidak
    // if(isset($_GET['halaman'])) {
    //     $halamanAktif = $_GET['halaman'];
    // } else {
    //     $halamanAktif = 1;
    // }
    // var_dump($halamanAktif);
    
    // ATAU bisa ditulis (ternary):
    $halamanAktif = ( isset($_GET['halaman'])) ? $_GET['halaman'] :1;
    // var_dump($halamanAktif);
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
    // dengan menggunakan data per halaman = 2, maka :
    // halaman 1 mulai dari index ke 0 dan 1
    // halaman 2 mulai dari index ke 2 dan 3
    // halaman 3 mulai dari index ke 5 dan 6

    // LOGIKA diatas untuk mencari awal data dan jumlah Data per Halaman untuk digunakan di query dibawah ini
    $mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awalData, $jumlahDataPerHalaman");

// tombol cari ditekan
    if( isset($_POST["cari"])) {
        $mahasiswa = cari($_POST["keyword"]);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HALAMAN ADMIN</title>
</head>
<body>

    <a href="logout.php">Logout</a>
        
    <h1>DAFTAR MAHASISWA</h1>

    <a href="tambah.php">Tambah data mahasiswa</a>
    <br><br>

    <form action="" method="post">
        <input type="text" name="keyword" size="40" autofocus placeholder="masukkan keyword pencarian.." autocomplete="off">
        <button type="submit" name="cari">Cari</button>
    </form>

    <!-- Navigasi Pagination -->

    <!-- supaya tidak error dan tidak ke halaman 0 maka : -->
    <?php if($halamanAktif > 1) : ?>
        <!-- &lt(less than) adalah html karakter yang memunculkan panah kiri  TAPI kita memakai &laquo (left arrow double)-->
        <!-- JANGAN LUPA = karena akan ditulis di url -->
        <a href="?halaman=<?=$halamanAktif-1?>">&laquo;</a>
    <?php endif; ?>

    <!-- JANGAN LUPA tanda : yang berarti kurung kurawal buka -->
    <?php for($i = 1; $i <= $jumlahHalaman; $i++) : ?>
        <?php if($i == $halamanAktif) : ?>        
        <!-- href tidak perlu ditulis nama filenya apabila halaman yang dituju masih sama -->
        <!-- echo $i yang diluar tag a adalah untuk memanggil jumlah halamannya -->
        <!-- echo $i yang di dalam tag a adalah untuk memanggil data dihalaman ke-$i = fungsinya ?halaman untuk mengubah di url-->
            <a href="?halaman=<?=$i?>" style="font-weight:bold; color:blue; "><?= $i; ?></a>
        <?php else : ?>
            <a href="?halaman=<?=$i?>"><?= $i; ?></a>
        <?php endif; ?>
    <!-- endfor berarti kurung kurawal tutup -->
    <?php endfor; ?>

    <?php if($halamanAktif < $jumlahHalaman) : ?>
        <!-- tanda gt (greater than) artinya lebih dari -->
        <!-- kita memakai raquo (right arrow) -->
        <a href="?halaman=<?=$halamanAktif+1?>">&raquo;</a>
    <?php endif; ?>

    <br>
    
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</td>
            <!--Aksi untuk tombol ubah  -->
            <th>Aksi</td>
            <th>Gambar</td>
            <th>NRP</td>
            <th>Nama</td>
            <th>Email</td>
            <th>Jurusan</th>
        </tr>

        <tr>
        <?php $i = 1;?>
        <?php foreach( $mahasiswa as $row ) : ?>
        
            <td><?= $i; ?> </td>
            <td>
                <a href="ubah.php?id=<?= $row["id"];?>">Ubah</a> |
                <a href="hapus.php?id=<?= $row["id"];?>" 
                    onclick="return confirm('Yakin?');">Hapus</a>
            </td>
            <td><img src="image/<?= $row["gambar"];?>" width="75"></td>
            <td><?= $row["nrp"];?></td>
            <td><?= $row["nama"];?></td>
            <td><?= $row["email"];?></td>
            <td><?= $row["jurusan"];?></td>
            
        </tr>
        <?php $i++; ?>
        <?php endforeach ?>
    </table>


</body>
</html>