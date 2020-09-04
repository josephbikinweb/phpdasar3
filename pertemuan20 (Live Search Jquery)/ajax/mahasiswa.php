<?php 
// untuk tes jadi gambar loader bisa muncul agak lama
// sleep(parameter 1 detik)
// sleep(1);

// kalau usleep bisa sampai micro detik
usleep(50000);
    require '../functions.php';

    // kita ambil url keyword yang dikirim dari file script.js
    $keyword = $_GET['keyword'];
    
    // function cari kita copykan ke sini
    $query = "SELECT * FROM mahasiswa
                WHERE
            nama LIKE '%$keyword%' OR
            nrp LIKE '%$keyword%' OR
            email LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%' 
            ";
    $mahasiswa = query($query);

    // untuk tes apakah var mahasiswa sudah berhasil datanya
    // var_dump($mahasiswa);

?>
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