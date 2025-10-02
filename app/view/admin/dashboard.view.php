<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog || Admin dashboard</title>
</head>
<body>
    <h1>All Post</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Tittle</th>
            <th>Author||Admin</th>
            <th>Content</th>
            <th>Created At</th>
            <th>updated At</th>
            <th>Actions</th>
        </tr>
         <?php if(!empty($posts)) : ?>
        <?php foreach($posts as $post) : ?>
            <tr>
            <td><?= $post['id'] ?></td>
            <td><?= substr($post['title'],0,10) ."..." ?></td>
            <td><?= $post['username'] ?></td>
            <td><?= substr($post['content'],0,10) ."..." ?></td>
            <td><?= $post['created_At'] ?></td>
            <td><?= $post['updated_at'] ?? '-'?></td>
            <td>
                <a href="index.php?action=viewPost&id=<?= $post['id'] ?>">View Post</a>
                <a href="index.php?action=editPost&id=<?= $post['id'] ?>">Edit</a>
                <a href="index.php?action=deletePost&id=<?= $post['id'] ?>">Delete</a>
            </td>
            </tr>
        <?php endforeach ?>
                <?php else : ?>
            <p>no post</p>   
        <?php endif; ?>
    </table>
    

    <h1>All Users</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th> 
            <th>Role</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        <?php foreach($users as $user) : ?>
            <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['username'] ?></td>
            <td><?= $user['role'] ?></td>
            <td><?= $user['date'] ?? '-'?></td>
            <td>
                <a href="index.php?action=createPost&id=<?= $user['id'] ?>">Add Post</a>
                <a href="index.php?action=changeRole&id=<?= $user['id'] ?>">Change Role</a>
                <a href="index.php?action=deletePostt&id=<?= $user['id'] ?>">Delete</a>
            </td>
            </tr>
        <?php endforeach ?>
    </table>

</body>
</html>