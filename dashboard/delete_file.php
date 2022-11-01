<?php
include '../config.php';

$id = $_GET['id'];
$search = mysqli_query($connect, "SELECT * FROM file WHERE id_file = $id");
$data = mysqli_fetch_array($search);
if ($search) {
	$rda    = glob($data['file_url']);
	foreach ($rda as $rdas) {
		if (is_file($rdas))
			unlink($rdas);
	}

	$files    = glob('file_decrypt/' . $data['file_name_source']);
	foreach ($files as $file) {
		if (is_file($file))
			unlink($file);
	}
	$del = mysqli_query($connect, "DELETE FROM file WHERE id_file = $id");
	$get = substr($id, 0, 6);
	mysqli_query($connect, "UPDATE file SET id_file = id_file-1 WHERE id_file LIKE '$get%' AND id_file >= '$id'");
	echo '<script> location.replace("decrypt.php"); </script>';
}
