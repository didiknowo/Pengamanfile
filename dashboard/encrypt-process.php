<?php
session_start();
include "../config.php";   //memasukan koneksi
include "AES.php"; //memasukan file AES

if (isset($_POST['encrypt_now'])) {
  $user      = $_SESSION['username'];
  $key       = mysqli_escape_string($connect, substr(md5($_POST["pwdfile"]), 0, 16));
  $deskripsi = mysqli_escape_string($connect, $_POST["pwdfile"]);

  $file_tmpname   = $_FILES['file']['tmp_name'];
  //untuk nama file url
  $file           = rand(1000, 100000) . "-" . $_FILES['file']['name'];
  $new_file_name  = strtolower($file);
  $final_file     = str_replace(' ', '-', $new_file_name);
  //untuk nama file
  $filename       = rand(1000, 100000) . "-" . pathinfo($_FILES['file']['name'], PATHINFO_FILENAME); //mengembalikan nama file
  $new_filename  = strtolower($filename);
  $finalfile     = str_replace(' ', '-', $new_filename);
  $size           = filesize($file_tmpname);
  $size2          = (filesize($file_tmpname)) / 1024;
  $info           = pathinfo($final_file); //mengembalikan informasi tentang jalur file
  $file_source    = fopen($file_tmpname, 'rb');  //digunakan untuk membuka file atau URL  r = Membuka file untuk dibaca
  $ext            = $info["extension"];

  if ($ext == "docx" || $ext == "doc" || $ext == "txt" || $ext == "pdf" || $ext == "xls" || $ext == "xlsx" || $ext == "ppt" || $ext == "pptx"
  ||$ext == "jpg" ||$ext == "png" ) {
  } else {
    echo ("<script language='javascript'>
      window.location.href='encrypt.php';
      window.alert('Maaf, file yang bisa dienkrip hanya word, excel, text, ppt ataupun pdf.');
      </script>");
    exit();
  }

  if ($size2 > 1024000) {
    echo ("<script language='javascript'>
      window.location.href='home.php?encrypt';
      window.alert('Maaf, file tidak bisa lebih besar dari 1 GB.');
      </script>");
    exit();
  }

  $today = mysqli_query($connect, "SELECT id_file FROM FILE WHERE id_file LIKE DATE_FORMAT(NOW(),'%y%m%d%')");
  $i = 0;
  while ($data = mysqli_fetch_array($today)) {
    $i++;
  }
  if ($i <= 0) {
    $new_id = mysqli_query($connect, "SELECT DATE_FORMAT(NOW(),'%y%m%d%001') AS new_id");
    while ($data = mysqli_fetch_array($new_id)) {
      $id_file = $data['new_id'];
    }
  } else {
    $newid = mysqli_query($connect, "SELECT MAX(id_file) AS new_id FROM FILE WHERE id_file LIKE DATE_FORMAT(NOW(),'%y%m%d%')");
    while ($data = mysqli_fetch_array($newid)) {
      $id_file = $data['new_id'] + 1;
    }
  }

  var_dump($id_file);
  $sql1   = "INSERT INTO file VALUES ('$id_file', '$user', '$final_file', '$finalfile.rda', '', '$size2', '$key', now(), '1', '$deskripsi')";
  $query1  = mysqli_query($connect, $sql1) or die(mysqli_connect_error());

  $sql2   = "SELECT * FROM file WHERE file_url =''";
  $query2  = mysqli_query($connect, $sql2) or die(mysqli_connect_error());

  $url   = $finalfile . ".rda";
  $file_url = "file_encrypt/$url";

  $sql3   = "UPDATE file SET file_url ='$file_url' WHERE file_url=''";
  $query3  = mysqli_query($connect, $sql3) or die(mysqli_connect_error());

  $file_output    = fopen($file_url, 'wb'); // w = Membuka file untuk ditulis

  $mod    = $size % 16;
  if ($mod == 0) {
    $banyak = $size / 16;
  } else {
    $banyak = ($size - $mod) / 16;
    $banyak = $banyak + 1;
  }

  if (is_uploaded_file($file_tmpname)) {
    ini_set('max_execution_time', -1);
    ini_set('memory_limit', -1);
    $aes = new AES($key);

    for ($bawah = 0; $bawah < $banyak; $bawah++) {
      $data    = fread($file_source, 16);  // Fread() digunakan untuk membaca dari file yang terbuka.
      $cipher  = $aes->encrypt($data);
      fwrite($file_output, $cipher); //untuk menulis ke file yang terbuka.
    }
    fclose($file_source); //menutup file yang terbuka
    fclose($file_output);

    echo ("<script language='javascript'>
      window.location.href='decrypt.php';
      window.alert('Enkripsi Berhasil..');
      </script>");
  } else {
    echo ("<script language='javascript'>
      window.location.href='history.php';
      window.alert('Encrypt file mengalami masalah..');
      </script>");
  }
}