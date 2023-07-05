<?php
if (isset($_POST['view'])){
    $file_chemin = $_POST['file_chemin'];
    $file_name = $_POST['file_name'];
    header('content-type: application/word');
    header('content-Disposition: inline; filename="' . $file_name . '"');
    header('content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');
}
?>