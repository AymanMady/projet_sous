<?php
if (isset($_POST['view'])){
    $file_chemin = $_POST['file_chemin'];
    header('content-type: application/word');
    header('content-type: application/pdf , application/word');
    header('content-Disposition: inline; filename="' . $file_chemin . '"');
    header('content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');
    @readfile($file_chemin);
}
?>