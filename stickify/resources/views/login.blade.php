<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stickify Login</title>

    <!-- (logo in tab) dui step bahira aaunu parcha to get the path -->
    <link rel="icon" type="image/png" href="../logo/documentLogo.png">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">           <!-- connecting public->css->login.css file here to render css-->
</head>
<body>
    <header class="navbar">
    <div class="logo">STICKIFY</div>
        <nav>
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">How It Works</a>
        <a href="#">Login</a>
        <a href="#">Contact</a>
        </nav>
    </header>

    <main>
       <div class="outer-container">
            <div class="login-container">
                <div class="login-form">
                    <div class="text-part">
                        <h2 class="welcome-back">Welcome 👋</h2>
                        <p class="login-description">Today is a new day. It's your day. You shape it.<br>Sign in to start managing your notes.</p>

                        <form onsubmit="return Login()">            <!-- yo onsubmit le it tells the browser “before submitting this form, run the Login() function ani if it returns false, don’t submit.-->
                            <div class="form-input">
                                <label class="input-label">Email</label>
                                <input type="email" id="email" placeholder="example@email.com">
                            </div>
                            <div class="form-input">
                                <label class="input-label">Password</label>
                                <input type="password" id="pass" placeholder="At least 8 characters">
                            </div>
                            <div class="forgot-password">
                                <a href="#">Forgot Password?</a>
                            </div>
                            <button type="submit" class="btn-primary">Sign In</button>
                        </form>

                        <div class="separator">Or</div>

                        <!-- yo chai google login pani garna milcha bhanera rakheko ho. not integrating it rn but can be done later on-->

                        <!-- <div class="social-login">             
                            <button class="social-btn google-btn"><img src=" logo of google" >Sign in with Google</button>
                        </div> -->

                        <div class="no-account">
                            Don't you have an account? <a href="signup.html">Sign up here</a>
                        </div>

                    </div>
                </div>
                <div class="image-part">
                    <div class="login-img">
                        <img src="{{asset('logo/login-pic.jpg')}}" alt="login-pic" id="login-pic" >     <!-- asset wala bhaneko chai laravel helper ho gito generate full URLs to public files.-->
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
</html>

<script src="./login.js"></script>
