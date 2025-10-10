



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="app/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            /* Center the entire content vertically and horizontally */
            background-color: #f4f7f9; 
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <!-- Use a medium column size for a good balance (col-md-6) -->
            <div class="col-md-7 col-lg-5">
                <div class="card shadow-lg border-0 rounded-4 p-4">
                    <div class="card-body">
                        <form action="" method="POST">  
                            <h1 class="card-title text-center mb-4 fw-bold text-dark">SIGN UP</h1>  
                            <?= $msg[0] ?? null ?>
                            <div class="mb-3">
                                <label for="username" class="form-label fw-semibold">USERNAME</label>
                                <input type="text" id="username" class="form-control p-3" placeholder="Choose a username" name='username' required>
                            </div>
                            
                            
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">EMAIL</label>
                                <input type="email" id="email" class="form-control p-3" placeholder="Enter your email address" name='email' required>
                            </div>
                            
                            
                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">PASSWORD</label>
                                <input type="password" id="password" class="form-control p-3" placeholder="Create a password" name="password" required>
                            </div>
                            
                          
                            <button name="btn" type="submit" class="btn btn-success w-100 p-3 fw-bold shadow-sm">
                                REGISTER
                            </button>
                            
                          
                            <div class="text-center mt-3 small">
                                Already have an account with us? 
                                <a href="login.php" class="text-decoration-none fw-semibold">Sign IN</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
