<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($post['title']) ?></title>
    <!-- Load Bootstrap 5 CSS via CDN -->
    <link href="app/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7f9; 
            font-family: sans-serif;
        }
    </style>
</head>
<body class="p-4">

    <div class="container-md my-5">     
        <a href="index.php" class="btn btn-outline-primary mb-4">&larr; Back to all posts</a>
        <article class="card shadow-lg rounded-4 border-0 mb-5">
            <div class="card-body p-5">
                <h1 class="card-title display-5 fw-bolder text-dark mb-3">
                    <?= htmlspecialchars($post['title']) ?>
                </h1>          
                <p class="card-subtitle text-muted mb-4 pb-3 border-bottom">
                    <small>
                        Posted by <span class="fw-semibold text-primary"><?= htmlspecialchars($post['username']) ?></span> 
                        on <?= $post['created_At'] ?>
                    </small>
                </p>
                <div class="card-text fs-5 text-dark">
                    <?= nl2br(htmlspecialchars($post['content'])) ?>
                </div>
            </div>
        </article>

        <!-- Comments and Comment Form Section -->
        <div class="row">
            <div class="col-lg-8 mx-auto">

                <!-- Comment Form -->
                <h3 class="h4 fw-bold text-dark mb-3">Leave a Comment</h3>
                <div class="p-4 mb-5 rounded-3 bg-white border shadow-sm">
                    <?php if(Session::getSession('user_id')) :?>
                        <form action="index.php?action=addComment" method="POST">
                            <input type="hidden" name="redirect_id" value="<?= $post['id'] ?>">
                            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                            <textarea name="comment" placeholder="Write a Comment..." rows="4" class="form-control mb-3"></textarea>
                            <button type="submit" class="btn btn-success w-100">
                                Post Comment
                            </button>
                        </form>
                    <?php else: ?>
                        <p class="text-center text-secondary mb-0">
                            Please <a href="login.php" class="text-primary fw-semibold">Login</a> to leave a comment.
                        </p>
                    <?php endif;?>
                </div>
                
                <!-- Display Comments -->
                <h3 class="h5 fw-bold text-dark mb-4">
                    Comments (<?= count($post['comments']) ?? 0 ?>)
                </h3>
                
                <?php if(!empty($post['comments'])) :?>
                    <div class="list-group">
                        <?php foreach($post['comments'] as $comment) :?>
                            <div class="list-group-item list-group-item-action p-3 mb-2 rounded border-start border-5 border-info bg-light">
                                <p class="mb-1 text-dark"><?= htmlspecialchars($comment['comment']) ?></p>
                                <small class="text-secondary d-block mt-1">
                                    By <span class="fw-medium text-dark"><?= htmlspecialchars($comment['username']) ?></span> 
                                    on <?= $comment['date'] ?>
                                </small>
                            </div>
                        <?php endforeach ?> 
                    </div>
                <?php else : ?> 
                    <div class="alert alert-info text-center" role="alert">
                        Be the first to leave a comment!
                    </div>
                <?php endif ?>

            </div>
        </div>

    </div>


</body>
</html>
