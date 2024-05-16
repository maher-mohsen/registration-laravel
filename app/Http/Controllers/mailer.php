<?php
namespace App\Http\Controllers;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Http\Controllers\RegistrationController;

function sendConfromationMail($email){
    $emailContent = view('emails.confirmation')->render();
    $mail = new PHPMailer(true); // Passing `true` enables exceptions

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'deenigma.ai@gmail.com'; // Your Mailtrap username
        $mail->Password = 'gwbibzqriagvoqcv'; // Your Mailtrap password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        // Sender and recipient settings
        $mail->setFrom('deenigma.ai@gmail.com', 'DeEnigma');
        $mail->addAddress($email, $email); // Primary recipient

        // Email content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = "Confirmation Mail";

        // Include your HTML template here
        $mail->Body = $emailContent;

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
