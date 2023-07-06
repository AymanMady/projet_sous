<?php
if (isset($_POST['view'])) {
    $file_chemin = $_POST['file_chemin'];
    $file_name = $_POST['file_name'];
    $file_extension = pathinfo($file_chemin, PATHINFO_EXTENSION);
    $content_type = '';

    // Détermination du type de contenu en fonction de l'extension du fichier
    switch ($file_extension) {
        case 'pdf':
            $content_type = 'application/pdf';
            break;
        case 'doc':
        case 'docx':
            $content_type = 'application/vnd.ms-word';
            break;
        case 'xls':
        case 'xlsx':
            $content_type = 'application/vnd.ms-excel';
            break;
        case 'odt':
            $content_type = 'application/vnd.oasis.opendocument.text';
            break;
        default:
            // Type de fichier non pris en charge
            die('Erreur : type de fichier non pris en charge');
    }

    // Envoi des en-têtes HTTP pour le téléchargement
    header("Content-Type: {$content_type}");
    header("Content-Disposition: attachment; filename=\"{$file_name}\"");
    header("Content-Transfer-Encoding: binary");
    header("Accept-Ranges: bytes");

    // Lecture du fichier et envoi de son contenu
    readfile($file_chemin);
    exit;
}
?>