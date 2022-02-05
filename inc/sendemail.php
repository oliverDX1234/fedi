<?php

use PHPMailer\PHPMailer\PHPMailer;

require '../vendor/autoload.php';


if (!empty($_POST)) {
    $email = $_POST['email'];
    $name = $_POST['phone'];
    $phone = $_POST['name'];
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
    $mail = new PHPMailer();

    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Username = '1f66e60c857796';
    $mail->Password = 'd355cdcf45b4c9';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 2525;

    $mail->setFrom($email, $name);
    $mail->addReplyTo($email, $name);
    $mail->addAddress($email, $name);

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