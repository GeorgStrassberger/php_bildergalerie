<?php

require_once (__DIR__ . '/../inc/all.php');

$galleryImageRepository = new GalleryImageRepository($pdo);

$title = $_POST['title'];
$errorMessage = '';

/*
* Check if extrionion is installed and active
$testGD = get_extension_funcs("gd"); // Grab function list
if (!$testGD) {
    echo "GD not even installed.";
    exit;
}
echo "<pre>" . print_r($testGD, true) . "</pre>";
*/

if(empty($title)){
   $errorMessage = 'Bitte geben Sie einen Title ein.';
}
else if (!empty($_FILES['image']) &&
    $_FILES['image']['error'] === UPLOAD_ERR_OK &&
    $_FILES['image']['type'] === 'image/jpeg' &&
    is_uploaded_file($_FILES['image']['tmp_name'])) {

    $uploadOk = $galleryImageRepository->handleNewUpload($title, $_FILES['image']['tmp_name']);
    if(!$uploadOk){
        $errorMessage = 'Das Bild konnte vom Server nicht verarbeitet werden.';
    }

}
else {
    $errorMessage = 'Es wurde keine gültiges Bild hochgeladen.';
}

renderAdmin(__DIR__ . '/views/upload.view.php', [
    'message' => $errorMessage
]);