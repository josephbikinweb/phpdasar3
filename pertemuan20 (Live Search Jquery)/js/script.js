// logika dasar :
// javascript ambil document berdasarkan ID("keyword"), setelah keyword didapatkan ketika ada Event / kejadian tombol diangkat (setelah ditekan) lalu jalankan FUNGSI console log

// var keyword = document.getElementById("keyword");
// keyword.addEventListener("keyup", function () {
//   console.log("ok");
// });

// hilangkan tombol cari
$("#tombol-cari").hide();

// $ disini sama dengan jQuery
// jQuery(document)
// logikanya : jQuery ambil document lalu ketika document siap/ready jalankan fungsi berikut
$(document).ready(function () {
  $("#keyword").on("keyup", function () {
    // munculkan loader ketika tombol ditekan
    // jQuery ketika keyup, cari kelas loader dan tampilkan
    $(".loader").show();

    // jQuery carikan sebuah elemen dengan ID container lalu load / ubah isinya dari data yang kita ambil dari sumber
    // ajax ini menggunakan load
    // $("#container").load("ajax/mahasiswa.php?keyword=" + $("#keyword").val());
    // kalau jQuery value ditulis val saja
    // fungsi load ini mempunyai keterbatasan karena hanya bisa menggunakan method GET tidak bisa POST

    // kita memggunakan ajax dengan method GET
    // jQuery ambil data keyword lalu setelah data keyword didapatkan jalankan FUNGSI (data) -> ini menggantikan fungsi xhr
    $.get("ajax/mahasiswa.php?keyword=" + $("#keyword").val(), function (data) {
      $("#container").html(data);
      $(".loader").hide();
    });
  });
});
