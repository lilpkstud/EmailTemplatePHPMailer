<?php
var_dump($_POST);
die();
/**
 * Importing PHPMailer classes into the global namespace
 * These must be at the top of your script, not inside a function
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Loading Composer's autholoader
require 'vendor/autoload.php';

//Adding ENV Files
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

/**
 * Create a new PHPMailer instance
 * NOT FOR PRODUCTION  - passing true to enable exceptions
 *  */
$mail = new PHPMailer(true);

/* -------------------------------------
    Server Settings
------------------------------------- */
$mail->isSMTP();
//Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
$mail->SMTPDebug = 2;
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username =  $_ENV['smtpUsername'];
//Password to use for SMTP authentication
$mail->Password =  $_ENV['smtpPassword'];

if(isset($_POST)){
    var_dump($_POST);
    
    /* -------------------------------------
        Sender Settings
    ------------------------------------- */

    //Setting who the message is being sent from and Setting an alternative reply-to address
   
    if(!empty($_POST['senderFirstName']) && !empty($_POST['senderEmail'])){
        $mail->setFrom($_POST['senderEmail'], $_POST['senderFirstName']);
        $mail->addReplyTo($_POST['senderEmail'], $_POST['senderFirstName']);
    }
    if(!empty($_POST['senderFirstName']) && !empty($_POST['senderLastName']) && !empty($_POST['senderEmail'])){
        $mail->setFrom($_POST['senderEmail'], $_POST['senderFirstName'].' '.$_POST['senderLastName']);
        $mail->addReplyTo($_POST['senderEmail'], $_POST['senderFirstName'].' '.$_POST['senderLastName']);
    }
    if(!empty($_POST['senderEmail'])){
        $mail->setFrom($_POST['senderEmail']);
        $mail->addReplyTo($_POST['senderEmail']);
    }
    else if(empty($_POST['senderEmail'])){
        echo "Email not being sent becuase the POST senderEmail wasnt inputted";
    }
    
    /* -------------------------------------
        Receiver Settings
    ------------------------------------- */

    //Setting who the message is to be sent to
    if(!empty($_POST['firstName']) && !empty($_POST['sendEmailTo'])){
        echo "First If Statement";
        $mail->addAddress($_POST['sendEmailTo'], $_POST['firstName']);
    }
    if(!empty($_POST['firstName']) && !empty($_POST['lastName'] && !empty($_POST['sendEmailTo']))){
        echo "2nd If Statement";
        $mail->addAddress($_POST['sendEmailTo'], $_POST['firstName'].' '.$_POST['lastName']);
    }
    if(!empty($_POST['sendEmailTo'])){
        $mail->addAddress($_POST['sendEmailTo']);
    }
    else if(empty($_POST['sendEmailTo'])){
        echo "Email Not being Sent becuase the POST EMAIL wasnt inputted";
        die();
    }
    //Setting the Subject Line
    if(!empty($_POST['subjectLine'])){
        $mail->Subject = $_POST['subjectLine'];
    }
    if(empty($_POST['subjectLine'])){
        $mail->Subject = 'Add New Subject Line';
    }
}

//Set who the message is to be sent to
//$mail->addAddress('receiver@email.com', 'First Last');

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML(file_get_contents('content.html'), __DIR__);
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//Send the message, check for errors
echo '<pre>';
var_dump($mail);
die();

/*
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
*/