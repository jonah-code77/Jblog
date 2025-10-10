<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My First Blog Work</title>
    <!-- Load Bootstrap 5 CSS via CDN -->
    
    <style>
        /* Custom styles to match the original clean background and font */
        body {
            background-color: #f4f7f9; /* Light grey background */
            font-family: sans-serif; /* Bootstrap default or specific font if desired */
        }
        /* Custom styling for the limited comments section */
        .comments-section {
            max-height: 200px;
            overflow-y: auto;
            padding-right: 0.5rem; 
        }
    </style>
</head>
<body class="p-4">

    <!-- Header and Navigation -->
    
        
        
        <!-- User Actions (Login/Logout/Profile) -->
        
            <!-- Username/Greeting Placeholder -->
            
                <?php if(Session::getSession('username')) : ?>
                    <?= htmlspecialchars(Session::getSession('username')) ?>
                <?php endif; ?>
            </span>
            
            <?php if(Session::getSession('user_id')) : ?>
                <a href="profile.php" class="text-secondary text-decoration-none hover-link-dark transition">Profile</a>
                <a href="logout.php" class="btn btn-danger shadow-sm">Logout</a>
            <?php else : ?>
                <a href="login.php" class="btn btn-primary shadow-sm">Login</a>    
            <?php endif ?> 
        </div>
    </header> 

    <!-- Search Form -->
    <div class="container-md mb-5 bg-white p-4 rounded-4 shadow mx-auto">
        <form action="" method="get" class="d-flex gap-2">
            <input 
                type="search" 
                name="search" 
                value="<?= $search ?? ''?>" 
                placeholder="Search Blog..." 
                class="form-control p-3 flex-grow-1"
            >
            <button 
                type="submit" 
                class="btn btn-dark px-4"
            >
                Search
            </button>
        </form>
    </div>

    <!-- Main Content Area: Blog Posts -->
    <main class="container-md mx-auto">
        <div class="row g-4">
            <?php if(!empty($posts)) : ?>
                <?php foreach($posts as $po) : ?>
                    
                    <!-- Individual Post Card -->
                    <div class="col-12">
                        <article class="card shadow-sm rounded-4 border-0 hover-shadow transition h-100">
                            <div class="card-body p-4">
                                
                                <!-- Post Title and Content -->
                                <h3 class="card-title fs-3 fw-bolder text-dark mb-2"><?= htmlspecialchars($po['title']) ?></h3>
                                <p class="card-text text-muted mb-4"><?= htmlspecialchars($po['content']) ?></p>
                                
                                <!-- Post Meta -->
                                <div class="d-flex justify-content-between align-items-center small text-muted mb-3 pb-3 border-bottom">
                                    <small>
                                        Posted by <span class="fw-semibold text-dark"><?= htmlspecialchars($po['username']) ?></span> 
                                        on <?= $po['created_At'] ?>
                                    </small>
                                    <p class="mb-0">
                                        <a href="index.php?id=<?= $po['id'] ?>" class="text-primary text-decoration-none fw-medium">
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
                                            <input type="hidden" name="post_id" value="<?= $po['id'] ?>">
                                            <textarea 
                                                name="comment" 
                                                placeholder="Write a Comment..." 
                                                rows="3" 
                                                class="form-control mb-3"
                                            ></textarea>
                                            <button 
                                                type="submit" 
                                                class="btn btn-success btn-sm w-100"
                                            >
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
                                    if(!empty($po['comments'])) :
                                        foreach($po['comments'] as $comment) :
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

    <!-- Bootstrap JS Bundle for functionality (dropdowns, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



<h1>Welcome To My First Blog Work</h1>
    <?php if(Session::getSession('user_id')) : ?>
        <a href="logout.php">logout</a>
        <a href="profile.php">Profile</a>
    <?php else : ?>
        <a href="login.php">login</a> ||  <a href="register.php">register</a> 
    <?php endif ?>    
    <?= Session::getSession('username') ?>
    <form action="" method="get">
        <input type="search" name="search" value="<?= $search ?? ''?>" placeholder="Search Blog...">
        <button type="submit">Search</button><br>
    </form>
    <div>
        <?php if(!empty($posts)) : ?>
            <?php foreach($posts as $post) : ?>
                <h3><?= $post['title'] ?></h3>
                <p><?= $post['content'] ?></p>
                <h5>comments</h5>
                <?php if(Session::getSession('user_id')) : ?>
                    <form action="index.php?action=addComment" method="POST">
                        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                        <textarea name="comment" placeholder="Write a Comment"></textarea>
                        <button type="submit">Post comment</button>
                    </form>
                <?php else : ?>
                    <a href="login.php">login</a> to leave a comment
                <?php endif ?>

                <?php if(!empty($post['comments'])) :?>
                    <?php foreach($post['comments'] as $comment) :?>
                        <div>
                            <p><?= $comment['comment'] ?></p>
                            <small>By <?= $comment['username'] ?> on <?= $comment['date'] ?></small>
                        </div>
                    <?php endforeach ?>
                    <?php else : ?>
                        <p>no comment yet</p>
                <?php endif?>

                <small>
                    posted by <?= $post['username'] ?>
                    on <?= $post['created_At'] ?>
                </small>
                <p><a href="index.php?id=<?= $post['id'] ?>">read more</a></p>
            <?php endforeach ;?> 
        <?php else : ?>
            <p>no post</p>   
        <?php endif; ?>
    </div>
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My First Blog Work</title>
    <!-- Load Bootstrap 5 CSS via CDN -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="p-4">

    <!-- Header and Navigation -->
    <header class="bg-white shadow rounded-4 p-4 mb-5 d-flex flex-column flex-md-row justify-content-between align-items-center">
        <h1 class="h3 fw-bold text-dark mb-3 mb-md-0">Welcome To My First Blog Work</h1>
        
        <!-- User Actions (Login/Logout/Profile) -->
        <div class="d-flex gap-3 align-items-center">
            <!-- Username/Greeting Placeholder -->
            <span class="text-primary fw-semibold">
                <?php if(Session::getSession('user_id')) : ?>
                    <?= htmlspecialchars(Session::getSession('username')) ?>
                <?php endif; ?>
            </span>
            
            <?php if(Session::getSession('user_id')) : ?>
                <a href="profile.php" class="text-secondary text-decoration-none hover-link-dark transition">Profile</a>
                <a href="logout.php" class="btn btn-danger shadow-sm">Logout</a>
            <?php else : ?>
                <a href="login.php" class="btn btn-primary shadow-sm">Login</a>    
            <?php endif ?> 
        </div>
    </header> 

    <!-- Search Form -->
    <div class="container-md mb-5 bg-white p-4 rounded-4 shadow mx-auto">
        <form action="" method="get" class="d-flex gap-2">
            <input 
                type="search" 
                name="search" 
                value="<?= $search ?? ''?>" 
                placeholder="Search Blog..." 
                class="form-control p-3 flex-grow-1"
            >
            <button 
                type="submit" 
                class="btn btn-dark px-4"
            >
                Search
            </button>
        </form>
    </div>

    <!-- Main Content Area: Blog Posts -->
    <main class="container-md mx-auto">
        <div class="row g-4">
            <?php if(!empty($posts)) : ?>
                <?php foreach($posts as $po) : ?>
                    
                    <!-- Individual Post Card -->
                    <div class="col-12">
                        <article class="card shadow-sm rounded-4 border-0 hover-shadow transition h-100">
                            <div class="card-body p-4">
                                
                                <!-- Post Title and Content -->
                                <h3 class="card-title fs-3 fw-bolder text-dark mb-2"><?= htmlspecialchars($po['title']) ?></h3>
                                <p class="card-text text-muted mb-4"><?= htmlspecialchars($po['content']) ?></p>
                                
                                <!-- Post Meta -->
                                <div class="d-flex justify-content-between align-items-center small text-muted mb-3 pb-3 border-bottom">
                                    <small>
                                        Posted by <span class="fw-semibold text-dark"><?= htmlspecialchars($po['username']) ?></span> 
                                        on <?= $po['created_At'] ?>
                                    </small>
                                    <p class="mb-0">
                                        <a href="index.php?id=<?= $po['id'] ?>" class="text-primary text-decoration-none fw-medium">
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
                                            <input type="hidden" name="post_id" value="<?= $po['id'] ?>">
                                            <textarea 
                                                name="comment" 
                                                placeholder="Write a Comment..." 
                                                rows="3" 
                                                class="form-control mb-3"
                                            ></textarea>
                                            <button 
                                                type="submit" 
                                                class="btn btn-success btn-sm w-100"
                                            >
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
                                    if(!empty($po['comments'])) :
                                        foreach($po['comments'] as $comment) :
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

    <!-- Bootstrap JS Bundle for functionality (dropdowns, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>




<form action="" method="POST">  
    <div class="login-container">
        <h1>LOGIN</h1>  
        
        <div class="input-group">
            <label for="username">USERNAME</label>
            <input type="text" id="name" placeholder="" name='usernameorEmail'>
        </div>
        
        <div class="input-group">
            <label for="password">PASSWORD</label>
            <input type="password" id="password" placeholder="" name="password">
        </div>
        
        <button name="btn" type="submit">SIGN IN</button>
        <div class="footer">
            Don't have an account? <a href="index.php">Sign up</a>
        </div>
    </div>
</form> 
