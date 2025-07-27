<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stickify Signup</title>

    <!-- (logo in tab) dui step bahira aaunu parcha to get the path -->
    <link rel="icon" type="image/png" href="{{ asset('logo/documentLogo.png') }}">
    <link rel="stylesheet" href="{{asset('css/register.css')}}">
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
                        <p class="login-description">Today is a new day. It's your day. You shape it.<br>Sign up to start managing your notes.</p>

                        <form action="{{ route ('processRegister') }}" method="post" onsubmit="return Signup()">
                            @csrf            <!-- makes sure only real users (not fake websites) can submit this form -->

                            <div class="form-input">
                                <label class="input">Email</label>
                                <input type="text" value ="{{ old('email')}}" id="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="name@email.com">

                                @error('email')
                                    <p class="invalid-feedback" style="color:red;">{{$message}}</p>  
                                @enderror

                            </div>

                            <div class="form-input">
                                <label class="input">Username</label>
                                <input type="text" value="{{old('user')}}" id="user" class="form-control @error('user') is-invalid @enderror" name="user" placeholder="Jane Doe">

                                @error('user')
                                    <p class="invalid-feedback" style="color:red;">{{$message}}</p>  
                                @enderror
                            </div>

                            <div class="form-input">
                                <label class="input">Password</label>
                                <input type="password" id="pass" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="At least 8 characters">
                            
                                @error('password')
                                    <p class="invalid-feedback" style="color:red;">{{$message}}</p>  
                                @enderror

                            </div>

                             <div class="form-input">
                                <label class="input">Confirm Password</label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="pass_confirmation" name="password_confirmation" placeholder="Confirm Password ">
                                
                                @error('password_confirmation')
                                    <p class="invalid-feedback" style="color:red;">{{$message}}</p>  
                                @enderror
                            
                            </div>

                            <button type="submit" class="btn-primary">Sign Up</button>
                        </form>

                        <div class="separator">Or</div>

                        <!-- yo chai google login pani garna milcha bhanera rakheko ho. not integrating it rn but can be later on-->
                        <!-- <div class="social-login">             
                            <button class="social-btn google-btn"><img src="https://img.icons8.com/color/20/000000/google-logo.png" >Sign in with Google</button>
                        </div> -->

                        <div class="no-account">
                            Already have an account? <a href="{{ route('login') }}" >Sign in here</a>
                        </div>

                    </div>
                </div>
                <div class="image-part">
                    <div class="login-img">
                        <img src="{{asset('logo/login-pic.jpg')}}" alt="login-pic" id="login-pic" >
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
</html>

<script src="./signup.js"></script>



<!-- about csrf
    suppose: 
    i am logged into Stickify.
    i visit a fake website in another tab.
    that fake site secretly tries to submit a request to my Stickify account, pretending to be me.
    the csrf token prevents that fake request from working because the fake site doesn’t have my unique token.
-->