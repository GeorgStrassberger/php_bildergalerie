<?php

require_once (__DIR__ . '/../inc/all.php');

if(!empty($_POST['id'])){
    $delete_ID = (int) $_POST['id'];

    $galleryImageRepository = new GalleryImageRepository($pdo);
    $galleryImageRepository->handleDelete($delete_ID);
}

header('Location: admin.php');
