<?php

require __DIR__ . 'vendor/autoload.php';

function send_mail($config) {
    // Tworzymy nowy obiekt klasy PHPMailer
    $mail = new PHPMailer;

    // Polskie znaki
    $mail->CharSet = 'UTF-8';

    // Ustawienia serwera                             
    $mail->isSMTP();                                      
    $mail->Host = 'smtp.gmail.com';  
    $mail->SMTPAuth = true;                              
    $mail->Username = 'Tomasz Podsiadlik';      // nazwa uzytkownika konta           
    $mail->Password = 'SilneHaslo0';            // haslo do konta               
    $mail->SMTPSecure = 'tls';                            
    $mail->Port = 587;                                    

    // Dane do wysylki
    $mail->setFrom('podsiadlik.tomek@gmail.com', 'Ja');      // adres z ktorego zostanie wyslany mail
    $mail->addAddress('podsiadlik.tomek@gmail.com');         // adres na jaki zostanie rpzeslany mail   
    $mail->addReplyTo($config->from_email);                      // adres email z formularza


    // Zalaczniki
    //$mail->addAttachment('/var/tmp/file.tar.gz');         
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    

    // Tresc maila
    $mail->isHTML(true);                                  
    $mail->Subject = 'Wiadomość z formularza na portfolio';
    $mail->Body = $config->mail_message;  // tresc HTML wiadomosci
    $html = new \Html2Text\Html2Text($mail->AltBody);
    $mail->AltBody = $html->getText(); // tresc tekstowa wiadmosci (zeby poczta nie zakfalifikowala wiadomosci jako spam)

    if(!mail->send()) {
        echo 'Nie udalo się wysłać wiadomości.';
    } else {
        echo 'Wiadomość została wysłana.';
    }
}


// jezeli ostanie wyslany formularz
if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    
    $config = (object) [
        'from_email' => $_POST['from_email'],
        'mail_message' => $_POST['mail_message'],
    ];

    send_mail($config);
}

?>


