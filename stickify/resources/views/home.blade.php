<!DOCTYPE html>
<html lang="en">
    
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stickify</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite([
    'resources/css/main.css',
    'resources/css/home.css',
    'resources/css/about.css',
    'resources/css/howitworks.css',
    'resources/css/contact.css',
    'resources/css/login.css'
    ])

</head>
<body> 
     
  <nav class="navbar">
    <div class="navbar-container">
      <div class="navbar-inner">
        <!-- Brand Logo and Title -->
        <div class="navbar-brand">
          <i class="bi bi-sticky brand-icon"></i>
          <span class="brand-title" id="home">Stickify</span>
        </div>
        <div class="navbar-links header">
          <a href="#home" class="nav-link">Home</a>
          <a href="#about" class="nav-link">About</a>
          <a href="#how-it-works" class="nav-link">How It Works</a>
          <a href="#contact" class="nav-link">Contact</a>
          <a href="login.blade.php" class="nav-link">Log in</a>
        </div>
        <!--button id="mobile-menu-button" class="mobile-toggle">
          <i class="fas fa-bars"></i>
        </button-->
      </div>
    </div>
  </nav>

  <section id="home" class="hero-section">
  <div class="hero-container">
    <div class="hero-grid">
      <div class="hero-content">
        <h1 class="hero-title">
          <span class="line-1">Take Notes Anywhere</span>
          <span class="line-2">With Stickify</span>
        </h1>
        <p class="hero-description">
          The ultimate browser extension for capturing, organizing, and accessing your notes across all your favorite websites.
          lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. <br>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum ipsum dolorem quisquam, tempora quod quis iste doloribus perferendis aliquam, nisi porro eius sint earum voluptate exercitationem, quae similique hic deserunt!<br> <br>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum ipsum dolorem quisquam, tempora quod quis iste doloribus perferendis aliquam, nisi porro eius sint earum voluptate exercitationem, quae similique hic deserunt!    
        </p>
        <div class="buttons">
          <!-- Chrome Button -->
          <a class="btn-chrome">
            <i class="bi bi-browser-chrome"></i> <Span>Add Stickify to your Chrome now</Span>
          </a>
        </div>
    </div>
  </div>
</section>



<!--Home.css/Feature Section-->
<section class="features-section">
  <div class="features-container">
    <div class="features-header">
      <p class="section-heading">A better way to take notes</p>
      <p class="section-description">Stickify integrates seamlessly with your browsing experience.</p>
    </div>

    <div class="features-grid"><!--1-->
      <div class="feature-card ">
        <div class="feature-together">
        <!-- Feature Icons -->
        <div class="feature-icon"><i class="bi bi-magic"></i></div>
        <h3 class="feature-title">Contextual Notes</h3></div>
        <p class="feature-text">Attach notes directly to web pages. They'll reappear when you revisit, right where you left them.</p>
      </div>

      <div class="feature-card"><!--2-->
         <div class="feature-together">
        <!-- Feature Icons -->
        <div class="feature-icon"><i class="bi bi-arrow-repeat"></i></div>
        <h3 class="feature-title">Sync Across Devices</h3></div>
        <p class="feature-text">Your notes are automatically synced across all your devices, so you never lose an idea.</p>
      </div>

      <div class="feature-card "><!--3-->
        <div class="feature-together">
        <!-- Feature Icons -->
        <div class="feature-icon"><i class="bi bi-search"></i></div>
        <h3 class="feature-title">Powerful Search</h3></div>
        <p class="feature-text">Find any note instantly with our full-text search across all your saved content.</p>
      </div>

      <div class="feature-card "><!--4-->
       <div class="feature-together">
        <!-- Feature Icons -->
        <div class="feature-icon"><i class="bi bi-tags"></i></div>
        <h3 class="feature-title">Extension integration</h3>
        </div>
        <p class="feature-text">Add the stickify extension from chrome store to your computer for taking notes.</p>
      </div>
    </div>
  </div>
</section>



