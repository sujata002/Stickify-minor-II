<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stickify Login</title>

    <!-- (logo in tab) dui step bahira aaunu parcha to get the path -->
    <link rel="icon" type="image/png" href="../logo/documentLogo.png">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">           <!-- connecting public->css->login.css file here to render css-->
    <link rel="stylesheet" href="{{asset('css/homecss/main.css')}}">   <!-- connecting public->css->homecss->main.css file here to render css-->
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-inner">
                <div class="navbar-brand">
                    <i class="bi bi-sticky brand-icon"></i>
                    <span class="brand-title" id="home">Stickify</span>
                </div>
                <div class="navbar-links header">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                    <a href="#about" class="nav-link">About</a>
                    <a href="#how-it-works" class="nav-link">How It Works</a>
                    <a href="#contact" class="nav-link">Contact</a>
                    <a href="{{ route('login') }}" class="nav-link">Log In</a>
                </div>
            </div>
        </div>
    </nav>
    

    <main>
       <div class="outer-container">
            <div class="login-container">
                <div class="login-form">
                    <div class="text-part">
                        <h2 class="welcome-back">Welcome 👋</h2>
                        <p class="login-description">Today is a new day. It's your day. You shape it.<br>Sign in to start managing your notes.</p>

                        @if (session('success'))          <!-- after saving user from register page it redirects the user to the login page. -->    
                            <p style="color: green;">{{ session('success') }}</p>
                        @endif

                        @if (session('error'))             <!-- if either email or password is wrong during login -->
                            <p style="color: red;">{{ session('error') }}</p>
                        @endif


                        <!-- jaba login form ko submission chai yo aunthenticate vanni route ma jancha-->
                        <form action="{{ route('authenticate')}}" method="post" onsubmit="return Login()">            <!-- yo onsubmit le it tells the browser “before submitting this form, run the Login() function ani if it returns false, don’t submit.-->
                            @csrf

                            <div class="form-input">
                                <label class="input-label">Email</label>
                                <input type="text" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror " id="email" placeholder="name@email.com">          <!-- email ko value clear na hos if error aayera reload huda bhanera tya value ma old email haru lekhya cha -->
                               
                                @error('email')            <!-- to display error if form is submitted with empty fields -->
                                    <p class="invalid-feedback" style="color:red;">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="form-input">
                                <label class="input-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="pass" name="password" placeholder="At least 8 characters">
                                
                                @error('password')            <!-- to display error. the 'password' is from LoginController method authenticate-->
                                    <p class="invalid-feedback" style="color:red;">{{$message}}</p>       
                                @enderror
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
                            Don't you have an account? <a href="{{ route('register') }}">Sign up here</a>
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
