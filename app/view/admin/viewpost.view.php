<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $post['title'] ?></title>
</head>
<body>
    
    <h1><?= $post['title'] ?></h1>
    
       <p><strong>Author:</strong> <?= ucfirst($post['username']) ?></p>
        <p><strong>Created at:</strong> <?= $post['created_At'] ?></p>
        <p><strong>Last Updated at:</strong> <?= $post['updated_at'] ?? "NILL" ?></p>
    
    <div><?= nl2br($post['content']) ?></div>

    <div>
        <a href="index.php?action=editPost&id=<?= $post['id'] ?>">Edit</a>
        <a href="index.php?action=deletePost&id=<?= $post['id'] ?>"
        onclick="return confirm('Do you want to delete this post')">Delete</a>
    </div>

</body>
</html>