<?php
$link = $_GET['link'];
$files    = glob($link);
foreach ($files as $file) {
    if (is_file($file))
        unlink($file);
}
echo '<script> location.replace("history.php"); </script>';
