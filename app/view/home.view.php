<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link href="app/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7f9; 
            font-family: sans-serif; 
        }

        .comments-section {
            max-height: 200px;
            overflow-y: auto;
            padding-right: 0.5rem; 
        }
    </style>
</head>
<body>
    <header class="bg-white shadow rounded-4 p-4 mb-5 d-flex flex-column flex-md-row justify-content-between align-items-center">
        <h1 class="h3 fw-bold text-dark mb-3 mb-md-0">Welcome To My First Blog Work</h1>
        <div class="d-flex gap-3 align-items-center">
            <span class="text-primary fw-semibold">
                <?php if(Session::getSession('username')) : ?>
                    <?= htmlspecialchars(Session::getSession('username')) ?>
                <?php endif; ?>
            </span>

            <?php if(Session::getSession('user_id')) : ?>
                <a href="profile.php" class="text-secondary text-decoration-none hover-link-dark transition">Profile</a>
                <a href="logout.php" class="btn btn-danger shadow-sm">Logout</a>
            <?php else : ?>
                <a href="register.php" class="btn btn-primary shadow-sm">Register</a> 
                <a href="login.php" class="btn btn-primary shadow-sm">Login</a>   
            <?php endif ?> 
        </div>
        </div>
    </header>

    <!-- Search Form -->
    <div class="container-md mb-5 bg-white p-4 rounded-4 shadow mx-auto">
        <form action="" method="get" class="d-flex gap-2">
            <input type="search" name="search" value="<?= $search ?? ''?>" placeholder="Search Blog..." class="form-control p-3 flex-grow-1">
            <button type="submit" class="btn btn-dark px-4">
                Search
            </button>
        </form>
    </div>

        <!-- Main Content Area: Blog Posts -->
    <main class="container-md mx-auto">
        <div class="row g-4">
            <?php if(!empty($posts)) : ?>
                <?php foreach($posts as $post) : ?>
                    
                    <!-- Individual Post Card -->
                    <div class="col-12">
                        <article class="card shadow-sm rounded-4 border-0 hover-shadow transition h-100">
                            <div class="card-body p-4">
                                
                                <!-- Post Title and Content -->
                                <h3 class="card-title fs-3 fw-bolder text-dark mb-2"><?= htmlspecialchars($post['title']) ?></h3>
                                <p class="card-text text-muted mb-4"><?= htmlspecialchars($post['content']) ?></p>

                                <?php if(Session::getSession('user_id')) :?>
                                    <form action="index.php?action=likes" method="post">
                                        <input type="hidden" name="post_id" value="<?= $post['id']?>">

                                        <button type="submit" name="type" value="like"
                                        <?= $post['like'] === 'like' ? 'disable' : '' ?>>
                                        👍<?= $post['like_count'] ?>
                                    </button>

                                    <button type="submit" name="type" value="dislike"
                                        <?= $post['like'] === 'dislike' ? 'disable' : '' ?>>
                                        😢<?= $post['dislike_count'] ?>
                                    </button>                                    
                                    </form>
                                <?php else :?>
                                <span>👍<?= $post['like_count'] ?></span>
                                <span>😢<?= $post['dislike_count'] ?></span>                                   
                                <?php endif?>  
                                <!-- Post Meta -->
                                <div class="d-flex justify-content-between align-items-center small text-muted mb-3 pb-3 border-bottom">
                                    <small>
                                        Posted by <span class="fw-semibold text-dark"><?= htmlspecialchars($post['username']) ?></span> 
                                        on <?= $post['created_At'] ?>
                                    </small>
                                    <p class="mb-0">
                                        <a href="index.php?id=<?= $post['id'] ?>" class="text-primary text-decoration-none fw-medium">
                                            Read More (View All Comments) &rarr;
                                        </a>
                                    </p>
                                </div>

                                <!-- Comments Section -->
                                <h5 class="h6 fw-bold text-dark mb-3">Comments</h5>
                                
                                <!-- Comment Submission Form -->
                                <div class="mb-4 p-3 rounded bg-light border">
                                    <?php if(Session::getSession('user_id')) : ?>
                                        <form action="index.php?action=addComment" method="POST">
                                            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                                            <textarea name="comment" placeholder="Write a Comment..." rows="3" class="form-control mb-3"></textarea>
                                            <button type="submit" class="btn btn-success btn-sm w-100">
                                                Post Comment
                                            </button>
                                        </form>
                                    <?php else : ?>
                                        <p class="text-center text-secondary mb-0">
                                            <a href="login.php" class="text-primary fw-semibold">Login</a> to leave a comment
                                        </p>
                                    <?php endif ?>
                                </div>

                                <!-- Display Comments (Limited Preview) -->
                                <div class="comments-section g-3">
                                    <?php 
                                    if(!empty($post['comments'])) :
                                        foreach($post['comments'] as $comment) :
                                    ?>
                                            <div class="p-3 mb-2 border-start border-5 border-primary bg-light rounded">
                                                <p class="mb-1 text-dark"><?= htmlspecialchars($comment['comment']) ?></p>
                                                <small class="text-xs text-secondary mt-1 d-block">
                                                    By <span class="fw-medium text-dark"><?= htmlspecialchars($comment['username']) ?></span> on <?= $comment['date'] ?>
                                                </small>
                                            </div>
                                    <?php 
                                        endforeach; 
                                    else : 
                                    ?>
                                        <p class="text-center text-secondary p-4 border rounded">No comment yet</p>
                                    <?php endif ?>
                                </div>

                            </div>
                        </article>
                    </div>
                <?php endforeach ;?> 

            <?php else : ?>
                <div class="col-12">
                    <div class="text-center p-5 bg-white rounded-4 shadow">
                        <p class="fs-5 text-secondary">No posts found.</p>  
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>






    