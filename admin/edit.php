<?php

require_once (__DIR__ . '/../inc/all.php');

$galleryImageRepository = new GalleryImageRepository($pdo);

// Formular abgeschickt
if(!empty($_POST) && !empty($_POST['title'])){
    var_dump($_POST);
    $id = @(int) $_POST['id'];
    $title = @(string) $_POST['title'];

    $galleryImageRepository->updateTitle($id, $title);

    header('Location: admin.php');
}
// Formular nicht abgeschickt
else{
    $entry = $galleryImageRepository->findById(@(int) $_GET['id']);
    if (empty($entry)){
        header('Location: admin.php');
        // die();
    }else{
        renderAdmin(__DIR__ . '/views/edit.view.php',[
            'galleryImage' => $entry
        ]);
    }
}



