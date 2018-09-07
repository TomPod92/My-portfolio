<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';



function send_mail($config) {
    // Tworzymy nowy obiekt klasy PHPMailer
$mail = new PHPMailer(true);
    // Polskie znaki
    $mail->CharSet = 'UTF-8';

    // Ustawienia serwera                             
    $mail->isSMTP();                                      
    $mail->Host = 'smtp.gmail.com';  
    $mail->SMTPAuth = true;                              
    $mail->Username = 'podsiadlik.tomek@gmail.com';      // nazwa uzytkownika konta           
    $mail->Password = 'SilneHaslo0';            // haslo do konta               
    $mail->SMTPSecure = 'tls';                            
    $mail->Port = 587;                                    

    // Dane do wysylki
    $mail->setFrom('podsiadlik.tomek@gmail.com', 'Ja');      // adres z ktorego zostanie wyslany mail
    $mail->addAddress('podsiadlik.tomek@gmail.com');         // adres na jaki zostanie rpzeslany mail   
    $mail->addReplyTo($config->from_email);                      // adres email z formularza


    // Zalaczniki
    if (isset($_FILES['uploaded_file']) &&
        $_FILES['uploaded_file']['error'] == UPLOAD_ERR_OK) {
        $mail->AddAttachment($_FILES['uploaded_file']['tmp_name'],
                             $_FILES['uploaded_file']['name']);
    }

    // Tresc maila
    $mail->isHTML(true);                                  
    $mail->Subject = 'Wiadomość z formularza na portfolio';
    $mail->Body = 'Wiadomość od ' . $config->from_email . '<br>Treść wiadomosci: <br>' . $config->mail_message;  // tresc HTML wiadomosci
    $html = new \Html2Text\Html2Text($mail->AltBody);
    $mail->AltBody = $html->getText(); // tresc tekstowa wiadmosci (zeby poczta nie zakfalifikowala wiadomosci jako spam)

    if(!$mail->send()) {
        echo 'Nie udalo się wysłać wiadomości.';
    } else {
        echo 'Wiadomość została wysłana.';
    }
}


// jezeli zostanie wyslany formularz
if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    
    $config = (object) [
        'from_email' => $_POST['from_email'],
        'mail_message' => $_POST['mail_message'],
    ];

    send_mail($config);
}

?>


