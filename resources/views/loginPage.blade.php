<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/auth_css/login.css">
</head>

<body>
    <div class="login-container">
        <div class="front-page">
            <div class="login-form">
                <div class="login-header">
                    <h1>Sign in</h1>
                    <a href="#" class="google-signin">
                        <i class="fab fa-google"></i>
                        Sign with Google
                    </a>
                </div>

                <form action="#" method="POST">
                    <div class="form-group">
                        <label for="email">Username or email address</label>
                        <input type="email" id="email" name="email" value="Omar@beyond.com" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="password-container">
                            <input type="password" id="password" name="password" value="••••••" required>
                        </div>
                        <div class="forgot-password">
                            <a href="#">Forgot password?</a>
                        </div>
                    </div>

                    <button type="submit" class="login-btn">Sign in</button>
                </form>

                <div class="signup-link">
                    Don't have account? <a href="#">Sign up</a>
                </div>
            </div>
        </div>

        <div class="back-page">
            <div class="shapes-container">
                <div class="floating-shape shape1"></div>
                <div class="floating-shape shape2"></div>
                <div class="floating-shape shape3"></div>
                <div class="floating-shape shape4"></div>
                <div class="floating-shape shape5"></div>

                <div class="character">
                    <div class="character-figure">
                        <div class="character-head"></div>
                        <div class="character-arms">
                            <div class="arm left"></div>
                            <div class="arm right"></div>
                        </div>
                        <div class="character-legs">
                            <div class="leg"></div>
                            <div class="leg"></div>
                        </div>
                        <div class="skateboard"></div>
                    </div>
                </div>

                <div class="floating-elements">
                    <div class="phone-icon">
                        <div class="phone-screen"></div>
                    </div>
                </div>

                <div class="cactus">
                    <div class="cactus-body"></div>
                    <div class="cactus-pot"></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
