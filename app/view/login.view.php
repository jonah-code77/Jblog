
<form action="" method="POST">  
    <div class="login-container">
        <h1>LOGIN</h1>  
         <?= $msg[0] ?? null ?>
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