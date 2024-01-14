
<form action="upload.php" method="POST" enctype="multipart/form-data">
    <h3>Bild hochladen</h3>
    <label for="upload-title">Title:</label><br>
    <input type="text" name="title" id="upload-title"><br>

    <label for="upload-image">Bildauswählen:</label><br>
    <input type="file" name="image" id="upload-image">

    <input type="submit" value="Abschicken">
</form>



<?php if(!empty($images)): ?>
    <table>
        <thead>
            <tr>
                <th>Bild</th>
                <th>Title</th>
                <th>Aktion</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($images AS $image): ?>
            <tr>
                <td><img src="../images/<?php echo e($image->src); ?>" style="width: 10rem"/></td>
                <td><?php echo e($image->title); ?></td>
                <td>
                    <a href="edit.php?id=<?php echo e($image->id); ?>">Bearbeiten</a>
                    <form action="delete.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo e($image->id); ?>" />
                        <input type="submit" value="Löschen" class="input-to-btn" />
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Es wurden bisher noch keine Bilder erfasst.</p>
<?php endif; ?>