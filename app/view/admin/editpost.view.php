<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit || <?= $post['title'] ?></title>
</head>
<body>
    
    <form action="" method="POST">
            <div class="form-group">
            <label for="content">title:</label>
                <input type="text" name="title"  value="<?= $post['title'] ?>">
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
                <input type="text" name="content"  value="<?= $post['content'] ?>">
        </div>
        <div class="form-group">
            <input type="submit" value="Edit">
        </div>
    </form>

</body>
</html>