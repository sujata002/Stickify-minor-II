<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Added this line to import the Log facade

// Remove the following lines if you are no longer using Laravel's Mail facade
// use Illuminate\Support\Facades\Mail;
// use App\Mail\ContactMail;

// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP; // Needed for SMTP debugging if you enable it

class ContactController extends Controller
{
    /**
     * Display the contact form view.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('contact');
    }

    /**
     * Handle the contact form submission and send an email using PHPMailer.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Get the validated data
        $name = $request->input('name');
        $email = $request->input('email');
        $userMessage = $request->input('message'); // Renamed to avoid conflict with PHPMailer's $mail->Body

        // Create a new PHPMailer instance
        $mail = new PHPMailer(true); // Passing `true` enables exceptions

        try {
            // Server settings
            $mail->SMTPDebug = 0; // Set to 2 for detailed debugging output (for development)
            $mail->isSMTP(); // Send using SMTP
            $mail->Host       = env('MAIL_HOST'); // Your SMTP server host from .env
            $mail->SMTPAuth   = true; // Enable SMTP authentication
            $mail->Username   = env('MAIL_USERNAME'); // SMTP username (your email address) from .env
            $mail->Password   = env('MAIL_PASSWORD'); // SMTP password (or app password for Gmail) from .env
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = env('MAIL_PORT'); // TCP port to connect to; use 587 for STARTTLS, 465 for SMTPS

            // Recipients
            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')); // Sender's email and name from .env
            $mail->addAddress('sameera.ban0123@apexcollege.edu.np', 'stickify'); // Add a recipient (where the email will be sent)
            $mail->addReplyTo($email, $name); // Add a reply-to address (the user's email)

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'New Contact Form Submission from ' . $name;
            $mail->Body    = "
                <h3>New Message from Contact Form</h3>
                <p><strong>Name:</strong> {$name}</p>
                <p><strong>Email:</strong> {$email}</p>
                <p><strong>Message:</strong><br>{$userMessage}</p>
            ";
            $mail->AltBody = "New Message from Contact Form\nName: {$name}\nEmail: {$email}\nMessage: {$userMessage}"; // Plain text for non-HTML mail clients

            $mail->send();
            return back()->with('success', 'Thanks! Your message has been sent 💌');

        } catch (Exception $e) {
            // Log the error for debugging
            Log::error("Message could not be sent. Mailer Error: {$mail->ErrorInfo}"); // Changed \Log::error to Log::error
            return back()->with('error', 'Oops! There was an error sending your message. Please try again later.');
        }
    }
}
// this is for contact form
//added by samira