<?php

use PHPMailer\PHPMailer\PHPMailer;

require '../vendor/autoload.php';


if (!empty($_POST)) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];


    if (empty($name)) {
        $errors[] = 'Name is empty';
    }

    if (empty($phone)) {
        $errors[] = 'Phone is empty';
    }


    if (empty($subject)) {
        $errors[] = 'Subject is empty';
    }

    if (empty($email)) {
        $errors[] = 'Email is empty';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email is invalid';
    }

    if (empty($message)) {
        $errors[] = 'Message is empty';
    }
}

if (empty($errors)) {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'host258.checkdomain.de';
    $mail->SMTPAuth = true;
    $mail->Username = 'application@fedicampus.com';
    $mail->Password = 'Application12345!%';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom($email, $name);
    $mail->addReplyTo($email, $name);
    $mail->addAddress("contact@fedicampus.com", "Contact");

    $mail->Subject = $subject;

    $mail->isHTML(true);

    $mailContent = "<h1>You have received a new contact email</h1>
    <p>from: <strong>$email</strong></p>
    <p>name: <strong>$name</strong></p>
    <p>subject: <strong>$subject</strong></p>
    <p>phone: <strong>$phone</strong></p>
    <p>message: <strong>$message</strong></p>";
    $mail->Body = $mailContent;

    if($mail->send()){
        echo 'Success';
    }else{
        echo 'Error';
    }

} else {
    echo ("Error");
}


?>