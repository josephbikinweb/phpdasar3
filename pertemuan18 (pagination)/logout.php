<?php 
    session_start();
    // supaya yakin data sudah dihapus / reset dari browser bisa ditambahkan 2 perintah :
    // $_SESSION dengan array Kosong dan 
    // session_unset()
    $_SESSION = [];
    session_unset();

    session_destroy();

    setcookie('id', "", time()-3600);
    setcookie('key', "", time()-3600);

    header("Location: login.php");
    exit;
?>