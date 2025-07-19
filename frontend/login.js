//login js

function Login(){
    var email = document.getElementById("email").value;
    var password = document.getElementById("pass").value;

    // validating email using regex 

     var emailPattern= /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    //validating password

    if (password.length < 8) {
        alert("Password must be at least 8 characters long.");
        return false;
    }

    // if all validation pass                            aba esma registration sanga ko pw milauna parcha tyo baki cha. laravel bata match garaunu parcha
    alert("You have been successfully logged in!");

    //user successfully logged in bhaye pachi dashboard ma redirect garnu parcha so yo use garna milcha ki herni pachi
    // window.location.href="dashboard ko link";       
   
    return true;               // if we put dashboard ma redirect garne link thru window.location... we use return false here to prevent form from refreshing

}