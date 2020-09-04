// ambil elemen2 yang dibutuhkan
var keyword = document.getElementById("keyword");
var tombolCari = document.getElementById("tombol-cari");
var container = document.getElementById("container");

// tombolCari.addEventListener("click", function () {
//   alert("berhasil!!");
// });

// tambahkan event ketika keyword ditulis
// keyup berarti ketika tombol diangkat
// keydown ketika ditekan
keyword.addEventListener("keyup", function () {
  //   console.log(keyword.value);

  // buat object ajax
  var xhr = new XMLHttpRequest();

  // cek kesiapan ajax
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      //   console.log(xhr.responseText);

      //   ganti isi container dengan apapun dari sumbernya
      container.innerHTML = xhr.responseText;
    }
  };

  //   eksekusi ajax (Parameter1 = request method = GET; Parameter2 = sumber data dari mana; Parameter3 mau sychronous atau Asynchronous; kalau true berarti Asynchronous)

  //   test dengan file txt
  //     xhr.open("GET", "ajax/coba.txt", true);
  //     xhr.send();

  //   kita tangkap keyword yang diketikkan di menu cari dikirim ke url
  //   tanda + untuk menggabungkan
  //
  xhr.open("GET", "ajax/mahasiswa.php?keyword=" + keyword.value, true);
  xhr.send();
});
