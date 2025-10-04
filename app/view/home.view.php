<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
</head>
<body>
    <h1>Welcome To My First Blog Work</h1>
    <?php if(Session::getSession('user_id')) : ?>
        <a href="logout.php">logout</a>
    <?php else : ?>
        <a href="login.php">login</a>    
    <?php endif ?>    
    
    <form action="" method="get">
        <input type="search" name="search" value="<?= $search ?? ''?>" placeholder="Search Blog...">
        <button type="submit">Search</button><br>
    </form>
    <div>
        <?php if(!empty($posts)) : ?>
            <?php foreach($posts as $po) : ?>
                <h3><?= $po['title'] ?></h3>
                <p><?= $po['content'] ?></p>
                <small>
                    posted by <?= $po['username'] ?>
                    on <?= $po['created_At'] ?>
                </small>
                <p><a href="index.php?id=<?= $po['id'] ?>">read more</a></p>
            <?php endforeach ;?> 
        <?php else : ?>
            <p>no post</p>   
        <?php endif; ?>
    </div>
</body>
</html>