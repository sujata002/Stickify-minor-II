document.addEventListener("DOMContentLoaded", function () {
  const year = new Date().getFullYear();
  document.getElementById("footer").innerHTML = `
    <footer style="background:grey; color:white; padding:2em 1em; text-align:center; font-family:sans-serif;">
      <div style="margin-bottom:1em;">
        <a href="index.html" style="color:#fff; margin:0 1em; text-decoration:none;">Home</a>
        <a href="about.html" style="color:#fff; margin:0 1em; text-decoration:none;">About</a>
        <a href="howitworks.html" style="color:#fff; margin:0 1em; text-decoration:none;">How It Works</a>
        <a href="login.html" style="color:#fff; margin:0 1em; text-decoration:none;">Login</a>
        <a href="contact.html" style="color:#fff; margin:0 1em; text-decoration:none;">Contact</a>
      </div>
      
        <p style="margin:0.5em 0;">Follow us on:</p>
        <div style="margin:0.5em 0;">
            <a href="https://www.facebook.com" target="_blank" style="color:#fff; margin:0 0.5em; text-decoration:none;">Facebook</a>
            <a href="https://www.twitter.com" target="_blank" style="color:#fff; margin:0 0.5em; text-decoration:none;">Twitter</a>
            <a href="https://www.instagram.com" target="_blank" style="color:#fff; margin:0 0.5em; text-decoration:none;">Instagram</a>
            <a href="https://www.linkedin.com" target="_blank" style="color:#fff; margin:0 0.5em; text-decoration:none;">LinkedIn</a>
        </div>
      <p style="margin:0.5em 0;">Email: <a href="mailto:stickify123@business.com" style="color:#fff;">stickify.123@business.com</a></p>
      <p style="margin:0.5em 0;">&copy; ©${year} Stickify. All rights reserved.</p>
    </footer>
  `;
});