<!--ABOUT SECTION-->
<section id="about" class="about-section">
  <div class="about-container">
    <div class="about-grid">
      <!-- Left Column -->
      <div class="about-content">
        <h2 class="about-title">About Stickify</h2>
        <p class="about-description">
            Stickify was born from our frustration with traditional note-taking apps that don't integrate well with our browsing experience.
            <br>
            Stickify lets you take notes while you browse.<br>
            Save, edit, and manage notes without leaving the page.<br>
            Your notes are safe, synced, and easy to access anytime.
        </p>

        <div class="about-points">
          <div class="about-point">
            
            <!-- About Icons -->
            <div class="icon-wrapper"><i class="bi bi-lightbulb"></i></div>
            <p>
              <span class="highlight">Our Mission:</span> To create the most seamless note-taking experience that works exactly where you need it on the web pages you're browsing.
            </p>
          </div>

          <div class="about-point">
        
            <!-- About Icons -->
            <div class="icon-wrapper"><i class="bi bi-people"></i></div>
            <p>
              <span class="highlight">Our Team:</span> We're a group of passionate developers who built Stickify to make online research and note-taking easier for ourselves and for you.
          </div>
        </div>
      </div>

      <!-- Right Column -->
      <div class="about-story">
        <div class="story-card">
          <div class="story-header">
            <!-- Story Icon -->
            <div class="story-icon"><i class="bi bi-clock-history"></i></div>
            <h3 class="story-title">Our Story</h3>
          </div>

          <p class="story-subtitle">Born from a need, built for everyone</p>
          <div class="story-image"></div>
          <!-- Story Text -->
          <div class="story-text">

            <p>
              As students ourselves, we constantly needed to take notes while researching online. Existing solutions either required constant tab switching or didn't preserve the context of our notes. Stickify was our solution to this problem.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<!--How It Works-->
<section id="how-it-works" class="how-it-works">
  <div class="how-it-works-container">

    <!-- Section Header -->
    <div class="how-header">
      <h2 class="how-title">How Stickify Works</h2>
      <p class="how-subtitle">Simple steps to refine your note-taking</p>
    </div>

    <!-- Steps Grid -->
    <div class="steps-grid">
      
      <!-- Step 1 -->
      <div class="step-card">
        <!--div class="step-number">1</div-->
        <div class="step-content">
          <h3> <a> <i class="bi bi-download"></i></a> 1. Install the Extension</h3>
          <p>Add Stickify to your browser with one click. It's available for Chrome.</p>
        </div>
      </div>

      <!-- Step 2 -->
      <div class="step-card">
        <!--div class="step-number">2</div-->
        <div class="step-content">
          <h3><a> <i class="bi bi-journal-text"></i></a> 2. Take Notes Anywhere</h3>
          <p>Click the Stickify icon. Your notes stay with the page.</p>
        </div>
      </div>

      <!-- Step 3 -->
      <div class="step-card">
        <!--div class="step-number">3</div-->
        <div class="step-content">
          <h3><a> <i class="bi bi-card-checklist"></i></a> 3. Access & Organize</h3>
          <p>View all your notes in one place, and find them when you return to a page.</p>
        </div>
      </div>

      <!-- Step 4 -->
      <div class="step-card">
        <!--div class="step-number">4</div-->
        <div class="step-content">
          <h3><a><i class="bi bi-emoji-smile"></i></a> 4. Enjoy</h3>
          <p>Enjoy your note-taking experience with Stickify </p>
        </div>
    </div>
  </div>
</section>




<!--Contact-->
<section id="contact" class="contact-section">
  <div class="contact-container">
    <div class="contact-grid">

      <!-- Contact Info -->
      <div class="contact-details">
        <h2 class="contact-title">SAY HELLO!</h2>
        <p class="contact-subtitle">
          Have questions or feedback? Get in touch with us.
        </p>

        <div class="contact-items">
          <div class="contact-item">
            <div class="contact-icon email-icon">
              <i class="bi bi-envelope"></i>
            </div>
            <div class="contact-info">
              <h3>Email</h3>
              <p>stickify123@gmail.com</p>
            </div>
          </div>

          <div class="contact-item">
            <div class="contact-icon address-icon">
              <i class="bi bi-geo-alt"></i>
            </div>
            <div class="contact-info">
              <h3>Address</h3>
              <p>New Baneshwor, Kathmandu, Nepal</p>
            </div>
          </div>

          <div class="contact-item">
            <div class="contact-icon phone-icon">
              <i class="bi bi-telephone"></i>
            </div>
            <div class="contact-info">
              <h3>Phone</h3>
              <p>+977 123 123-4567</p>
            </div>
          </div>
        </div>

      </div>

      <!-- Contact Form -->
      <div class="contact-form-card">
        <h3>Send us your feedback here:</h3>
        <form class="contact-form">
          <label for="name"> Your Name:</label>
          <input type="text" id="name" name="name">

          <label for="email">Your Email</label>
          <input type="email" id="email" name="email">

          <!--label for="subject">Subject</label>
          <input type="text" id="subject" name="subject"-->

          <label for="message">Your Message</label>
          <textarea id="message" name="message" rows="4"></textarea>

          <button type="submit">Send</button>
        </form>
      </div>

    </div>
  </div>
</section>


</body>
</html>
