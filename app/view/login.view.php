


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link href="app/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
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
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg border-0 rounded-4 p-4">
                    <div class="card-body">
                        <form action="" method="POST"> 
                            <h1 class="card-title text-center mb-4 fw-bold text-dark">LOGIN</h1> 
                             <?= $msg[0] ?? null ?>
                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">USERNAME / EMAIL</label>
                                <input type="text" id="name" class="form-control p-3" placeholder="Enter username or email" name='usernameorEmail' required>
                            </div>
                            

                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">PASSWORD</label>
                                <input type="password" id="password" class="form-control p-3" placeholder="Enter password" name="password" required>
                            </div>
                            

                            <button name="btn" type="submit" class="btn btn-primary w-100 p-3 fw-bold shadow-sm">
                                SIGN IN
                            </button>
                            

                            <div class="text-center mt-3 small">
                                Don't have an account? 
                                <a href="register.php" class="text-decoration-none fw-semibold">Sign up</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
