// signup js

function Signup(){
    // fetching input values

    var email = document.getElementById("email").value;
    var username = document.getElementById("user").value;
    var password = document.getElementById("pass").value;
    
        // Validating email
    // if (!email.checkValidity()) {
    //     alert("Please enter a valid email address.");
    //     return false;
    // }

    var emailPattern= /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    // Validating name
    if (username.length < 3) {
        alert("Name must be at least 3 characters long.");
        return false;
    }

    // Validating password
    if (password.length < 8) {
        alert("Password must be at least 8 characters long.");
        return false;
    }

    alert("Signup successful!");
    window.location.href="login.html";    // redirect to login page

    return false;    // we are manually redirecting with window.location.href, so we don't want the default form submit to refresh the page. if incase data is incorrect, return false prevents form submission
}