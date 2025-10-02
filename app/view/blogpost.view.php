<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $post['title'] ?></title>
</head>
<body>
    <h1><?= $post['title'] ?></h1>
    <p><small>
        by <?= $post['username'] ?>
        on <?= $post['created_At'] ?>
    </small></p>
    <div><?= $post['content'] ?></div>
</body>
</html>