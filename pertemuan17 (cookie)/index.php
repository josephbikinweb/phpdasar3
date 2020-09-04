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