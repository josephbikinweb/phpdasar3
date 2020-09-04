<?php
    session_start();

        if(!isset($_SESSION["login"])) {
            header("Location: login.php");
            exit;
        }

    require 'functions.php';
    $mahasiswa = query("SELECT * FROM mahasiswa");

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
    <style>
        .loader {
            width: 100px;
            position: absolute;
            top: 120px;
            left: 300px;
            z-index: -1;
            display: none;
        }
    </style>
</head>
<body>

    <a href="logout.php">Logout</a>
        
    <h1>DAFTAR MAHASISWA</h1>

    <a href="tambah.php">Tambah data mahasiswa</a>
    <br><br>
<!-- Search Menu -->
    <form action="" method="post">
        <input type="text" name="keyword" size="40" autofocus placeholder="masukkan keyword pencarian.." autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="tombol-cari">Cari</button>

        <img src="image/loader.gif" class="loader" alt="">

    </form>
    <br>
    
<!-- Tabel Data -->
    <div id="container">
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
    </div>

    <!-- jQuery bisa disimpan di head karena akan menunggu document html siap dulu baru dijalankan -->
    <!-- file script kita selalu disimpan dibawah jQuery dulu supaya bisa memanggil perintah jQuery                 -->
    <!-- Kenapa kita simpan file script di bawah sebelum tutup body karena script selalu dijalankan setelah document html selesai diload -->
    
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/script.js"></script>

</body>
</html>