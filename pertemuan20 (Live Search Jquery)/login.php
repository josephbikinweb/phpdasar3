<?php 
    session_start();
    require 'functions.php';

    // cek cookie nya baru jalankan sessionnya
    // ada gak cookie login?
    // if (isset($_COOKIE['login'])){
    //     // di cek isi dari cookie login true atau bukan
    //     if($_COOKIE['login'] == 'true') {
    //         // kalau ada cookie login dan set nilai jadi true jalankan session
    //         // itu sebabnya if yang diatas pakai string dan dibawah pakai boolean tanpa kutip
    //         $_SESSION['login'] = true ;
    //     }
    // }

    // Perintah diatas agak riskan dihack

    // cek cookie
    if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
        // tampung dulu di var
        $id = $_COOKIE ['id'];
        $key = $_COOKIE ['key'];

        // ambil username berdasarkan id tampung data di var $result
        $result = mysqli_query($conn, "SELECT username FROM users WHERE id =$id");
        // hasil data di $result ditampung dalam var $row dengan array associative
        $row = mysqli_fetch_assoc($result);

        // cek cookie dan username berdasarkan database users
        if ($key === hash('sha256',$row['username'])) {
            $_SESSION['login'] = true;
        }
    }

    if(isset($_SESSION["login"])) {
        header("Location: index.php");
        exit;
    }

    

    if (isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // querynya ditampung dulu di variabel dalam hal ini $result
        // jangan lupa nama databasenya users bukan user
        $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

        // cek username
        // mysqli_num_rows untuk hitung ada berapa baris yang dikembalikan oleh fungsi SELECT dalam variabel $result. Kalau ketemu pasti nilainya 1 = true DAN kalau tidak ada maka nilainya 0 = false
        if(mysqli_num_rows($result) === 1) {
            // cek password
            // Data di database diambil / ditampung dulu di variabel $row
            $row = mysqli_fetch_assoc($result);
            // password_verify untuk mengecek password yg ditulis sama dengan yang di database
            // parameter pertama adalah yang ditulis oleh user
            // karena DATA di database sudah ditampung di var $row maka parameter kedua diambil dari panampungan DATA di $row
            if (password_verify($password, $row['password'])) {
                // set session
                $_SESSION["login"] = true ;

                // cek remember me
                if( isset($_POST['remember'])) {
                    // buat cookie
                    // setcookie('login', 'true', time()+60);
                    
                    // supaya lebih aman dan cookie diacak maka kita lakukan langkah sebagai berikut
                    setcookie('id', $row['id'], time()+60);
                    // kita jalankan hash (mengacak) dgn algoritma sha256 untuk tulisan username di var $row yang mengambil database di program diatas
                    // key adalah nama yang kita berikan bisa diganti lainnya
                    setcookie('key', hash('sha256', $row['username']),time()+60);
                }

                header("Location: index.php");
                exit;
            }
        }
        // error ini untuk beri pesan kesalahan jadi var nya dibawah
        $error = 'true';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>

    <style>
        label,button {
            display: block;
            margin-top: 10px;
        }
        label {
            padding-bottom: 10px;
        }
        li {
            list-style: none;
        }
        button {
            background-color: lightseagreen;
            color: white;
            font-weight: 700;
            font-family: monospace;
            border-radius: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Halaman Login</h1>

    <?php if(isset($error)) : ?>
        <p style="color: red; font-style: italic;"> Username / Password salah</p>
    <?php endif ?>

    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username</label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <input type="checkbox" name="remember" id="remember">
                <label style="display: inline-block;" for="remember">Remember Me</label>
            </li>
            <li>
                <button type="submit" name="login">Login</button>
            </li>
        </ul>
    </form>
</body>
</html>