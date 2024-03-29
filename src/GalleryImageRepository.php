<?php

class GalleryImageRepository
{

    public function __construct(private PDO $pdo){}

    public function fetchAll()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM images ORDER BY id ASC');
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_CLASS, GalleryImageModel::class);

        return $results;
    }

    public function handleNewUpload(string $title, string $tmpImagePath) {
        $finalFileName = uniqid('', true) . '.jpeg';
        $resizeOk = resizeImage($tmpImagePath, __DIR__ . "/../images/{$finalFileName}");

        if ($resizeOk) {
            $stmt = $this->pdo->prepare('INSERT INTO images (title, src) VALUES (:title, :src)');
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':src', $finalFileName);
            $stmt->execute();
            return true;
        }
        else {
            return false;
        }
    }

    public function handleDelete(int $id)
    {
        // Step 1 select entry with the right ID
        $stmt = $this->pdo->prepare('SELECT * FROM images WHERE id = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_CLASS, GalleryImageModel::class);

        if(empty($results) ||empty($results[0])){
            return false;
        }
        $entry = $results[0];

        // Step 2 delete imagefile from folder
        unlink(__DIR__ . '/../images/' . $entry->src);
        // Step 3 delete entry from DB
        $stmt2 = $this->pdo->prepare('DELETE FROM images WHERE id = :id');
        $stmt2->bindValue('id', $id);
        $stmt2->execute();
    }

    public function findById(int $id): ?GalleryImageModel
    {
        $stmt = $this->pdo->prepare('SELECT * FROM images WHERE id = :id');
        $stmt->bindValue('id', $id);
        $stmt->setFetchMode(PDO::FETCH_CLASS, GalleryImageModel::class);
        $stmt->execute();
        $entry = $stmt->fetch();
        if(empty($entry)){
            return null;
        }else{
            return $entry;
        }
    }

    public function updateTitle(int $id, string $newTitle)
    {
        $stmt = $this->pdo->prepare('UPDATE images SET title = :newTitle WHERE id = :id');
        $stmt->bindValue('id', $id);
        $stmt->bindValue('newTitle', $newTitle);
        $stmt->execute();
    }

}