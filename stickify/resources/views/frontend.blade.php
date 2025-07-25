
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home Page </title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">STICKIFY</div>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="howitworks.html">How It Works</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="login.html">Login</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="content-box">
            <h1>Your notes, simplified</h1>
            <p>Pin it,Keep it,Recall it.</p>
            <a href="about.html" class="view-services-button">ABOUT US</a> <!-- yo chai action button lai tyo side ma aauni -->
        </div>
    </main>

    <!--about-->
    <div class="container">
        <div class="left-column">
            <img src="image/about1.jpg" alt="sticky notes">
        </div>
        <div class="right-column">
            <h1>ABOUT US</h1>
            <p class="subtitle">EMPOWER YOUR NOTES</p>
           <h2>Secure, flexible, and accessible</h2>
             <p class="description">
                Stickify is your ultimate note-taking companion based in Kathmandu, NP. 
                With user authentication, you can store and access your notes safely, 
                giving you peace of mind. Manage your notes effortlessly from your dashboard,
                and easily trace the URLs where they were created. Our handy browser extension
                allows you to add and modify notes without leaving the page.
                Enjoy the freedom to create, read, update, and delete your notes, 
                ensuring complete control over your data.
            </p>
            <button class="contact-btn">GET IN TOUCH</button>
        </div>
    </div>
        <div class="main-section">
            <p class="highlight">NOTE TAKING MADE EASY</p>
            <h1>Secure, manage, and access your notes anytime</h1>
            <div class="features-row">
            <div class="feature-card">
                <img src="image/user.jpg" alt="User authentication">
                <div class="feature-content">
                <h2>User authentication</h2>
                <p>Securely store and access your notes with ease.</p>
                </div>
            </div>
            <div class="feature-card">
                <img src="image/dashboard.jpg" alt="Dashboard management">
                <div class="feature-content">
                <h2>Dashboard management</h2>
                <p>Easily manage your notes from a user-friendly dashboard.</p>
                </div>
            </div>
            <div class="feature-card">
                <img src="image/browser.jpg" alt="Browser extension">
                <div class="feature-content">
                <h2>Browser extension </h2>
                <p>Add and modify notes without leaving your current page.</p>
                </div>
            </div>
            </div>
        </div>
</div>

<!--how it works-->
<main>
    <!-- First row: Feature 1 and 2 -->
    <div class="features-row">
      <!-- Feature 1 -->
      <div class="feature-card">
        <img src="image/image1.jpeg" alt="User authentication" />
        <div class="feature-content">
          <h3>User authentication</h3>
          <p>Secure your notes with user authentication for peace of mind.</p>
          <button class="learn-more-btn" data-title="User authentication"
            data-desc="Our authentication system supports multi-factor authentication and ensures your data is encrypted end-to-end for maximum security. You can trust that your notes are safe and accessible only by you.">
            Learn more
          </button>
        </div>
      </div>
      <!-- Feature 2 -->
      <div class="feature-card">
        <img src="image/image2.jpg" alt="Dashboard management" />
        <div class="feature-content">
          <h3>Dashboard management</h3>
          <p>Manage your notes effortlessly from a user-friendly dashboard.</p>
          <button class="learn-more-btn" data-title="Dashboard management"
            data-desc="The dashboard offers intuitive controls to organize, search, and categorize your notes. Customize your workspace and stay productive with easy access to all your important information.">
            Learn more
          </button>
        </div>
      </div>
    </div>
    <!-- Second row: Feature 3 and 4 -->
    <div class="features-row">
      <!-- Feature 3 -->
      <div class="feature-card">
        <img src="image/image3.avif" alt="Easy Installation" />
        <div class="feature-content">
          <h3>Easy Installation</h3>
          <p>Collaborate seamlessly with others on your notes and projects.</p>
          <button class="learn-more-btn" data-title="Easy Installation"
            data-desc="Work together with your team in real time, leave comments, tag collaborators, and track changes. Perfect for group projects and shared brainstorming sessions.">
            Learn more
          </button>
        </div>
      </div>
      <!-- Feature 4 -->
      <div class="feature-card">
        <img src="image/image4.jpeg" alt="Create and organize notes" />
        <div class="feature-content">
          <h3>Create and Organize notes</h3>
          <p>Access your notes on any device, anytime, anywhere.</p>
          <button class="learn-more-btn" data-title="Create and Organize notes"
            data-desc="Our app is available on web, desktop, and mobile platforms, ensuring seamless access and synchronization across Windows, macOS, Android, and iOS devices.">
            Learn more
          </button>
        </div>
      </div>
    </div>
  </main>
  <!-- Modal (for the pop-up feature)-->
  <div class="modal" id="modal">
    <div class="modal-content">
      <button class="modal-close" id="modalClose" aria-label="Close">&times;</button>
      <h2 class="modal-title" id="modalTitle"></h2>
      <p class="modal-desc" id="modalDesc"></p>
    </div>
  </div>

  <div class="container contact-container"> <!-- Container is Bootstrap utility class -->
        <div class="row">
            <!-- Left Side Contact Information -->
            <div class="col-md-6 contact-info-left"> <!--col-md-6 means in screens ≥768px and up it takes 6 out of 12 units-->
                <div class="say-hello">SAY HELLO</div>
                <h1>Get in touch with us</h1>
                
                <div class="contact-item">
                    <div class="icon-container">
                        <i class="bi bi-telephone"></i> <!--Bootstrap Icons, the telephone icon-->
                    </div>
                    <div class="contact-text">
                        Call us now<br>
                        +977 981 234 5678
                    </div>
                </div>
                <div class="contact-item">
                    <div class="icon-container">
                        <i class="bi bi-envelope"></i><!--Bootstrap Icons, the envelope icon-->
                    </div>
                    <div class="contact-text">
                        Support email<br>
                        stickifyapp@gmail.com
                    </div>
                </div>
                <div class="contact-item">
                    <div class="icon-container">
                        <i class="bi bi-geo-alt"></i><!--Bootstrap Icons, the location icon-->
                    </div>
                    <div class="contact-text">
                        Our address<br>
                        New Baneshwor, Kathmandu, Nepal
                    </div>
                </div>
            </div>
            <!-- Right Side Contact Form -->
            <div class="col-md-6"><!--it takes 6 out of 12 units-->
                <div class="row">
                    <div class="col-md-12"><!--it takes 12 out of 12 units-->
                        <div class="contact-form">
                            <h2>Contact us</h2>
                            <form>
                                <div class="mb-3"><!--Bootstrap class for margin-bottom 1rem, which is 16px-->
                                    <label for="name" class="form-label">Your Name (required)</label>
                                    <input type="text" class="form-control" id="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Your Email (required)</label>
                                    <input type="email" class="form-control" id="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Your Message</label>
                                    <textarea class="form-control" id="message" rows="5"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

  <!--login-->

<script> </script>
</body>
</html>